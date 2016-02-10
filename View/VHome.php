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

    public function setRegistrato() {

        $sessione = USingleton::getInstances('USession');
        if ($sessione->getValue('user_type') != false) {
            $this->setAdmin($sessione->getValue('email'));
        } else {
            $this->setUtente($sessione->getValue('email'));
        }

    }

    private function setUtente($email) {

        $tempTpl = $this->fetch('./templates/Logbar_registrato.tpl');

        $this->assign('navbar', $tempTpl);
        $this->assign('nome_utente', $email);
        $this->assign('content', $this->_content);
        $this->assign('bottom', "Realizzato da Mattia Di Luca *** Beta-testing site ***");

    }

    private function setAdmin($email) {

        $tempTpl = $this->fetch('./templates/Logbar_admin.tpl');

        $this->assign('navbar', $tempTpl);
        $this->assign('nome_utente', $email);
        $this->assign('content', $this->_content);
        $this->assign('bottom', "Realizzato da Mattia Di Luca *** Beta-testing site ***");

    }
    
    public function setOspite() {
        
        $tempTpl = $this->fetch('./templates/Logbar_default.tpl');
        
        $this->assign('navbar', $tempTpl);
        $this->assign('content', $this->_content);
        $this->assign('bottom', "Realizzato da Mattia Di Luca *** Beta-testing site ***");
        
    }

    public function processaTemplate($paramTplName) {
        
        return $this->fetch('./templates/'.$paramTplName.'.tpl');
        
    }

    public function showPage() {
     
        $this->display('./templates/Home_'.$this->_layout.'.tpl');
        
    }

}

?>
