<?php
require('./smarty-3.1.29/libs/Smarty.class.php');

/**
 * Description of View
 * @author mdl
 */
class View extends Smarty {
    
    private $errorList;
    
    public function __construct() {
        
        parent::__construct();
        
        global $configs;
        
        $this->template_dir = $configs['smarty']['template_dir'];
        $this->compile_dir = $configs['smarty']['compiled_dir'];
        $this->config_dir = $configs['smarty']['config_dir'];
        $this->cache_dir = $configs['smarty']['cache_dir'];
        $this->caching = FALSE;
        
    }

    public function getController() {
        if(isset($_REQUEST['controller'])) {
            return $_REQUEST['controller'];
        } else {
            return false;
        }
    }

    public function getTask() {
        if(isset($_REQUEST['task'])) {
            return $_REQUEST['task'];
        } else {
            return false;
        }
    }

    public function setRedirectText($paramText) {
        $this->assign('redirect_text', $paramText);
        return $this->fetch('./templates/redirect.tpl');
    }

    /* METHOD */

    protected function impostaBarraLateraleTemplate($paramType) {
        // assegno la barra laterale
        if ($paramType == 'default') {
            $this->assign('left_zone', $this->fetch('./templates/barra_laterale_default.tpl'));
        } else {
            $vutente = USingleton::getInstances('VUtente');
            $this->assign('left_zone', $this->fetch('./templates/barra_laterale_admin.tpl'));
        }
    }
    
}

?>
