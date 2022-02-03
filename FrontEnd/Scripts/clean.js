include('https://unpkg.com/validator@latest/validator.min.js');


jQuery(document).ready(function($) {
    addListener();
});


function addListener() {
    document.querySelector('#read_Promotions').addEventListener('click', function(event) {
        cleanV1('is:read category:promotions');
    });

    document.querySelector('#promotions').addEventListener('click', function(event) {
        cleanV1('category:promotions');
    });

    document.querySelector('#social').addEventListener('click', function(event) {
        cleanV1('category:social');
    });

    document.querySelector('#forums').addEventListener('click', function(event) {
        cleanV1('category:forums');
    });
}


function cleanV1(query) {
    $.post("../Backend/mailManagement/mailController.php", { query: query }, function(data) {
        let resultQuery = JSON.parse(data);
        let nbMailDelete = resultQuery['nbmMails'];
        let allSnippet = resultQuery['mailSnippet'];

        let nbMailDiv = document.querySelector('#result');
        //mailResult.innerHTML = "<p>" + resultQuery['mailSnippet']; + "</p>";

        if (nbMailDelete > 0) {
            addMailsDom(allSnippet);
            nbMailDiv.innerHTML = "Congratulation you have delete <span id='mailNumber'>" + nbMailDelete + "</span> mails!!";
        } else
            nbMailDiv.innerHTML = nbMailDelete + " mails found :(";
    });
}

function addMailsDom(allSnippet) {
    allSnippet.forEach(snippet =>
        addLi(snippet.toLowerCase().slice(0, 40))
    );
}

function addLi(item) {
    var list = document.querySelector('#mailResult');
    var newLI = document.createElement('li');
    newLI.innerHTML = "❌ <span id= 'author'>Spartoo: </span>" + item + "...";
    newLI.className = newLI.className + " deleteMail";

    list.prepend(newLI);
    setTimeout(function() {
        newLI.className = newLI.className + " show";
    }, 10);
}

function include(file) {
    var script = document.createElement('script');
    script.src = file;
    script.type = 'text/javascript';
    script.defer = true;

    document.getElementsByTagName('head').item(0).appendChild(script);

}


/*
"SyntaxError: Unexpected end of JSON input
    at JSON.parse (<anonymous>)
    at Object.success (http://localhost:8000/FrontEnd/Scripts/clean.js:18:24)
    at fire (http://code.jquery.com/jquery-latest.js:3119:30)
    at Object.fireWith [as resolveWith] (http://code.jquery.com/jquery-latest.js:3231:7)
    at done (http://code.jquery.com/jquery-latest.js:9275:14)
    at XMLHttpRequest.callback (http://code.jquery.com/jquery-latest.js:9685:8)"
*/