<!DOCTYPE html>
<html>
<head>
    <title>Scraping fallito</title>
</head>
<body>
    <h2>⚠️ Scraping fallito - Pronto Soccorso Live</h2>
    <p>Un job di raccolta dati non è andato a buon fine.</p>
    <p><strong>Sorgente:</strong> {{ $source }}</p>
    <p><strong>Motivo:</strong> {{ $reason }}</p>
    @if($jobClass)
        <p><strong>Job:</strong> {{ $jobClass }}</p>
    @endif
    @if($url)
        <p><strong>URL fonte:</strong> <a href="{{ $url }}">{{ $url }}</a></p>
    @endif
    @if($details)
        <p><strong>Dettaglio:</strong></p>
        <pre style="white-space:pre-wrap;background:#f4f4f4;padding:10px;border-radius:6px">{{ $details }}</pre>
    @endif
    <p><strong>Data/ora:</strong> {{ $occurredAt }}</p>
</body>
</html>
