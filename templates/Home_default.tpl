<!DOCTYPE html>

<html>
    
    <!-- HEAD -->
    
    <head>

        <title>CarSharing</title>
        
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <!-- CSS -->
        
        <link rel="stylesheet" type="text/css" href="./css/default.css" />
        
        <!-- JAVASCRIPT -->

        <script type="text/javascript" src="./js/jquery/jquery.js" ></script>
        <script type="text/javascript" src="./js/jquery/jquery.validate.js" ></script>

    </head>
    
    <!-- BODY -->
    
    <body>
        
        <!-- TOP -->
        
        <div id="top">
            
            <a href="index.php">
                <div id="logo_zone">
                    Qui devo mettere l'immagine
                </div>
            </a>
            
            <div id="navbar">
                {$navbar}
            </div>
        </div>
        
        <!-- CONTENT -->
            
        <div id="content" onsubmit="loadContent()">
            {$content}
        </div>
        
        <!-- BOTTOM -->
        
        <div id="bottom">
            {$bottom}
        </div>

        <!-- Javascript Disattivato -->
        <noscript>
            <div class="javascriptdisattivato">
                <br/> <br/> <br/> <br/> <br/> <br/> <br/> <br/> <br/> <br/><br/> <br/> <br/> <br/> <br/>
                HAI JAVASCRIPT DISATTIVATO: <br/> <br/> PER UTILIZZARE L'APPLICAZIONE DEVI ATTIVARLO OPPURE AGGIORNARE IL TUO BROWSER AD UNA VERSIONE RECENTE.
            </div>
        </noscript>
        
    </body>
    
</html>

{*<script>
    function loadContent() {
        alert('caricato');

        var xhttp = new XMLHttpRequest();
        var myXml = xhttp.responseXML;
        xhttp.onreadystatechange = function() {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                myXml = xhttp.responseXML;
                alert('prendo il responso');
                document.getElementById("content").innerHTML = myXml;
                alert('dopo');
            }
        };
        xhttp.open("GET", "./index.php", true);
        xhttp.send();

    }
</script>*}
