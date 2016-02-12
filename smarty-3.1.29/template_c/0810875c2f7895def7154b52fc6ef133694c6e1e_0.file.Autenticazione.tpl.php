<?php
/* Smarty version 3.1.29, created on 2016-02-03 02:05:06
  from "/opt/lampp/htdocs/CarSharing/templates/Utente_login.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_56b152429f3a20_96727744',
  'file_dependency' => 
  array (
    '0810875c2f7895def7154b52fc6ef133694c6e1e' => 
    array (
      0 => '/opt/lampp/htdocs/CarSharing/templates/Utente_login.tpl',
      1 => 1454461091,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_56b152429f3a20_96727744 ($_smarty_tpl) {
?>
<div id="container">
    <form id="login_form" name="login" method="get" action="index.php">
        <span>
            <label id="email_label">Inserisci email</label>
            <input type="email" class="input_reg" name="email" id="email" />
        </span>
        <br><br>
        <span>
            <label id="password_label">Inserisci password</label>
            <input type="password" class="input_reg" name="password" id="password" />
        </span>
        <br><br>
        <span>
            <a id="pass_dimenticata">Non ricordo la password.</a>
        </span>
        <div id="accedi_button">
            <input type="submit" value="LOGIN" />
        </div>
    </form>
</div>
<?php }
}
