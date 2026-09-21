<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="utf-8">
    <title>Controllo scraping</title>
</head>
<body style="font-family:-apple-system,Segoe UI,Roboto,Helvetica,Arial,sans-serif;color:#1f2328;line-height:1.5">

    <h2 style="margin-bottom:4px">Controllo scraping - Pronto Soccorso Live</h2>
    <p style="margin-top:0;color:#57606a">Eseguito il {{ $eseguitoIl }} &middot; durata {{ $riepilogo['durata'] }}s</p>

    <table cellpadding="8" cellspacing="0" style="border-collapse:collapse;margin:16px 0">
        <tr>
            <td style="border:1px solid #d0d7de;background:#f6f8fa"><strong>Sorgenti</strong></td>
            <td style="border:1px solid #d0d7de">{{ $riepilogo['sorgenti'] }}</td>
            <td style="border:1px solid #d0d7de;background:#f6f8fa"><strong>Ospedali con dati</strong></td>
            <td style="border:1px solid #d0d7de">{{ $riepilogo['ospedaliConDati'] }} / {{ $riepilogo['ospedaliAttesi'] }}</td>
        </tr>
        <tr>
            <td style="border:1px solid #d0d7de;background:#f6f8fa"><strong>Ok</strong></td>
            <td style="border:1px solid #d0d7de">{{ $riepilogo['ok'] }}</td>
            <td style="border:1px solid #d0d7de;background:#f6f8fa"><strong>Parziali / Falliti</strong></td>
            <td style="border:1px solid #d0d7de">{{ $riepilogo['parziali'] }} / {{ $riepilogo['falliti'] }}</td>
        </tr>
    </table>

    @if(count($falliti))
        <h3 style="color:#cf222e">Falliti ({{ count($falliti) }})</h3>
        <table cellpadding="6" cellspacing="0" style="border-collapse:collapse;width:100%;font-size:14px">
            <tr style="background:#f6f8fa">
                <th align="left" style="border:1px solid #d0d7de">Sorgente</th>
                <th align="left" style="border:1px solid #d0d7de">Job</th>
                <th align="left" style="border:1px solid #d0d7de">Tent.</th>
                <th align="left" style="border:1px solid #d0d7de">Motivo</th>
            </tr>
            @foreach($falliti as $e)
                <tr>
                    <td style="border:1px solid #d0d7de">
                        {{ $e['sorgente'] }}
                        @if($e['url'])
                            <br><a href="{{ $e['url'] }}" style="color:#57606a;font-size:12px">{{ \Illuminate\Support\Str::limit($e['url'], 70) }}</a>
                        @endif
                    </td>
                    <td style="border:1px solid #d0d7de">{{ $e['job'] }}</td>
                    <td style="border:1px solid #d0d7de">{{ $e['tentativi'] ?? 1 }}</td>
                    <td style="border:1px solid #d0d7de">{{ $e['motivo'] }}</td>
                </tr>
            @endforeach
        </table>
    @endif

    @if(count($parziali))
        <h3 style="color:#9a6700">Parziali ({{ count($parziali) }})</h3>
        <p style="margin-top:0;color:#57606a;font-size:14px">
            La sorgente risponde, ma alcuni ospedali restano senza dati: di solito il portale
            ha rinominato o rimosso un presidio.
        </p>
        <table cellpadding="6" cellspacing="0" style="border-collapse:collapse;width:100%;font-size:14px">
            <tr style="background:#f6f8fa">
                <th align="left" style="border:1px solid #d0d7de">Sorgente</th>
                <th align="left" style="border:1px solid #d0d7de">Ospedali</th>
                <th align="left" style="border:1px solid #d0d7de">Motivo</th>
            </tr>
            @foreach($parziali as $e)
                <tr>
                    <td style="border:1px solid #d0d7de">{{ $e['sorgente'] }}</td>
                    <td style="border:1px solid #d0d7de">{{ $e['conDati'] }}/{{ $e['attesi'] }}</td>
                    <td style="border:1px solid #d0d7de">{{ $e['motivo'] }}</td>
                </tr>
            @endforeach
        </table>
    @endif

    @if(count($riusciti))
        <h3 style="color:#1a7f37">Riusciti ({{ count($riusciti) }})</h3>
        <table cellpadding="6" cellspacing="0" style="border-collapse:collapse;width:100%;font-size:14px">
            <tr style="background:#f6f8fa">
                <th align="left" style="border:1px solid #d0d7de">Sorgente</th>
                <th align="left" style="border:1px solid #d0d7de">Ospedali</th>
                <th align="left" style="border:1px solid #d0d7de">Sec.</th>
            </tr>
            @foreach($riusciti as $e)
                <tr>
                    <td style="border:1px solid #d0d7de">{{ $e['sorgente'] }}</td>
                    <td style="border:1px solid #d0d7de">{{ $e['conDati'] }}/{{ $e['attesi'] }}</td>
                    <td style="border:1px solid #d0d7de">{{ $e['durata'] }}</td>
                </tr>
            @endforeach
        </table>
    @endif

    <p style="color:#57606a;font-size:12px;margin-top:24px">
        Riepilogo automatico del comando <code>scrape:check</code>.
    </p>
</body>
</html>
