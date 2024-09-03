<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\SitemapGenerator;
use Symfony\Component\Console\Command\Command as CommandAlias;
use Carbon\Carbon;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class SiteMapGeneratorCommand extends Command
{
    protected $signature = 'sitemap:generate';

    protected $description = 'Comando per generare la sitemap';

    public function handle(): int
    {
        $sitemap = Sitemap::create();


        // Aggiungi le pagine statiche
        $sitemap->add(Url::create('https://prontosoccorso.live/')
            ->setLastModificationDate(Carbon::yesterday())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
            ->setPriority(0.1))
            ->add(Url::create('https://prontosoccorso.live/il-progetto')
                ->setLastModificationDate(Carbon::yesterday())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
                ->setPriority(0.1))
            ->add(Url::create('https://prontosoccorso.live/come-funziona')
                ->setLastModificationDate(Carbon::yesterday())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
                ->setPriority(0.1));


        $regioni = config('regioni');

        // Dati da cui iterare
        $ospedaliPerRegione = array_map(static function ($province, $regione) {
            $numeroOspedaliPerRegione = array_sum(array_map(static function ($provincia) {
                return array_sum(array_map(static function ($ospedali) {
                    return count($ospedali['data']);
                }, $provincia['ospedali']));
            }, $province));

            $numeroOspedaliPerProvince = array_map(static function ($provincia) {
                $numeroOspedali = array_sum(array_map(static function ($ospedali) {
                    return count($ospedali['data']);
                }, $provincia['ospedali']));

                return [
                    'meta' => $provincia['meta']
                ];
            }, $province);

            return [
                'regione' => ucfirst($regione),
                'slug_regione' => $regione,
                'province' => $numeroOspedaliPerProvince
            ];
        }, $regioni, array_keys($regioni));

        foreach ($ospedaliPerRegione as $regione) {
            $sitemap->add(Url::create("https://prontosoccorso.live/{$regione['slug_regione']}")
                ->setLastModificationDate(Carbon::yesterday())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
                ->setPriority(0.8)); // Puoi regolare la priorità a seconda delle tue esigenze

            foreach ($regione['province'] as $provincia) {
                $sitemap->add(Url::create("https://prontosoccorso.live/{$regione['slug_regione']}/{$provincia['meta']['slug']}")
                    ->setLastModificationDate(Carbon::yesterday())
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
                    ->setPriority(0.6)); // Puoi regolare la priorità a seconda delle tue esigenze
            }
        }

        $sitemap->writeToFile(public_path('sitemap.xml'));

        return CommandAlias::SUCCESS;
    }
}
