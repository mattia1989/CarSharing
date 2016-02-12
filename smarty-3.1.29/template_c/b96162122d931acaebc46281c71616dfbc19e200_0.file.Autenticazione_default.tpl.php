<?php
/* Smarty version 3.1.29, created on 2016-01-31 18:16:42
  from "/opt/lampp/htdocs/CarSharing/templates/Utente_login.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_56ae417a8def13_44732080',
  'file_dependency' => 
  array (
    'b96162122d931acaebc46281c71616dfbc19e200' => 
    array (
      0 => '/opt/lampp/htdocs/CarSharing/templates/Utente_login.tpl',
      1 => 1454260366,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_56ae417a8def13_44732080 ($_smarty_tpl) {
?>
<div id="container">
    <form id="login_form" name="login" method="get" action="index.php">
        <span>
            <label id="email_label">Inserisci email</label>
            <input type="text" class="input_reg" name="email" id="email" />
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
            <input type="button" value="LOGIN" onClick="myOnClickButton()"/>
        </div>
    </form>
</div>

<?php echo '<script'; ?>
>
    
    function myOnClickButton() {
        $temp = document.getElementById("email");
        if ($temp.value == "" || $temp.value == null) {
            document.getElementById("email").textContent = "Invalid value";
            $temp.value = 'Non è stato inserito nulla!'
            document
        }
        alert($temp.value);
    }

<?php echo '</script'; ?>
><?php }
}
