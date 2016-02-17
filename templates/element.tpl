<div id="element_id">
    <span id="img_id">
        {$immagineMezzo}
    </span>
    <span id="specifiche_id">
        <div id="idMezzo_id">
            ID Mezzo: {$idMezzo}
        </div>
        <div>
            <span id="modello_id">
                Modello: {$modelloMezzo}
            </span>
            <span id="targa_id">
                Targa: {$targaMezzo}
            </span>
        </div>
        <div>
            <span id="carburante_id">
                Carburante: {$carburanteMezzo}
            </span>
            <span id="prezzo_id">
                Prezzo giornalier: {$prezzoMezzo}
            </span>
            <span id="seleziona_mezzo_id">
                <form name="specifiche_mezzo_form" method="get">
                    <input type="hidden" name="controller" value="mezzo" />
                    <input type="hidden" name="task" value="specifiche_mezzo" />
                    <input type="hidden" name="id_mezzo" value="{$idMezzo}" />
                    <input type="submit" name="get_specifiche_mezzo" value="Visualizza specifiche" />
                </form>
            </span>
        </div>
    </span>
</div>