                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   <?php

/**
 * Description of VUtente
 *
 * @author Mattia Di Luca
 */
class VUtente extends View
{

    private $_layout = 'default';

    /* GETTER */

    public function getLayout()
    {
        return $this->_layout;
    }

    public function getTask()
    {

        if (isset($_REQUEST['task'])) {
            return $_REQUEST['task'];
        } else {
            return false;
        }

    }

    public function getController()
    {

        if (isset($_REQUEST['controller'])) {
            return $_REQUEST['controller'];
        } else {
            return false;
        }

    }

    public function getEmail()
    {
        if (isset($_REQUEST['email'])) {
            return $_REQUEST['email'];
        } else {
            return false;
        }

    }

    public function getPassword()
    {
        if (isset($_REQUEST['password'])) {
            return $_REQUEST['password'];
        } else {
            return false;
        }

    }

    /* SETTER */

    public function setLayout($param)
    {
        $this->_layout = $param;
    }

    /* METHOD */

    public function processaTemplateUtente($paramType) {
        $this->setLayout($paramType);
        return $this->fetch('./templates/Utente_'.$this->_layout.'.tpl');
    }

    public function getLoginData() {

        $tmp_user = array();
        $tmp_user['email'] = $_POST['email'];
        $tmp_user['password'] = $_POST['password'];

        return $tmp_user;

    }

    public function setErroreLogin($paramLoginError) {
        $this->assign('login_error', $paramLoginError);
    }

    public function setErroreRegistrazione($paramError) {
        $this->assign('var_error', $paramError);
    }

    public function setRedirectText($paramString) {
        $this->assign('redirect_text', $paramString);
    }

    public function getDatiUtente() {

        $datinecessari = array('email', 'password', 'ripeti_password', 'nome', 'nDocumento');
        $dati = array();
        
        foreach($datinecessari as $elemento) {
            if( isset($_POST[$elemento])) {
                $dati[$elemento] = $_POST[$elemento];
            }
        }

        return $dati;

    }

}

?>
