<!-- CSS -->

<link rel="stylesheet" type="text/css" href="./css/mezzo_element.css">

<!-- TEMPLATE -->

<div id="element_id">

    <span class="mezzo_element">
        <div>
            ID Mezzo: {$idMezzo}
        </div>
        <div>
            Modello: {$modelloMezzo}
        </div>
        <div>
            Targa: {$targaMezzo}
        </div>
        <div>
            Carburante: {$carburanteMezzo}
        </div>
        <div>
            Modello: {$modelloMezzo}
        </div>
        <div>
            Prezzo giornalier: {$prezzoMezzo}
        </div>
        <div>
            Stato: {$statoMezzo}
        </div>
        <div>
            {$cambiaStatoMezzo}
        </div>
    </span>
    <span id="mezzo_image">
        <img src="./templates/getImageMezzo.php&immagine={$idMezzo}">
    </span>
    <span id="button_visualizza_specifiche">
        <form name="specifiche_mezzo_form" method="post">
            <input type="hidden" name="controller" value="mezzo" />
            <input type="hidden" name="task" value="cancella_mezzo" />
            <input type="hidden" name="id_mezzo" value="{$idMezzo}" />
            <input type="submit" id="cancella_mezzo_button" name="cancella_mezzo" value="Cancella" />
        </form>
    </span>
</div>

