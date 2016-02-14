<?php

/**
 * Description of CUtente
 *
 * @author Mattia Di Luca
 */
class CUtente {
    
    private $nome = "";
    private $email = "";
    private $password = "";
    private $nDocumento = "";

    private $errore_generico = "";

    /* METHOD */

    public function smista($paramEmail) {

        $vutente = USingleton::getInstances('VUtente');

        switch ($vutente->getTask()) {

            case 'login':
                return $vutente->processaTemplateUtente('login');
                break;

            case 'autentica':
                $flag = $this->richiestaLogin();
                return $this->esitoLogin($flag);
                break;

            case 'registrazione':
                return $vutente->processaTemplateUtente('registrazione');
                break;

            case 'registra':
                $flag = $this->richiestaRegistrazione();
                return $this->esitoRegistrazione($flag);

            case 'recuperapsw':
                return $vutente->processaTemplateUtente('recuperapsw');
                break;

            case 'redirectpsw':
                // devo controllare se è nel db:
                $flag = $this->richiestaRecupero();
                return $this->esitoRecupero($flag);
                break;

            case 'area_utente':
                return $vutente->processaTemplateUtente('area_utente');
                break;

            case 'logout':
                $this->proceduraLogout();
                $vutente->setRedirectText('Logout effettuato, stai per essere reindirizzato alla home...');
                return $vutente->processaTemplateUtente('redirect');
                break;

        }
    }

    /* GETTER */

    /**
     * @return string
     */
    public function getErroreGenerico()
    {
        return $this->errore_generico;
    }

    public function getCookie() {
        // recupero il valore dal cookie
        $cookie = false;
        $usession = USingleton::getInstances('USession');
        $cookie['email'] = $usession->getValue('email');
        $cookie['admin'] = $usession->getValue('admin');

        return $cookie;

    }

    /* METHOD */

    private function setCookie($paramDBData) {
        // setto il cookie
        $usession = USingleton::getInstances('USession');
        $usession->setValue('email', $paramDBData['email']);
        $usession->setValue('admin', $paramDBData['admin']);

    }

    private function richiestaLogin() {

        $flag = false;
        // qui controllo se l'utente può autenticarsi

        // prendo i dati dalla view di login
        $vutente = USingleton::getInstances('VUtente');
        $user_data = $vutente->getLoginData();

        // prendo i dati dal db in base al nome utente
        $user_db = new FUtente();
        $user_load = $user_db->load($user_data['email']);
        echo $user_load['email'];

        if ($user_load == false) {
            $this->errore_generico = 'email non presente';
        } else {
            // avvio la funzione per fare il match
            $flag = $this->checkUserAndPsw($user_data, $user_load);
        }

        return $flag;

    }

    private function checkUserAndPsw($inputData, $dbData) {

        $flag = false;
        // mi riporto la password nel formato memorizzato sul db
        $inputPassword = $this->maskPassword($inputData['password']);
//        echo $inputPassword;

        if ($inputData['email'] == $dbData['email'] && $inputPassword == $dbData['password']) {
            // setto cookie e flag per il controllo della view
            $this->setCookie($dbData);
            $flag = true;

        } else {
            $this->errore_generico = 'dati non validi';
        }

        return $flag;
    }

    public function maskPassword($paramPassword) {
        // la concateno col SALT e ne faccio l'hash
//        $temp = sha1(FSalt::$SALT.$paramPassword);
//        echo $temp;
        return sha1(FSalt::$SALT.$paramPassword);
    }

    private function richiestaRegistrazione() {

        $flag = '';

        $vutente = USingleton::getInstances('VUtente');
        $datiRegistrazione = $vutente->getDatiUtente();

        if (!$this->checkIfExists($datiRegistrazione['email'])) {
            // l'utente non esiste quindi
            $flag = $this->creaUtente($datiRegistrazione);
        } else {
            // altrimenti setto l'errore
            $this->errore_generico = 'Email inserita in fase di registrazione presente, provare ad effettuare il login';
            $flag = '2';
        }

        return $flag;

    }


    private function richiestaRecupero() {
        // recupero l'indirizzo dalla view
        $vutente = USingleton::getInstances('VUtente');
        $userEmail = $vutente->getEmailRecupero();
        $flag = $this->checkIfExists($userEmail);
        if ($flag == false) {
            // setto l'errore
            $this->errore_generico = 'utente non esistente';
        }

        return $flag;

    }

    private function checkIfExists($paramEmail) {
        // controllo se l'utente è già registrato
        $user = new FUtente();
        $user_load = $user->load($paramEmail);
        if ($user_load['email'] == false) {
            return false;
        } else {
            echo 'esiste';
            return true;
        }

    }

    private function creaUtente($paramDatiUtente) {
        // carico i dati dell'utente sul db
        $user = new FUtente();
        $insertResult = $user->addUser($paramDatiUtente);

        return $insertResult;

    }

    public function esitoLogin($paramEsito) {

        $vutente = USingleton::getInstances('VUtente');

        $template = '';
        if ($paramEsito != false) {
            // imposto il layout con la redirect
            $vutente->setRedirectText('Accesso effettuato, stai per essere reindirizzato alla home...');
            $template = $vutente->processaTemplateUtente('redirect');
        } else {
            // reimposto il layout di login con l'errore
            $vutente->setErroreLogin($this->errore_generico); // perché non setta l'errore
            $template = $vutente->processaTemplateUtente('login');
        }
        return $template;

    }

    public function esitoRegistrazione($paramEsito) {

        $vutente = USingleton::getInstances('VUtente');
        $template = '';

        switch ($paramEsito) {

            case 0:
                // false: imposto l'errore e torno alla schermata di registrazione
                $vutente->setErroreRegistrazione($this->errore_generico);
                $template = $vutente->processaTemplateUtente('registrazione');
                break;

            case 1:
                // true: INVIO L'EMAIL ed imposto la redirect
                $vutente->setRedirectText('Registrazione effettuata, controlla l\'emial per completare la registrazione ed attivare l\'account');
                $template = $vutente->processaTemplateUtente('redirect');
                break;

            case 2:
                // esiste: importo il layout di login
                $vutente->setErroreLogin($this->errore_generico);
                $template = $vutente->processaTemplateUtente('login');
                break;

        }

        return $template;
    }
    private function esitoRecupero($paramEsito) {

        $template = '';
        $vutente = USingleton::getInstances('VUtente');

        if ($paramEsito == true) {
            // YES: invio la mail e redirect alla pagina di redirect
            // DEVO ANCORA SCRIVERE L'INVIO DELL'EMAIL
            $vutente->setRedirectText('Procedura di recupero effettuata, ti abbiamo inviato una email...');
            $template = $vutente->processaTemplateUtente('redirect');
        } else {
            // NO: inserisco l'errore e torno alla medesima pagina
            $vutente->setErroreRecupero($this->errore_generico);
            $template = $vutente->processaTemplateUtente('recuperapsw');
        }

        return $template;
    }

    private function proceduraLogout() {

        // cancello i cookie
        $usession = USingleton::getInstances('USession');
        $usession->removeValue('email');
        $usession->removeValue('admin');
        return $usession->destroySession();

    }

}
