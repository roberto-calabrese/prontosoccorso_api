<?php

namespace App\Services\Sicilia;

use App\Jobs\Sicilia\Palermo\ArsCivicoJob;
use App\Jobs\Sicilia\Palermo\GenericJob;
use App\Jobs\Sicilia\Palermo\OspedaliRiunitiJob;
use App\Jobs\Sicilia\Palermo\PoliclinicoJob;
use Illuminate\Support\Facades\Cache;

class PalermoDataService
{
    protected array $ospedaliRiunitiData;
    protected array $arsCivicoData;
    protected array $policlinicoData;
    protected array $ingrassiaData;


    public function __construct()
    {
        $this->ospedaliRiunitiData = [];
        $this->arsCivicoData = [];
        $this->policlinicoData = [];
        $this->ingrassiaData = [];
    }

    public function getData(): \Illuminate\Config\Repository|\Illuminate\Foundation\Application|array|\Illuminate\Contracts\Foundation\Application
    {
        $this->loadOspedaliRiunitiData();
        $this->loadArsCivicoData();
        $this->loadPoliclinicoData();
        $this->loadIngrassiaData();


        $arsCivico = config('regioni.sicilia.palermo.ospedali.arsCivico.data');
        foreach ($arsCivico as $key => $value) {
            $arsCivico[$key]['data'] = $this->arsCivicoData[$key] ?? [];
        }

        $ospedaliRiuniti = config('regioni.sicilia.palermo.ospedali.ospedaliRiuniti.data');
        foreach ($ospedaliRiuniti as $key => $value) {
            $ospedaliRiuniti[$key]['data'] = $this->ospedaliRiunitiData[$key] ?? [];
        }

        $policlinico = config('regioni.sicilia.palermo.ospedali.policlinico.data');
        foreach ($policlinico as $key => $value) {
            $policlinico[$key]['data'] = $this->policlinicoData[$key] ?? [];
        }

        $ingrassia = config('regioni.sicilia.palermo.ospedali.ingrassia.data');
        foreach ($ingrassia as $key => $value) {
            $ingrassia[$key]['data'] = $this->ingrassiaData[$key] ?? [];
        }

        return array_merge($ospedaliRiuniti, $arsCivico, $policlinico, $ingrassia);
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
        $config =config('regioni.sicilia.palermo.ospedali.ospedaliRiuniti');
        $this->ospedaliRiunitiData = Cache::get($config['cache']['key']) ?: [];

        if (empty($this->ospedaliRiunitiData)) {
            $this->ospedaliRiunitiData = $this->getJobResult(new GenericJob(false, $config), $config);
        }
    }

    protected function loadArsCivicoData(): void
    {
        $config = config('regioni.sicilia.palermo.ospedali.arsCivico');
        $this->arsCivicoData = Cache::get($config['cache']['key']) ?: [];

        if (empty($this->arsCivicoData)) {
            $this->arsCivicoData = $this->getJobResult(new ArsCivicoJob());
        }
    }

    protected function loadPoliclinicoData(): void
    {
        $config = config('regioni.sicilia.palermo.ospedali.policlinico');
        $this->policlinicoData = Cache::get($config['cache']['key']) ?: [];

        if (empty($this->policlinicoData)) {
            $this->policlinicoData = $this->getJobResult(new GenericJob(false, $config), $config);
        }
    }

    protected function loadIngrassiaData(): void
    {
        $config = config('regioni.sicilia.palermo.ospedali.ingrassia');
        $this->ingrassiaData = Cache::get($config['cache']['key']) ?: [];

        if (empty($this->ingrassiaData)) {
            $this->ingrassiaData = $this->getJobResult(new GenericJob(false, $config), $config);
        }
    }

protected function getJobResult(ArsCivicoJob|OspedaliRiunitiJob|PoliclinicoJob|GenericJob $job, array $config = []) : array
    {
        if ($this->activeWebsocket()) {
            $job::dispatch(true, $config);
            return [];
        }

        return $job->handle();
    }
}
