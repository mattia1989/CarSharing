<div>
    <span id="img_mezzo">
        {$immagine}
    </span>
    <span id="specifiche_id">
        <div id="idMezzo_id">
            ID Mezzo: {$id}
        </div>
        <div id="modello_id">
            Modello: {$modello}
        </div>
        <div id="targa_id">
            Targa: {$targa}
        </div>
        <div id="cilindrata_id">
            Cilindrata: {$cilindrata} cc
        </div>
        <div id="carburante_id">
            Carburante: {$carburante}
        </div>
        <span id="prezzo_id">
            Prezzo giornalier: {$prezzo_giornaliero}
        </span>
        <div>
            <form name="specifiche_mezzo_form" onsubmit="./index.php">
                <input type="hidden" name="controller" value="mezzo" />
                <input type="hidden" name="task" value="lista_mezzi" />
                <input type="submit" name="get_lista_mezzo" value="Torna alla lista mezzi" />
            </form>
        </div>
    </span>
</div>