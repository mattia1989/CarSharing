<!-- SCRIPT -->

{*<script type="text/javascript" src="./js/Autenticazione_validate_check.js" ></script>*}
{*<script type="text/javascript" src="./jquery/js/jquery.validate.js" ></script>*}
<script type="text/javascript" src="./js/autenticazione_valida.js"></script>

<!-- TEMPLATE -->

<div id="container">
    <form id="login_form" name="login" method="get" action="index.php" onsubmit="return $.valid();" >
        <span>
            <label id="login_error_label">{$login_error}</label>
        </span>
        <span>
            <label id="email_label">Inserisci email</label>
            <input type="email" class="input_reg" name="email" id="email_utente_id"/>
        </span>
        <br><br>
        <span>
            <label id="password_label">Inserisci password</label>
            <input type="password" class="input_reg" name="password" id="password_utente_id"/>
        </span>
        <br><br>
        <span>
            <a href="?controller=utente&task=recupera_password" id="psw_dimenticata_link">Non ricordo la password.</a>
        </span>
        <div id="accedi_button">
            <input type="submit" value="LOGIN" />
        </div>
    </form>
</div>
