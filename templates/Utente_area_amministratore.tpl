<!-- CSS -->

<link rel="stylesheet" type="text/css" href="./css/barra_area_amministratore.css">
<link rel="stylesheet" type="text/css" href="./css/dialog_aggiungi_utente.css">

<!-- JAVASCRIPT -->

<script type="text/javascript" src="./js/pannello_amministratore.js"></script>
<script type="text/javascript" src="./jquery-ui-1.11.4.custom/jquery-ui.js"></script>
<script type="text/javascript" src="./jquery/js/jquery.js"></script>

<!-- TEMPLATE -->

<h1>Area amministrativa</h1>
<div id="barra_amministrazione">
    <span>
        <form>
            <div id="radio">
                <input type="radio" id="radio1" name="radio" value="mezzo" checked="checked" ><label for="radio1">Mezzi</label>
                <input type="radio" id="radio2" name="radio" value="parcheggi"><label for="radio2">Parcheggi</label>
                <input type="radio" id="radio3" name="radio" value="prenotazioni"><label for="radio3">Utenti</label>
                <input type="radio" id="radio4" name="radio" value="utente"><label for="radio4">Parcheggi</label>
            </div>
        </form>
    </span>
    <span>
        <form>
            <span>
                <input type="submit" value="lista" />
                <input type="button" value="aggiungi" onclick="return aggiungi();"/>
                <input type="button" value="modifica" />
                <input type="button" value="cancella" />
            </span>
        </form>
    </span>
</div>
<div>{$lista_oggetti}</div>

<!-- DIALOG AGGIUNGI UTENTE -->

<!-- SCRIPT -->

<script>
    $(function() {
        $( "#radio" ).buttonset();
    });

    function aggiungiMezzo() {
        alert('aggiungi mezzo');
    }

    function aggiungiParcheggio() {
        alert('aggiungi parcheggio');
    }

    function aggiungiPrenotazione() {
        alert('aggiungi prenotazione');
        return true;
    }

    // https://jqueryui.com/dialog/#modal-form
    // è identica a quella che serve a me!!!
    function aggiungiUtente() {
        alert('aggiungi utente');
    }

    function aggiungi() {
        // https://jqueryui.com/button/#radio
        // qui utilizzo le finestre modali che hanno anche
        var flag = true;

        if (document.getElementById("radio1").checked) {
            flag = aggiungiMezzo();
        }

        if (document.getElementById("radio2").checked) {
            flag = aggiungiParcheggio();
        }

        if (document.getElementById("radio3").checked) {
            flag = aggiungiPrenotazione();
        }

        if (document.getElementById("radio4").checked) {
            flag = aggiungiUtente();
        }

        return esito(flag);

    }

    function esito(paramEsito) {
        // dialog informativa
        if (paramEsito) {
            alert('Operazione andata a buon fine');
        } else {
            alert('Operazione non andata a buon fine');
        }

        return paramEsito;
    }

</script>