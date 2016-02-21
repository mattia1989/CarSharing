<!-- CSS -->

<link rel="stylesheet" type="text/css" href="./css/prenotazione_specifiche.css">

<!-- TEMPLATE -->

<div>
    <span id="specifiche_mezzo_image">
        <img src="./templates/getImageMezzo.php&immagine={$id}">
    </span>
    <form name="prenota_form" method="get" action="./index.php" >
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
            <div class="stato_class">
                Stato: {$stato}
            </div>
            <div class="stato_class">
                Parcheggiata presso: {$id_park} {$indirizzo_park} {$citta_park} {$provincia_park}
            </div>
        </span>
    </form>
    <form name="effetta_prenotazione" method="get" action="./index.php">
        <input type="hidden" name="controller" value="prenotazione" />
        <input type="hidden" name="task" value="aggiungi" />
        <input type="hidden" name="id_mezzo" value="{$id}" />
        <input type="hidden" name="id_park" value="{$id_park}" />
        <input type="submit" name="effettua_prenotazione_button" value="PRENOTA!" />
    </form>
    <span id="button_specifiche">
        <form name="annulla_prenotazione_form" onsubmit="./index.php">
            <input type="hidden" name="controller" value="prenotazione" />
            <input type="hidden" name="task" value="lista_disponibilita" />
            <input type="submit" name="get_lista_mezzo" value="Torna alla lista" />
        </form>
    </span>
</div>