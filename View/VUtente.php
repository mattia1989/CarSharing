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

    public function getLoginData() {

        $tmp_user = array();
        if (isset($_POST['email']) && isset($_POST['password'])) {
            $tmp_user['email'] = $_POST['email'];
            $tmp_user['password'] = $_POST['password'];
        } else {
            $tmp_user = false;
        }

        return $tmp_user;

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

    public function getEmailPOST() {

        if (isset($_POST['email_recupero'])) {
            return $_POST['email_recupero'];
        } else {
            return false;
        }

    }

    public function getEmailGET() {

        if (isset($_GET['email_recupero'])) {
            return $_GET['email_recupero'];
        } else {
            return false;
        }

    }

    public function getRequestCode() {

        if (isset($_GET['requestcode'])) {
            return $_GET['requestcode'];
        } else {
            return false;
        }

    }

    public function getNewPassword() {

        if (isset($_POST['new_password'])) {
            return $_POST['new_password'];
        } else {
            return false;
        }

    }

    /* SETTER */

    public function setLayout($param)
    {
        $this->_layout = $param;
    }

    public function setErroreLogin($paramLoginError) {
        $this->assign('login_error', $paramLoginError);
    }

    public function setErroreRegistrazione($paramError) {
        $this->assign('var_error', $paramError);
    }

    public function setErroreRecupero($paramError) {
        $this->assign('recupero_error', $paramError);
    }

    public function setRedirectText($paramString) {
        $this->assign('redirect_text', $paramString);
    }

    public function setUserData($paramUser) {
        // utilizzo un ciclo per riempire scartanto i valori come la password
        $this->assign('user_data_email', $paramUser['email']);
        $this->assign('user_data_nome', $paramUser['nome']);
        $this->assign('user_data_nDocumento', $paramUser['nDocumento']);
        $contenutoStato = '';
        if (!$paramUser['stato']) {
            // qui assegno il form
            $contenutoStato = $this->fetch('./templates/bottone_attiva.tpl');
        } else {
            $contenutoStato = 'ATTIVO';
        }
        $this->assign('user_data_stato', $contenutoStato);
        $this->assign('user_data_admin', $paramUser['admin'] ? 'AMMINISTRATORE' : 'UTENTE');

        return $this->processaTemplateUtente('area_utente');

    }

    /* METHOD */

    public function processaTemplateUtente($paramType) {
        $this->setLayout($paramType);
        return $this->fetch('./templates/Utente_'.$this->_layout.'.tpl');
    }

    public function setRedirect($paramText) {
        $this->setRedirectText($paramText);
        return $this->processaTemplateUtente('redirect');
    }

}

?>
