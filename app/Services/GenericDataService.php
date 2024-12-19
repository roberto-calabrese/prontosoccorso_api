<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;

class GenericDataService
{

    protected array $ospedaliData = [];
    protected string $configKey;


    public function __construct()
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
            unset($value['replaceSearch'], $value['replaceTo']);
            $value['data'] = $data[$key] ?? [];
            $this->ospedaliData[$key] = $value;
        }

        if (empty($data)) {
            $dataJobSync = $this->getJobResult(new $ospedaleConfig['jobClass']($this->activeWebsocket(), $ospedaleConfig), $ospedaleConfig);
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
