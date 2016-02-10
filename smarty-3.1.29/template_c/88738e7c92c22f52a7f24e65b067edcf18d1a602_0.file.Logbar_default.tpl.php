<?php
/* Smarty version 3.1.29, created on 2016-02-03 01:14:18
  from "/opt/lampp/htdocs/CarSharing/templates/Logbar_default.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_56b1465aa97a59_44135312',
  'file_dependency' => 
  array (
    '88738e7c92c22f52a7f24e65b067edcf18d1a602' => 
    array (
      0 => '/opt/lampp/htdocs/CarSharing/templates/Logbar_default.tpl',
      1 => 1454458340,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_56b1465aa97a59_44135312 ($_smarty_tpl) {
?>
<nav>
    <ul>
        <li>
            Benvenuto!
        </li>
        <li>
            <!-- il prossimo link deve settare il template di accesso -->
            <a href="?controller=utente&task=login">ACCEDI</a>
        <li>
            <!-- qui invece devo inserire il template di registrazione -->
            <a href="?controller=utente&task=registrazione">REGISTRATI</a>
        </li>
    </ul>
    <ul>
        <div id="navbar_search">
            <!-- vado alla pagina di richiesta -->
            <a href="">DEVI PARTIRE? CLICCA QUI!</a>
        </div>
    </ul>
</nav>
<?php }
}
