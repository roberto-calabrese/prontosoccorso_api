<?php

namespace Tests\Feature;

use App\Mail\ScrapeCheckReport;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

/**
 * Il comando viene esercitato con sorgenti finte: niente rete, cosi' il test
 * verifica la classificazione degli esiti e non la salute dei portali veri.
 */
class ScrapeCheckCommandTest extends TestCase
{
    private function configuraSorgenti(array $gruppi): void
    {
        config()->set('regioni', [
            'regionetest' => [
                'provinciatest' => ['ospedali' => $gruppi],
            ],
        ]);
    }

    private function gruppo(string $jobClass, array $ospedali, string $chiave): array
    {
        return [
            'cache' => ['key' => $chiave, 'ttlMinute' => 1],
            'url' => 'https://esempio.test/',
            'headers' => [],
            'jobClass' => $jobClass,
            'data' => array_fill_keys($ospedali, ['id' => 1, 'nome' => 'Ospedale']),
        ];
    }

    public function test_segnala_successo_quando_tutte_le_sorgenti_rispondono(): void
    {
        Mail::fake();

        $this->configuraSorgenti([
            'buona' => $this->gruppo(JobConDati::class, ['uno', 'due'], 'test.buona'),
        ]);

        $this->artisan('scrape:check', ['--no-mail' => true])
            ->assertExitCode(0)
            ->expectsOutputToContain('1 ok');
    }

    public function test_una_sorgente_che_solleva_eccezione_risulta_fallita(): void
    {
        $this->configuraSorgenti([
            'rotta' => $this->gruppo(JobCheEsplode::class, ['uno'], 'test.rotta'),
        ]);

        // Codice di uscita diverso da zero: serve al cron per accorgersene.
        $this->artisan('scrape:check', ['--no-mail' => true])
            ->assertExitCode(1)
            ->expectsOutputToContain('FALLITO');
    }

    public function test_una_sorgente_senza_valori_validi_risulta_fallita(): void
    {
        $this->configuraSorgenti([
            'vuota' => $this->gruppo(JobSenzaDati::class, ['uno'], 'test.vuota'),
        ]);

        $this->artisan('scrape:check', ['--no-mail' => true])
            ->assertExitCode(1)
            ->expectsOutputToContain('nessun ospedale con valori validi');
    }

    public function test_una_sorgente_a_cui_manca_un_ospedale_risulta_parziale(): void
    {
        $this->configuraSorgenti([
            'parziale' => $this->gruppo(JobConDati::class, ['uno', 'due', 'mancante'], 'test.parziale'),
        ]);

        // I presidi che il portale non pubblica piu' non vanno confusi con un
        // fallimento: la sorgente risponde, ma va segnalata.
        //
        // Nota: le due attese vanno su righe diverse dell'output, perche'
        // Mockery soddisfa una sola aspettativa per singola scrittura.
        $this->artisan('scrape:check', ['--no-mail' => true])
            ->assertExitCode(0)
            ->expectsOutputToContain('1 ospedale su 3 senza dati')
            ->expectsOutputToContain('1 parziali');
    }

    public function test_invia_il_riepilogo_con_i_conteggi_corretti(): void
    {
        Mail::fake();
        config()->set('services.scrape_alert.email', 'destinatario@esempio.test');

        $this->configuraSorgenti([
            'buona' => $this->gruppo(JobConDati::class, ['uno'], 'test.buona'),
            'rotta' => $this->gruppo(JobCheEsplode::class, ['uno'], 'test.rotta'),
        ]);

        $this->artisan('scrape:check')->assertExitCode(1);

        Mail::assertSent(ScrapeCheckReport::class, function (ScrapeCheckReport $mail) {
            return $mail->hasTo('destinatario@esempio.test')
                && $mail->riepilogo['sorgenti'] === 2
                && $mail->riepilogo['ok'] === 1
                && $mail->riepilogo['falliti'] === 1;
        });
    }

    public function test_l_oggetto_della_mail_dice_subito_se_ci_sono_problemi(): void
    {
        $conKo = new ScrapeCheckReport([], ['falliti' => 3, 'parziali' => 0]);
        $tuttoOk = new ScrapeCheckReport([], ['falliti' => 0, 'parziali' => 0]);

        $this->assertStringContainsString('3 sorgenti KO', $conKo->envelope()->subject);
        $this->assertStringContainsString('tutto ok', $tuttoOk->envelope()->subject);
    }

    public function test_il_filtro_per_regione_esclude_le_altre(): void
    {
        $this->configuraSorgenti([
            'buona' => $this->gruppo(JobConDati::class, ['uno'], 'test.buona'),
        ]);

        $this->artisan('scrape:check', ['--regione' => 'inesistente', '--no-mail' => true])
            ->assertExitCode(1)
            ->expectsOutputToContain('Nessuna sorgente');
    }

    public function test_una_sorgente_che_si_riprende_al_secondo_tentativo_non_e_un_fallimento(): void
    {
        JobIntermittente::$chiamate = 0;

        $this->configuraSorgenti([
            'ballerina' => $this->gruppo(JobIntermittente::class, ['uno'], 'test.ballerina'),
        ]);

        // Un intoppo di rete isolato non deve finire nel riepilogo: e' il caso
        // che rendeva il report inaffidabile.
        $this->artisan('scrape:check', ['--no-mail' => true])
            ->assertExitCode(0)
            ->expectsOutputToContain('1 ok');

        $this->assertSame(2, JobIntermittente::$chiamate);
    }

    public function test_con_un_solo_tentativo_la_sorgente_intermittente_risulta_fallita(): void
    {
        JobIntermittente::$chiamate = 0;

        $this->configuraSorgenti([
            'ballerina' => $this->gruppo(JobIntermittente::class, ['uno'], 'test.ballerina'),
        ]);

        $this->artisan('scrape:check', ['--tentativi' => 1, '--no-mail' => true])
            ->assertExitCode(1);

        $this->assertSame(1, JobIntermittente::$chiamate);
    }
}

/** Restituisce dati validi per gli ospedali 'uno' e 'due'. */
class JobConDati
{
    public function __construct(protected array $websocket, protected array $config) {}

    public function handle(): array
    {
        return [
            'uno' => ['data' => ['rosso' => ['value' => 0], 'verde' => ['value' => 3]]],
            'due' => ['data' => ['rosso' => ['value' => 1]]],
        ];
    }
}

/** Sorgente che risponde ma senza valori numerici (selettori non piu' validi). */
class JobSenzaDati
{
    public function __construct(protected array $websocket, protected array $config) {}

    public function handle(): array
    {
        return ['uno' => ['data' => ['rosso' => ['value' => '-']]]];
    }
}

/** Fallisce solo la prima volta: simula l'intoppo di rete passeggero. */
class JobIntermittente
{
    public static int $chiamate = 0;

    public function __construct(protected array $websocket, protected array $config) {}

    public function handle(): array
    {
        self::$chiamate++;

        if (self::$chiamate === 1) {
            throw new \RuntimeException('cURL error 28: Connection timed out');
        }

        return ['uno' => ['data' => ['rosso' => ['value' => 2]]]];
    }
}

/** Sorgente irraggiungibile. */
class JobCheEsplode
{
    public function __construct(protected array $websocket, protected array $config) {}

    public function handle(): array
    {
        throw new \RuntimeException('cURL error 28: Operation timed out');
    }
}
