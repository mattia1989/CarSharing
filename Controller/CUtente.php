<?php

/**
 * Description of CUtente
 *
 * @author mdl
 */
class CUtente {
    
    private $nome = null;
    private $email = null;
    private $password = null;
    private $n_documento = null;

    private $errore_email = null;
    private $errore_generico = null;

    public function smista($param) {

        $vutente = USingleton::getInstances('VUtente');
        switch($vutente->getTask()) {

            case 'login':
                return $this->login();

            case 'autenticato':
                return $this->autenticaLayout($param);

            case 'registrazione':
                return $this->registrazione();

            case 'recupera_password':
                return $this->recuperaPassoword();

            case 'area_utente':
                return $this->pannelloUtente(); // gli devo passare il tipo di utente o me lo prendo dentro???

            case 'pannello_admin':
                return $this->pannelloAmministratore();

            case 'logout':
                return $this->logoutLayout();

        }

    }

    public function getUtente() {

        $flag = false;
        $vutente = USingleton::getInstances('VUtente');
        $_controller = $vutente->getController();
        $_task = $vutente->getTask();
        $mSession = USingleton::getInstances('USession');
//        $this->email = $_REQUEST['email'];
//        $this->password = $_REQUEST['password'];

        if ($mSession->getValue('email') != false) {
            // se sono già loggato (cookie settato)
            $flag = true;
        } elseif ($_controller == 'utente' && $_task == 'login') {
            // altrimenti effettuo il login
            $flag = $this->autentica($this->email, $this->password); // questi due parametri sono null, dove mi conviene settarli????
        }

        if ($_controller == 'utente' && $_task == 'logout') {
            // o il logout a seconda dei casi
            $this->logout();
            $flag = false;
        }

        return $flag;

    }

    public function logout() {

        $mSession = USingleton::getInstances('USession');
        $mSession->remuveValue('email');
        $mSession->remuveValue('password');
        $mSession->remuveValue('user_type');
        $mSession->destroySession();

    }

    public function autentica($user_mail, $user_psw) {

        $mSession = USingleton::getInstances('USession');
//        $mSession->setValue('email', 'mail@gmail.com');
//        $mSession->setValue('password', 'ciaociao');
//        $mSession->setValue('user_type', $user->admin);
        echo $mSession->getValue('email').$mSession->getValue('password');

        // qui faccio la query al db e controllo
        $vutente = USingleton::getInstances('VUtente');
        $futente = new FUtente();
        $user = $futente->load($user_mail);
        $user = $futente->load('mail@gmail.com');
//        echo $user;

        $flag = false;

        if ($user != false) {
            // sei già loggato
            $flag = true;
        } else{

            if ($user['email'] == $user_mail && $user['password'] == $user_psw) {

                echo 'cazzooooooooooo!!!';

                // good login
                $mSession = USingleton::getInstances('USession');
                $mSession->setValue('email', $user->email);
                $mSession->setValue('password', $user->password);
                $mSession->setValue('user_type', $user->admin);
                $flag = true;

            } else {
                // bad data
                $this->errore_generico = 'email/password errata';
            }
            // bad email
            $this->errore_email = 'email non presente nel db';
        }

        return $flag;

    }

    public function login() {

        $vutente = USingleton::getInstances('VUtente');
        $tempTpl = $vutente->processaTemplate('Autenticazione');
        $vutente->assegnaComponente('content', $tempTpl);
        return $vutente->processaTemplate();

    }

    public function checkUser($paramUser) {
        // vorrei che questa funzione si occupasse unicamente
        // del controllare se username & password coincidano
        // tornando unicamente un booleano di modo che nel momento
        // in cui inserirò una nuova funzione per fare il check
        // dovrò modificare solo questa
    }

    public function registrazione() {

        $vutente = USingleton::getInstances('VUtente');
        $vutente->setLayout('registrazione');
        $tempTpl = $vutente->processaTemplate();
        $vutente->assegnaComponente('content', $tempTpl);
        return $vutente->processaTemplate();

    }

    public function pannelloUtente(){

        $vutente = USingleton::getInstances('VUtente');
        $tempTpl = $vutente->processaTemplate('gestione_utente');
        $vutente->assegnaComponente('content', $tempTpl);
        return $vutente->processaTemplate('gestione_utente');

    }

    public function pannelloAmministratore() {

        $vutente = USingleton::getInstances('VUtente');
        $tempTpl = $vutente->processaTemplate('gestione_amministratore');
        $vutente->assegnaComponente('content', $tempTpl);
        return $vutente->processaTemplate('gestione_amministratore');

    }

    private function recuperaPassoword() {

        $vutente = USingleton::getInstances('VUtente');
        $vutente->setLayout('recuperapsw');
        $tmpTpl = $vutente->processaTemplate();
        $vutente->assegnaComponente('content', $tmpTpl);
        return $vutente->processaTemplate('recupera_password');

    }

    private function logoutLayout() {

        $vutente = USingleton::getInstances('VUtente');
        $vutente->setLayout('logout');
        $tmpTpl = $vutente->processaTemplate();
        $vutente->assegnaComponente('content', $tmpTpl);
        return $vutente->processaTemplate('logout');

    }

    public function autenticaLayout($param) {
        $vutente = USingleton::getInstances('VUtente');
        if ($param) {
            $vutente->setLayout('redirect');
            return $result = $vutente->processaTemplate();
        } else {
            // qui devo impostare l'errore del login
//            $vutente->setErroreLogin('errore'); // come la devo fare questa?
            return $result = $vutente->processaTemplate();
        }
    }

}
