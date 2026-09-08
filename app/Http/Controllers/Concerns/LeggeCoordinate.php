<?php

namespace App\Http\Controllers\Concerns;

/**
 * Coordinate ricavate dai presidi presenti in configurazione.
 *
 * Servono al client per disegnare la cartina di sfondo dell'hero: non essendo
 * confini amministrativi ma la media dei pronto soccorso monitorati, il punto
 * cade dove i presidi ci sono davvero — che è esattamente quello che la mappa
 * deve raccontare.
 */
trait LeggeCoordinate
{
    /**
     * Punti dei presidi di una provincia, nella forma [['lat' => float, 'lng' => float], ...].
     */
    protected function puntiProvincia(array $provinciaConfig): array
    {
        $punti = [];

        foreach ($provinciaConfig['ospedali'] ?? [] as $gruppo) {
            foreach ($gruppo['data'] ?? [] as $ospedale) {
                $punto = $this->punto($ospedale['coords'] ?? null);

                if ($punto) {
                    $punti[] = $punto;
                }
            }
        }

        return $punti;
    }

    /**
     * Punti dei presidi di un'intera regione (tutte le sue province).
     */
    protected function puntiRegione(array $regioneConfig): array
    {
        return array_merge(...array_map(
            fn ($provinciaConfig) => $this->puntiProvincia($provinciaConfig),
            array_values($regioneConfig) ?: [[]]
        ));
    }

    /**
     * Baricentro di un insieme di punti. Sulle distanze in gioco (una provincia,
     * al massimo una regione) la media aritmetica è indistinguibile dal
     * baricentro sferico, quindi non vale la pena proiettare.
     */
    protected function baricentro(array $punti): ?array
    {
        if (!$punti) {
            return null;
        }

        return [
            'lat' => round(array_sum(array_column($punti, 'lat')) / count($punti), 6),
            'lng' => round(array_sum(array_column($punti, 'lng')) / count($punti), 6),
        ];
    }

    /**
     * Le coordinate non sono presenti per tutti i presidi e in qualche config
     * arrivano incomplete: in quel caso è meglio ometterle che restituirne di sbagliate.
     */
    private function punto(?array $coords): ?array
    {
        if (!isset($coords['lat'], $coords['lng']) || !is_numeric($coords['lat']) || !is_numeric($coords['lng'])) {
            return null;
        }

        return [
            'lat' => (float) $coords['lat'],
            'lng' => (float) $coords['lng'],
        ];
    }
}
