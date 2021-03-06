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

    public function setUserData($paramUser, $paramBottonType) {
        // utilizzo un ciclo per riempire scartanto i valori come la password
        $this->assign('user_data_email', $paramUser['email']);
        $this->assign('user_data_nome', $paramUser['nome']);
        $this->assign('user_data_nDocumento', $paramUser['nDocumento']);
        $contenutoStato = '';
        $contenutoRiconsegna = '';

        if (!$paramUser['stato']) {
            // qui assegno il form
            $contenutoStato = $this->impostaBottoneAttiva($paramBottonType);
            $contenutoRiconsegna = 'Utente non attivo, pertanto non può effettuare ordini';
        } else {
            $contenutoStato = 'ATTIVO';
            $contenutoRiconsegna = $this->checkPrenotazione($paramUser['email']);
        }
        $this->assign('bottone_riconsegna', $contenutoRiconsegna);
        $this->assign('user_data_stato', $contenutoStato);
        $this->assign('user_data_admin', $paramUser['admin'] ? 'AMMINISTRATORE' : 'UTENTE');

        return $this->processaTemplateUtente('area_utente');

    }

    public function setElementoUtente($paramUser) {
        // riempio l'elemento della lista
        $this->assign('user_data_email', $paramUser['email']);
        $this->assign('user_data_nome', $paramUser['nome']);
        $this->assign('user_data_nDocumento', $paramUser['nDocumento']);

        $contenutoStato = '';
        if (!$paramUser['stato']) {
            // qui assegno il form
            $this->assign('emailUtente', $paramUser['email']);
            $contenutoStato = $this->impostaBottoneAttiva('admin');
        } else {
            $contenutoStato = 'ATTIVO';
        }
        $this->assign('user_data_stato', $contenutoStato);
        $this->assign('user_data_admin', $paramUser['admin'] ? 'AMMINISTRATORE' : 'UTENTE');

        return $this->fetch('./templates/list_element/Utente_list_utente.tpl');

    }

    /* METHOD */

    private function impostaBottoneAttiva($paramBottonType) {
        return $this->fetch('./templates/button/bottone_attiva_'.$paramBottonType.'.tpl');
    }

    public function impostaTemplateLista() {
        // costruisco la lista nella zona centrale
        $lista = array();
        // richiamo l'array dei mezzi dal db
        $futente = new FUtente();
        $futente_load = $futente->getAllElement();

        if (!$futente_load[0]) {
            return $this->setRedirectText('E\' presente solo l\'amministratore del sistema');
        } else {
            $i = 0;
            foreach($futente_load as $value) {
                $lista[$i] = $this->setElementoUtente($value);
                $i++;
            }
        }

        $this->assign('list', $lista);
        $template = $this->fetch('./templates/lista.tpl');

        return $this->impostaZonaCentraleTemplateUtente($template);

    }

    private function impostaZonaCentraleTemplateUtente($paramCenterZone) {
        // setto la barra da admin
        $this->impostaBarraLateraleTemplate('admin');
        // riempio la zona centrale
        $this->assign('center_zone', $paramCenterZone);
        return $this->fetch('./templates/center_default.tpl');
    }

    public function processaTemplateUtente($paramType) {
        $this->setLayout($paramType);
        return $this->fetch('./templates/Utente_'.$this->_layout.'.tpl');
    }

    private function checkPrenotazione($paramEmail)
    {
        // controllo se ha delle prenotazioni in corso
        $fprenotazione = new FPrenotazione();
        $esito = $fprenotazione->getPrenotazioneInCorso($paramEmail);

        if (!$esito) {
            return 'Non ci sono prenotazioni in corso';
        } else {
            $this->assign('id_prenotazione_in_corso', $esito['id']);
            return $this->fetch('./templates/button/bottone_riconsegna.tpl');
        }

    }

}

?>
