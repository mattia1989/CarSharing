<!-- SCRIPT -->

<!--<script type="text/javascript" src="./js/registrazione_valida.js"></script>-->

<!-- TEMPLATE -->

<div id="content" xmlns="http://www.w3.org/1999/html">
    <form id="aggiungimezzo_id" name="aggiungimezzo" method="post" action="index.php" enctype="multipart/form-data">
        <div>
            <div>
                <label  id="targalabel_id" class="input_field">Targa: </label>
                <input type="text" name="targa" id="targa_id">
            </div>
            <div>
                <label id="modellolabel_id" class="input_field">Modello: </label>
                <input type="text"  class="input_field" name="modello" id="modell_id" />
            </div>
            <div>
                <label id="cilindratalabel_id" class="input_field">Cilindrata: </label>
                <input type="text" class="input_field" name="cilindrata" id="cilindrata_id" />
            </div>
        </div>
        <div>
            <label id="carburantelabel_id" class="input_field" >Carburante: </label>
            <input type="text" class="input_field" name="carburante" id="carburante_id" />
        </div>
        <div>
            <label id="kmlabel_id" class="input_field" >Km: </label>
            <input type="text"  name="km" id="km_id">
        </div>
        <div>
            <label id="colorelabel_id" class="input_field">Colore: </label>
            <input type="text" id="colore_id" class="input_field" name="colore" />
        </div>
        <div>
            <label id="prezzo_giornaliero_label_id" class="input_field">Colore: </label>
            <input type="text" id="prezzo_giornaliero_id" class="input_field" name="prezzo_giornaliero" />
        </div>
        <div>
            <label id="immaginelabel_id" class="input_field">Immagine:</label>
            <input type="file" id="immagine_id" class="input_field" name="immagine" />
        </div>
        <div>
            <label id="statolabel_id" class="input_field">Stato:</label>
            <input type="text" class="input_field" name="stato" id="statoinput_id" />
        </div>
        <div id="aggiungi_mezzo_error">
            <label class="error_field" id="registrazione_error_label">{$var_error}</label>
        </div>
        <input type="hidden" name="controller" value="mezzo"/>
        <input type="hidden" name="task" value="salva"/>
        <div>
            <input type="submit" class="input_field" value="SALVA" />
        </div>
    </form>
    <form method="get" action="./index.php">
        <input type="hidden" name="controller" value="mezzo" />
        <input type="hidden" name="task" value="lista_mezzi_amministrazione" />
        <input type="submit" class="input_field" name="return_button" value="Torna alla lista" />
    </form>
</div>
