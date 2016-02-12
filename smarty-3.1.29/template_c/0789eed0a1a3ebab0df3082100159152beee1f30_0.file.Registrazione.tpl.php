<?php
/* Smarty version 3.1.29, created on 2016-02-02 23:31:54
  from "/opt/lampp/htdocs/CarSharing/templates/Utente_registrazione.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_56b12e5ae04d22_94254048',
  'file_dependency' => 
  array (
    '0789eed0a1a3ebab0df3082100159152beee1f30' => 
    array (
      0 => '/opt/lampp/htdocs/CarSharing/templates/Utente_registrazione.tpl',
      1 => 1454452259,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_56b12e5ae04d22_94254048 ($_smarty_tpl) {
?>
<div id="content" xmlns="http://www.w3.org/1999/html">
    <form id="registration_form" name="signin" method="get" action="index.php">
        <div>
            <label id="name_label">Nome: </label>
            <input type="text" class="input_reg" name="username" id="username_input" />
        </div>
        <div>
            <div>
                <label id="new_password_label">Nuova Passoword: </label>
                <input type="password" class="input_reg" name="password" id="password_input" />
            </div>
            <div>
                <label id="r_new_password_label">Re-inserire la nuova password: </label>
                <input type="password" class="input_reg" name="rpassword" id="r_password_input" />
            </div>
        </div>
        <div>
            <label id="new_email_label">E-mail: </label>
            <input type="email" class="input_reg" name="email" id="new_email_input">
        </div>
        <div>
            <label id="document_label">Numero del documento: </label>
            <input type="text" class="input_reg" name="new_n_documento" id="new_n_documento_input">
        </div>
        <div>
            <input type="checkbox" class="input_reg" name="normative" id="normative_checkbox">
                Si accetta tutto il sacramento dell'altare maggiore e minore che sia.
            </input>
        </div>
        <div>
            <input type="submit" value="REGISTRATI" onClick="onClickRegister()" />
        </div>
    </form>
</div>

<?php echo '<script'; ?>
>
    function onClickRegister() {

        var myCheckBox = document.getElementById("normative_checkbox");
        var tempTxt;
        if (myCheckBox.checked) {
            tempTxt = checkValue();
        } else {
            tempTxt = "Not Checked";
        }
        alert(tempTxt);
    }

    function checkValue() {

        var alertString;
        if (document.getElementById("password_input").valueOf() == null || document.getElementById("password_input").valueOf() == "") {
            alertString = "Almeno un valore non è valido";
        } else {
            alertString = "true";
        }
        return alertString;
    }
<?php echo '</script'; ?>
><?php }
}
