<?php
/* Smarty version 3.1.29, created on 2016-02-02 15:29:41
  from "/opt/lampp/htdocs/CarSharing/templates/Home_default.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_56b0bd5517d659_73096968',
  'file_dependency' => 
  array (
    '8821eb1993525cf3dcbd0ce09d61cac92a84246a' => 
    array (
      0 => '/opt/lampp/htdocs/CarSharing/templates/Home_default.tpl',
      1 => 1454423288,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_56b0bd5517d659_73096968 ($_smarty_tpl) {
?>
<!DOCTYPE html>

<html>
    
    <!-- HEAD -->
    
    <head>

        <title>CarSharing</title>
        
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <!-- CSS -->
        
        <link rel="stylesheet" type="text/css" href="./css/default.css" />
        
        <!-- JAVASCRIPT -->
        
    </head>
    
    <!-- BODY -->
    
    <body>
        
        <!-- TOP -->
        
        <div id="top">
            
            <a href="index.php">
                <div id="logo_zone">
                    Qui devo mettere l'immagine
                </div>
            </a>
            
            <div id="navbar">
                <?php echo $_smarty_tpl->tpl_vars['navbar']->value;?>

            </div>
        </div>
        
        <!-- CONTENT -->
            
        <div id="content">
            <?php echo $_smarty_tpl->tpl_vars['content']->value;?>

        </div>
        
        <!-- BOTTOM -->
        
        <div id="bottom">
            <?php echo $_smarty_tpl->tpl_vars['bottom']->value;?>

        </div>
        
    </body>
    
</html>
<?php }
}
