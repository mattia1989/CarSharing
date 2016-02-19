<!-- CSS -->

<link rel="stylesheet" type="text/css" href="./css/mezzo_specifiche.css">

<!-- TEMPLATE -->

<div>
    <span id="specifiche_mezzo_image">
        <img src="./templates/getImageMezzo.php&immagine={$id}">
        {*{$immagine}*}
    </span>
    <span class="specifiche_mezzo">
        <div>
            ID Mezzo: {$id}
        </div>
        <div>
            Modello: {$modello}
        </div>
        <div>
            Targa: {$targa}
        </div>
        <div>
            Cilindrata: {$cilindrata} cc
        </div>
        <div>
            Carburante: {$carburante}
        </div>
        <span>
            Prezzo giornalier: {$prezzo_giornaliero}
        </span>
    </span>
    <span id="button_specifiche">
        <form name="specifiche_mezzo_form" onsubmit="./index.php">
            <input type="hidden" name="controller" value="mezzo" />
            <input type="hidden" name="task" value="lista_mezzi" />
            <input type="submit" name="get_lista_mezzo" value="Torna alla lista mezzi" />
        </form>
    </span>
</div>