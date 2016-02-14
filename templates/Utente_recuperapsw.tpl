<div id="container">
    <form action="index.php" method="post" id="recupera_psw_form" name="recupera_form" onsubmit="return validaForm();">
        <label id="recupera_psw_label" >Inserisci l'indirizzo e-mail</label>
        <input id="recupera_psw_input" type="email" name="recupera_psw" />
        <input type="hidden" name="controller" value="utente"/>
        <input type="hidden" name="task" value="redirect"/>
        <div id="recupera_button">
            <input type="submit" value="RECUPERA" />
        </div>
    </form>
</div>

<script type="text/javascript" >
    function validaForm() {

        var _email = document.getElementById("recupera_psw");

        if (_email.length==0 || _email.length==null) {
            alert('invalid value');
            return false;
        } else {
            alert('good value');
            return true;
        }
    }
</script>
