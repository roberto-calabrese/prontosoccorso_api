<!DOCTYPE html>
<head>
    <title>Pusher Test</title>
</head>
<body>
<h1>Pusher Test</h1>
<p>
    Publish an event to channel <code>my-channel</code>
    with event name <code>my-event</code>; it will appear below:
</p>
<div id="app">
    <ul>

    </ul>
</div>

<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script>
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('c1f2549429dae80f0d0c', {
        cluster: 'eu'
    });

    var channel = pusher.subscribe('sicilia.palermo');
    channel.bind('sicilia-palermo', function(data) {
        console.log(data);
    });

    // Vue application
    const app = new Vue({
        el: '#app',
        data: {
            messages: [],
        },
    });
</script>
</body>
