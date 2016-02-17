<!-- CSS -->

<!-- SCRIPT -->

<script type="text/javascript" src="./js/Autenticazione_validate_jquery.js"></script>
<script type="text/javascript" src="./jquery/js/jquery.validate.js"></script>
<script type="text/javascript" src="./jquery/js/jquery.js"></script>
<script type="text/javascript" src="./js/autenticazione_valida.js"></script>
<script type="text/javascript" src="./js/Calcola_sha1.js"></script>

<!-- TEMPLATE -->

<div id="container">
    <form id="login_form" name="login" method="post" action="index.php" onsubmit="return validaForm();" >

        <span>
            <label id="email_label">Inserisci email</label>
            <input type="email" class="input_field" name="email" id="email_utente_id"/>
        </span>
        <br><br>
        <span>
            <label id="password_label">Inserisci password</label>
            <input type="password" class="input_field" name="password" id="password_utente_id"/>
        </span>
        <br><br>
        <span class="input_field">
            <a href="?controller=utente&task=recuperapsw" id="psw_dimenticata_link">Non ricordo la password.</a>
        </span>
        <div class="input_field" id="login_error">
            <label class="error_field" id="login_error_label">{$login_error}</label>
        </div>
        <input type="hidden" name="controller" value="utente"/>
        <input type="hidden" name="task" value="autentica"/>
        <div id="accedi_button" >
            <input type="submit" value="LOGIN" class="input_field" />
        </div>
    </form>
</div>
