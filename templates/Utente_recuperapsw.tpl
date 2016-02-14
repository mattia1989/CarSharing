<script type="text/javascript" src="./js/recupera_valida.js"></script>

<div id="container">
    <form action="index.php" method="get" id="recupera_psw_form" name="recupera_form" class="input_field" onsubmit="return validaForm();">
        <label id="recupera_psw_label" class="input_field" >Inserisci l'indirizzo e-mail</label>
        <input id="recupera_psw_input" class="input_field" type="email" name="email_recupero" />
        <div class="input_field" id="recupero_error">
            <label id="recupero_error_label" class="input_field">{$recupero_error}</label>
        </div>
        <input type="hidden" name="controller" value="utente"/>
        <input type="hidden" name="task" value="redirectpsw"/>
        <div id="recupera_button">
            <input class="input_field" type="submit" value="RECUPERA" />
        </div>
    </form>
</div>

