<!-- SCRIPT -->

<script type="text/javascript" src="./js/registrazione_valida.js"></script>
<script type="text/javascript" src="./js/Calcola_sha1.js"></script>

<!-- TEMPLATE -->

<div id="content" xmlns="http://www.w3.org/1999/html">
    <form id="registration_form_id" name="registration_form" method="post" action="index.php" onsubmit="return validaFormRegistrazione();">
        <div>
            <div>
                <label  id="new_email_label" class="input_field">E-mail: </label>
                <input type="email" name="email" id="new_email_input">
            </div>
            <div>
                <label id="password_label" class="input_field">Passoword: </label>
                <input type="password"  class="input_field" name="password" id="password_id" />
            </div>
            <div>
                <label id="r_password_label" class="input_field">Re-inserire la password: </label>
                <input type="password" class="input_field" name="ripeti_password" id="r_password_id" />
            </div>
        </div>
        <div>
            <label id="name_label" class="input_field" >Nome: </label>
            <input type="text" class="input_field" name="nome" id="username_input" />
        </div>
        <div>
            <label id="document_label" class="input_field" >Numero del documento: </label>
            <input type="text"  name="nDocumento" id="n_docuemnto_id">
        </div>
        <div>
            <input type="checkbox" class="input_field" name="normative" id="normative_id">
                <span class="input_field" >
                    "Si accetta tutto il sacramento dell'altare maggiore e minore che sia."
                </span>
            </input>
        </div>
        <div id="var_error">
            <label class="error_field" id="registrazione_error_label">{$var_error}</label>
        </div>
        <input type="hidden" name="controller" value="utente"/>
        <input type="hidden" name="task" value="registra"/>
        <div>
            <input type="submit" class="input_field" value="REGISTRATI" />
        </div>
    </form>
</div>
