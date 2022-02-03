include('https://unpkg.com/validator@latest/validator.min.js');


jQuery(document).ready(function($) {
    addListener();
});


function addListener() {
    document.querySelector('#startCleaning').addEventListener('click', function(event) {
        authenticate();
    });
}

function authenticate() {
    $.post("./Backend/Authentification/login.php", {}, function(data) {
        let res = JSON.parse(data);
        document.location.href = res['redirect'];
    });
}


function include(file) {
    var script = document.createElement('script');
    script.src = file;
    script.type = 'text/javascript';
    script.defer = true;

    document.getElementsByTagName('head').item(0).appendChild(script);

}
