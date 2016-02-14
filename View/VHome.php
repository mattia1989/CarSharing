<?php

/**
 * Description of VHome
 * @author mdl
 */
class VHome extends View {
    
    private $_content;
    private $_layout = 'default';

    /* GETTER */
    
    public function getController() {
        
        if (isset($_REQUEST['controller'])) {
            return $_REQUEST['controller'];
        } else {
            return false;
        }
        
    }
    public function getTask() {
        
        if (isset($_REQUEST['task'])) {
            return $_REQUEST['task'];
        } else {
            return false;
        }
        
    }
    
    /* SETTER */
    
    public function setContent($paramTpl) {
        $this->_content = $paramTpl;
    }
    
    public function setLayout($paramLayout) {
        $this->_layout = $paramLayout;
    }

    /* FUNCTION */

    public function setOspite() {

        $template = $this->processaLogbar('default');

        $this->assign('navbar', $template);
        $this->assign('content', $this->_content);
        $this->assign('bottom', 'MDL');

    }

    public function setUtente($userParam) {
        // assegno il nome
        $this->assign('nome_utente', $userParam);

        $template = $this->processaLogbar('registrato');
        $this->assign('navbar', $template);
        $this->assign('content', $this->_content);
        $this->assign('bottom', 'MDL');

    }

    public function processaTemplate($paramTplName) {
        return $this->fetch('./templates/'.$paramTplName.'.tpl');
    }

    private function processaLogbar($type) {
        return $this->fetch('./templates/Logbar_'.$type.'.tpl');
    }

    public function showPage() {
        $this->display('./templates/Home_'.$this->_layout.'.tpl');
    }

}

?>
