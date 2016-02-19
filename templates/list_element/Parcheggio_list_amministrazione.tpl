<!-- CSS -->

<link rel="stylesheet" type="text/css" href="./css/parcheggio_element.css">

<!-- TEMPLATE -->

<div id="element_id">

    <span class="parcheggio_element">
        <div>
            ID Parcheggio: {$id}
        </div>
        <div>
            Indirizzo Parcheggio: {$indirizzo}
        </div>
        <div>
            Citta parcheggio: {$citta}
        </div>
    </span>
    <span id="button_visualizza_specifiche">
        <form name="cancella_pacheggio_form" method="get">
        <input type="hidden" name="controller" value="parcheggio" />
        <input type="hidden" name="task" value="cancella_parcheggio" />
        <input type="hidden" name="id_parcheggio" value="{$id}" />
        <input type="submit" name="get_specifiche_mezzo" value="Cancella" />
        </form>
    </span>
</div>
