<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Indice completo (regioni, province, ospedali) servito in un'unica chiamata,
 * usato dal motore di ricerca del client per fare matching lato browser.
 */
class ApiSearchIndexController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        try {
            $index = $this->buildIndex();

            return response()->json([
                'status' => true,
                ...$index,
            ])->header('Cache-Control', 'public, max-age=600');

        } catch (Exception $e) {
            \Log::error('Error in : '.self::class .' - '. $e->getMessage() . ' - line: ' . $e->getLine());

            return response()->json([
                'status' => false,
                'message' => 'Errore Server'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    private function buildIndex(): array
    {
        $regioni = [];
        $province = [];
        $ospedali = [];

        foreach (config('regioni') as $regioneSlug => $provinceConfig) {
            $regioneNome = $this->slugToTitle($regioneSlug);
            $ospedaliRegione = 0;

            foreach ($provinceConfig as $provinciaSlug => $provinciaConfig) {
                $provinciaNome = $provinciaConfig['meta']['Titolo'] ?? $this->slugToTitle($provinciaSlug);
                $provinciaUrl = "/{$regioneSlug}/{$provinciaSlug}";
                $ospedaliProvincia = 0;
                $siglaProvincia = null;

                foreach ($provinciaConfig['ospedali'] as $gruppo) {
                    foreach ($gruppo['data'] ?? [] as $ospedale) {
                        $nome = $ospedale['nome'] ?? null;

                        if (!$nome) {
                            continue;
                        }

                        $indirizzo = $ospedale['indirizzo'] ?? '';
                        $siglaProvincia ??= $this->siglaDaIndirizzo($indirizzo);
                        $slug = $this->slug($nome);

                        $ospedali[] = [
                            'tipo' => 'ospedale',
                            'nome' => $nome,
                            'descrizione' => $ospedale['descrizione'] ?? null,
                            'comune' => $this->comune($nome, $indirizzo),
                            'indirizzo' => $indirizzo ?: null,
                            'telefono' => $ospedale['telefono'] ?? null,
                            'adulti' => (bool) ($ospedale['adulti'] ?? true),
                            'regione' => $regioneSlug,
                            'regione_nome' => $regioneNome,
                            'provincia' => $provinciaSlug,
                            'provincia_nome' => $provinciaNome,
                            'sigla' => $this->siglaDaIndirizzo($indirizzo),
                            'slug' => $slug,
                            'url' => "{$provinciaUrl}?ps={$slug}",
                            'coords' => $this->coords($ospedale['coords'] ?? null),
                        ];

                        $ospedaliProvincia++;
                    }
                }

                $province[] = [
                    'tipo' => 'provincia',
                    'nome' => $provinciaNome,
                    'slug' => $provinciaSlug,
                    'regione' => $regioneSlug,
                    'regione_nome' => $regioneNome,
                    'sigla' => $siglaProvincia,
                    'n_ospedali' => $ospedaliProvincia,
                    'url' => $provinciaUrl,
                ];

                $ospedaliRegione += $ospedaliProvincia;
            }

            $regioni[] = [
                'tipo' => 'regione',
                'nome' => $regioneNome,
                'slug' => $regioneSlug,
                'n_province' => count($provinceConfig),
                'n_ospedali' => $ospedaliRegione,
                'url' => "/{$regioneSlug}",
            ];
        }

        return [
            'regioni' => $regioni,
            'province' => $province,
            'ospedali' => $ospedali,
            'ospedaliTotali' => count($ospedali),
        ];
    }

    /**
     * Deve restituire lo stesso slug di createSlug() lato client (utils/string-utils.ts),
     * perché finisce nella query string ?ps= che apre il dettaglio dell'ospedale.
     */
    private function slug(string $value): string
    {
        $value = mb_strtolower(trim($value));
        $value = preg_replace('/[^a-z0-9\s-]/u', '', $value);
        $value = preg_replace('/\s+/', '-', $value);

        return preg_replace('/-+/', '-', $value);
    }

    /**
     * Le coordinate non sono presenti per tutti i presidi e in qualche config
     * arrivano incomplete: in quel caso è meglio ometterle che restituirne di sbagliate.
     */
    private function coords(?array $coords): ?array
    {
        if (!isset($coords['lat'], $coords['lng']) || !is_numeric($coords['lat']) || !is_numeric($coords['lng'])) {
            return null;
        }

        return [
            'lat' => (float) $coords['lat'],
            'lng' => (float) $coords['lng'],
        ];
    }

    private function slugToTitle(string $slug): string
    {
        return implode('-', array_map('ucfirst', explode('-', $slug)));
    }

    /**
     * Sigla automobilistica in coda all'indirizzo, es. "... 51100 Pistoia PT" => "PT".
     */
    private function siglaDaIndirizzo(string $indirizzo): ?string
    {
        if (preg_match('/\b([A-Z]{2})\s*$/', trim($indirizzo), $match)) {
            return $match[1];
        }

        return null;
    }

    /**
     * Il comune si legge dopo il CAP dell'indirizzo. Dove il CAP manca si ripiega
     * sul nome, che è quasi sempre nella forma "Comune - Ospedale X"
     * (fallback impreciso quando il prefisso è invece l'azienda sanitaria).
     */
    private function comune(string $nome, string $indirizzo): ?string
    {
        if (preg_match('/\b\d{5}\s+(.+?)(?:\s+[A-Z]{2})?\s*$/u', trim($indirizzo), $match)) {
            return trim($match[1], " \t\n\r\0\x0B,-");
        }

        if (preg_match('/\s-\s([^-,]+?)\s*$/u', trim($indirizzo), $match)) {
            return trim($match[1]);
        }

        if (str_contains($nome, ' - ')) {
            return trim(explode(' - ', $nome)[0]);
        }

        return null;
    }
}
