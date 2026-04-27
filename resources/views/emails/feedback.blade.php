<!DOCTYPE html>
<html>
<head>
    <title>Nuovo Feedback</title>
</head>
<body>
    <h2>Nuovo Feedback o Segnalazione da Pronto Soccorso Live</h2>
    <p><strong>Nome:</strong> {{ $name }}</p>
    <p><strong>Email:</strong> {{ $email }}</p>
    @if($url)
        <p><strong>Pagina di provenienza:</strong> <a href="{{ $url }}">{{ $url }}</a></p>
    @endif
    <p><strong>Messaggio:</strong></p>
    <p>{{ $messageContent }}</p>
</body>
</html>