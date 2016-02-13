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

            case 'recuperapsw':
                return $vutente->processaTemplateUtente('recuperapsw');
                break;

            case 'area_utente':
                return $vutente->processaTemplateUtente('area_utente');
                break;

            case 'logout':
                $this->proceduraLogout();
                return $vutente->processaTemplateUtente('logout');
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

    /* METHOD */

    public function getUser() {

        $cookie = false;

        // recupero il valore dal cookie
        $usession = USingleton::getInstances('USession');
        $cookie = $usession->getValue('email');

        return $cookie;

    }

    private function setCookie($paramEmail, $paramType) {

        // setto il cookie
        $usession = USingleton::getInstances('USession');
        $usession->setValue('email', $paramEmail);
        $usession->setValue('user_type', $paramType);

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

        if ($inputData['email'] == $dbData->email && $inputPassword == $dbData->password) {

            $this->setCookie($dbData->email, $dbData->admin);
            $flag = true;

        } else {
            $this->errore_generico = 'dati non validi';
        }

        return $flag;
    }

    private function maskPassword($paramPassword) {
        // la concateno col SALT e ne faccio l'hash
        return sha1(FSalt::$SALT.$paramPassword);
    }

    public function esitoLogin($paramEsito) {

        $vutente = USingleton::getInstances('VUtente');

        $template = '';
        if ($paramEsito != false) {
            // imposto il layout con la redirect
            $template = $vutente->processaTemplateUtente('redirect');
        } else {
            // reimposto il layout di login con l'errore
            $vutente->setErroreLogin($this->errore_generico); // perché non setta l'errore
            $template = $vutente->processaTemplateUtente('login');
        }
        return $template;

    }

    private function proceduraLogout() {

        // cancello i cookie
        $usession = USingleton::getInstances('USession');
        $usession->removeValue('email');
        return $usession->destroySession();

    }

}
