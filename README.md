# Prontosoccorso API

Questa applicazione è un backend API sviluppato in Laravel che aggrega e fornisce in tempo reale i tempi di attesa dei Pronto Soccorso di varie regioni italiane.

L'applicazione recupera i dati attraverso tecniche di scraping o chiamate API dirette ai portali sanitari regionali e normalizza le informazioni per essere consumate da client esterni.

> **Nota**: Esiste una controparte client scritta interamente in JavaScript (Nuxt 3) che consuma queste API. Il codice sorgente è disponibile qui: [roberto-calabrese/prontosoccorso_client](https://github.com/roberto-calabrese/prontosoccorso_client).

## Funzionalità Principali

*   **Aggregazione Dati**: Supporto per diverse regioni e province italiane (es. Campania, Toscana, Piemonte, Veneto, Sicilia, Liguria, Calabria).
*   **Real-time**: Utilizzo di **Pusher** per inviare aggiornamenti in tempo reale ai client connessi quando i dati vengono aggiornati.
*   **Caching**: Sistema di caching (Redis o File) per ridurre il carico sui siti sorgente e migliorare le performance di risposta.
*   **Architettura a Code**: Integrazione con Laravel Horizon/Queue per gestire le operazioni di scraping in background in modo asincrono, evitando di bloccare le richieste HTTP.
*   **Configurazione Flessibile**: Ogni regione/provincia ha file di configurazione dedicati (`config/regioni`) per definire gli ospedali, gli URL e i selettori CSS/XPath per l'estrazione dei dati.

## Requisiti

*   PHP 8.1 o superiore
*   Composer
*   Redis (consigliato per la gestione delle code e caching avanzato)
*   Account Pusher (necessario per le funzionalità real-time)

## Installazione

1.  **Clonare la repository:**
    ```bash
    git clone <repository-url>
    cd prontosoccorso_api
    ```

2.  **Installare le dipendenze PHP:**
    ```bash
    composer install
    ```

3.  **Configurazione Ambiente:**
    Copia il file `.env.example` in `.env`:
    ```bash
    cp .env.example .env
    ```
    Configura le variabili d'ambiente nel file `.env`, prestando attenzione a:
    *   `DB_*`: Configurazione Database (se necessario per Horizon/Log)
    *   `REDIS_*`: Configurazione Redis
    *   `PUSHER_*`: Credenziali Pusher
    *   `QUEUE_CONNECTION`: Imposta su `redis` per l'asincronicità o `sync` per il debug locale.

4.  **Generare la chiave dell'applicazione:**
    ```bash
    php artisan key:generate
    ```

## Struttura e Configurazione

La logica di scraping è definita nei file di configurazione all'interno di `config/regioni/`.
Ogni file (es. `config/regioni/campania/caserta.php`) contiene:
*   `jobClass`: La classe Job responsabile del recupero dati (es. `GenericScrapeJob`).
*   `url`: L'URL della fonte dati.
*   `data`: Mappa dei selettori CSS/XPath per estrarre i dati relativi ai codici di priorità (Rosso, Arancione, Azzurro, Verde, Bianco).

### Aggiungere una nuova fonte
Per aggiungere un nuovo ospedale o provincia, è sufficiente creare un nuovo file di configurazione nella cartella appropriata e definire i selettori corretti per il parsing della pagina HTML target.

## Utilizzo

### Avvio Server di Sviluppo
```bash
php artisan serve
```

### Gestione delle Code (Opzionale ma raccomandato)
Se `QUEUE_CONNECTION` è impostato su `redis`, è necessario avviare il worker per processare i job di scraping:
```bash
php artisan horizon
# oppure
php artisan queue:work
```

## API Endpoints

Le rotte principali sono definite in `routes/api.php`:

*   `GET /api/regioni`: Restituisce l'elenco delle regioni configurate.
*   `GET /api/{regione}`: Restituisce i dati aggregati e i metadati per una regione.
*   `GET /api/{regione}/{provincia}`: Endpoint principale per ottenere i dati di una provincia.

### Flusso di recupero dati
Quando viene richiesta una provincia (`/api/{regione}/{provincia}`):
1.  Il controller `ApiProvinciaController` verifica la configurazione.
2.  Il servizio `GenericDataService` controlla la **Cache**.
    *   **Cache Hit**: Restituisce immediatamente i dati salvati.
    *   **Cache Miss**:
        *   Se i WebSocket sono attivi (Queue Redis): Lancia un Job in background e restituisce una risposta vuota o parziale. Il client riceverà i dati via evento Pusher una volta completato lo scraping.
        *   Se i WebSocket non sono attivi (Sync): Esegue lo scraping in tempo reale (attendendo la risposta HTTP della fonte) e restituisce i dati nella risposta API.
