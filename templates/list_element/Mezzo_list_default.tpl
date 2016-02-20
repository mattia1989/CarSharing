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
            Stato veicolo: {$statoMezzo}
        </div>
    </span>
    <span id="mezzo_image">
        <img src="./templates/getImageMezzo.php&immagine={$idMezzo}">
        {*{$immagineMezzo}*}
    </span>
    <span id="button_visualizza_specifiche">
        <form name="specifiche_mezzo_form" method="get">
            <input type="hidden" name="controller" value="mezzo" />
            <input type="hidden" name="task" value="specifiche_mezzo" />
            <input type="hidden" name="id_mezzo" value="{$idMezzo}" />
            <input type="submit" name="get_specifiche_mezzo" value="Visualizza specifiche" />
        </form>
    </span>
</div>
