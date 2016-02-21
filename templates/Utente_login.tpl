<!-- CSS -->

<!-- TEMPLATE -->

<div id="container">
    <form id="login_form" name="login" method="post" action="index.php" onsubmit="return validaForm();" >
        <fieldset>
            <legend class="input_field">Accedi</legend>
            <table align="center">
                <tr>
                    <td><label for="email">Inserisci email</label></td>
                    <td><input type="email" class="input_field" name="email" id="email_id"/></td>
                </tr>
                <tr>
                    <td><label id="password">Inserisci password</label></td>
                    <td><input type="password" class="input_field" name="password" id="password_id"/></td>
                </tr>
            </table>
            <a class="input_field" href="?controller=utente&task=recuperapsw" id="psw_dimenticata_link">Non ricordo la password.</a>
            <div class="input_field" id="login_error" align="center">
                <label class="error_field" id="login_error_label">{$login_error}</label>
            </div>
            <input type="hidden" name="controller" value="utente" />
            <input type="hidden" name="task" value="autentica" />
            <div id="accedi_button" >
                <input type="submit" align="center" value="LOGIN" class="input_field" />
            </div>
        </fieldset>
    </form>
</div>

<!-- SCRIPT -->

<script type="text/javascript" src="./js/Autenticazione_validate_check.js"></script>
<script type="text/javascript" src="./js/autenticazione_valida.js"></script>
<script type="text/javascript" src="./js/Calcola_sha1.js"></script>