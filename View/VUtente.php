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
        return $this->fetch('./templates/Utente_'.$paramType.'.tpl');
    }

    public function getLoginData() {

        $tmp_user = array();
        $tmp_user['email'] = $_POST['email'];
        $tmp_user['password'] = $_POST['password'];

        return $tmp_user;

    }

    public function setErroreLogin($param) {
        $this->assign('login_error', $param);
    }

    public function getDatiUtente() {

        $datinecessari = array('email', 'password', 'ripeti_password', 'nome', 'n_documento');
        $dati = array();
        
        foreach($datinecessari as $elemento) {
            if( isset($_REQUEST[$elemento])) {
                $dati[$elemento] = $_REQUEST[$elemento];
            }
        }

        return $dati;

    }

}

?>
