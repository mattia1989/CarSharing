<div id="container">
    <form action="index.php" method="post" id="recupera_psw_form" name="recupera_form" onsubmit="return validaForm();">
        <!-- inserire la casella di input col tasto submit -->
        <label id="recupera_psw_label" >Inserisci l'indirizzo e-mail</label>
        <input id="recupera_psw_input" type="email" name="recupera_psw" />
        <div id="recupera_button">
            <input type="submit" value="RECUPERA" />
        </div>
    </form>
</div>

<script type="text/javascript" >
    function validaForm() {
        var _tagForm = document.forms['recupera_form'];
        var _email = _tagForm['recupera_password'];

        if (_email.length==0 || _email.length==null) {
            alert('invalid value');
            return false;
        } else {
            alert('good value');
            return true;
        }
    }
</script>
