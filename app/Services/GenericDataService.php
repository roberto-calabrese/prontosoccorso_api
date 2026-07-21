<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Throwable;

class GenericDataService
{

    protected array $ospedaliData = [];
    protected string $configKey;


    public function __construct(protected ScrapeAlertNotifier $alertNotifier)
    {

    }

    public function getData(array $ospedali, $configKey): array
    {

        $this->configKey = $configKey;

        foreach ($ospedali as $ospedale) {
            $this->loadOspedaliData($ospedale);
        }


        return $this->ospedaliData;
    }

    private function loadOspedaliData(string $ospedale): void
    {
        $configKey = $this->configKey . ".ospedali." . $ospedale;

        $ospedaleConfig = config($configKey);

        $data = Cache::get($ospedaleConfig['cache']['key']);

        foreach ($ospedaleConfig['data'] as $key => $value) {
            unset($value['replaceSearch'], $value['replaceTo'], $value['codice']);
            $value['data'] = $data[$key] ?? [];
            $this->ospedaliData[$key] = $value;
        }

        if (empty($data)) {
            try {
                $dataJobSync = $this->getJobResult(new $ospedaleConfig['jobClass']($this->activeWebsocket(), $ospedaleConfig), $ospedaleConfig);
            } catch (Throwable $e) {
                // Path sincrono/locale: il job viene eseguito direttamente, quindi
                // l'eccezione non passa dalla coda. Notifichiamo qui e rilanciamo.
                $this->alertNotifier->report(
                    source: $ospedaleConfig['cache']['key'] ?? $configKey,
                    reason: 'Il job di scraping ha sollevato un\'eccezione',
                    e: $e,
                    context: [
                        'jobClass' => $ospedaleConfig['jobClass'] ?? null,
                        'url' => $ospedaleConfig['url'] ?? null,
                    ],
                );
                throw $e;
            }

            // La rilevazione dello scrape "vuoto" è gestita dentro il job (trait
            // AlertsOnScrapeFailure), così funziona anche in modalità async/redis.
            if (!$this->activeWebsocket()) {
                foreach ($this->ospedaliData as $key => $data) {
                    if (isset($dataJobSync[$key]['data'])) {
                        $this->ospedaliData[$key]['data'] = array_merge($this->ospedaliData[$key]['data'], $dataJobSync[$key]['data']);
                    }
                }
            }
        }
    }

    public function getWebSocketConfig(): array
    {
        return [
            'active' => $this->activeWebsocket(),
            'channel' => config("$this->configKey.websocket.channel"),
            'event' => config("$this->configKey.websocket.event"),
        ];
    }

    protected function activeWebsocket(): array
    {
        return config('queue.default') === 'redis' && config("$this->configKey.websocket.active") ? config("$this->configKey.websocket") : [];
    }

    protected function getJobResult($job, array $config = []): array
    {
        if ($this->activeWebsocket()) {
            $job::dispatch($this->activeWebsocket(), $config);
            return [];
        }

        return $job->handle();
    }
}
