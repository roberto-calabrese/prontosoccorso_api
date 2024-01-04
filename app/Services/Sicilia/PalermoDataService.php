<?php

namespace App\Services\Sicilia;

use App\Jobs\Sicilia\Palermo\ArsCivicoJob;
use App\Jobs\Sicilia\Palermo\OspedaliRiunitiJob;
use Illuminate\Support\Facades\Cache;

class PalermoDataService
{
    protected array $ospedaliRiunitiData;
    protected array $arsCivicoData;

    public function __construct()
    {
        $this->ospedaliRiunitiData = [];
        $this->arsCivicoData = [];
    }

    public function getData(): \Illuminate\Config\Repository|\Illuminate\Foundation\Application|array|\Illuminate\Contracts\Foundation\Application
    {
        $this->loadOspedaliRiunitiData();
        $this->loadArsCivicoData();

        $arsCivico = config('regioni.sicilia.palermo.ospedali.arsCivico.data');
        foreach ($arsCivico as $key => $value) {
            $arsCivico[$key]['data'] = $this->arsCivicoData[$key] ?? [];
        }

        $ospedaliRiuniti = config('regioni.sicilia.palermo.ospedali.ospedaliRiuniti.data');
        foreach ($ospedaliRiuniti as $key => $value) {
            $ospedaliRiuniti[$key]['data'] = $this->ospedaliRiunitiData[$key] ?? [];
        }

        return array_merge($ospedaliRiuniti, $arsCivico);
    }

    public function getWebSocketConfig(): array
    {
        return [
            'active' => $this->activeWebsocket(),
            'channel' => config('regioni.sicilia.palermo.websocket.channel'),
            'event' => config('regioni.sicilia.palermo.websocket.event'),
        ];
    }

    protected function activeWebsocket(): bool
    {
        return config('queue.default') === 'redis' && config('regioni.sicilia.palermo.websocket.active');
    }


    protected function loadOspedaliRiunitiData(): void
    {
        $cacheKey = config('regioni.sicilia.palermo.ospedali.ospedaliRiuniti.cache.key');
        $this->ospedaliRiunitiData = Cache::get($cacheKey) ?: [];

        if (empty($this->ospedaliRiunitiData)) {
            $this->ospedaliRiunitiData = $this->getJobResult(new OspedaliRiunitiJob());
        }
    }

    protected function loadArsCivicoData(): void
    {
        $cacheKey = config('regioni.sicilia.palermo.ospedali.arsCivico.cache.key');
        $this->arsCivicoData = Cache::get($cacheKey) ?: [];

        if (empty($this->arsCivicoData)) {
            $this->arsCivicoData = $this->getJobResult(new ArsCivicoJob());
        }
    }

    protected function getJobResult(ArsCivicoJob|OspedaliRiunitiJob $job): array
    {
        if ($this->activeWebsocket()) {
            $job::dispatch(true);
            return [];
        }

        return $job->handle();
    }
}
