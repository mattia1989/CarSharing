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
                return $vutente->esitoLogin($flag);
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
//        $user_db = new FUtente();
//        $user_load = $user_db->load($user_data['email']);
//
//        echo $user_load->getEmail().' | | | | | '.$user_load->getPassword();

        $user_load = true;

        if ($user_load == false) {
            $this->errore_generico = 'email not found';
        } else {
            // avvio la funzione per fare il match
            echo $user_data['email'];
            $flag = $this->checkUserAndPsw($user_data, $user_load);
        }

        return $flag;

    }

    private function checkUserAndPsw($inputData, $dbData) {

        $flag = false;

        if ($inputData != false) {
            $this->setCookie('mail@gmail.com', 'true');
            $flag = true;
        } else {
            $this->errore_generico = 'dati non validi';
            $flag = false;
        }

//        // qui prima va inserita una funzione che trasforma la psw in quella 'magica' per farne il confronto sotto
//        if ($inputData['email'] == dbData->getEmail() && $inputData['password'] == $dbData->getPassword()) {
//
//            $this->setCookie($dbData->getEmail(), $dbData->isAdmin());
//            $flag = true;
//
//        } else {
//            $this->errore_generico = 'dati non validi';
//        }

        return $flag;
    }

    private function proceduraLogout() {

        // cancello i cookie
        $usession = USingleton::getInstances('USession');
        $usession->removeValue('email');
        return $usession->destroySession();

    }

}
