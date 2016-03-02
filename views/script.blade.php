<script>
window.LaravelSurvivor = {
    token: '{{ $token }}',
    interval: setInterval(function() {
        var e=window.XMLHttpRequest?new XMLHttpRequest:new ActiveXObject('Microsoft.XMLHTTP');
        e.onreadystatechange = function() { if (e.readyState == XMLHttpRequest.DONE && e.responseText) {
        var response = JSON.parse(e.responseText);
        if (response && response._token) {
            window.LaravelSurvivor.token = response._token;
            var meta   = document.querySelectorAll('meta[name=csrf-token]');
            var inputs = document.querySelectorAll('input[name=_token]');

            if (meta) {
                meta[0].setAttribute("content", response._token);
            }

            if (inputs) {
                for (i = 0; i < inputs.length; i++) {
                    inputs[i].value = response._token;
                }
            }
        }}};
        e.open('GET','{{ $url }}',!0);
        e.setRequestHeader('X-Requested-With','XMLHttpRequest');
        e.setRequestHeader('X-CSRF-TOKEN', window.LaravelSurvivor.token);
        e.send();
    }, {{ $interval }})
};
</script>
