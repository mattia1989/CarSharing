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

            case 'registrazione':
                return $this->registrazione();

            case 'recupera_password':
                return $this->recuperaPassoword();

            case 'area_utente':
                return $this->pannelloUtente(); // gli devo passare il tipo di utente o me lo prendo dentro???

            case 'pannello_admin':
                return $this->pannelloAmministratore();

            case 'logout':
                return $this->logout();

        }

    }

    public function getUtente() {

        $flag = false;
        $_session = USingleton::getInstances('USession');
        $vutente = USingleton::getInstances('VUtente');
        $_controller = $vutente->getController();
        $_task = $vutente->getTask();

        if ($_session->getValue('email') != false) {
            // se sono già loggato (cookie settato)
            $flag = true;
        } elseif ($_controller == 'utente' && $_task == 'login') {
            // altrimenti effettuo il login
            $string = 'user: '.$this->email.', psw: '.$this->password;
            echo $string;
            $flag = $this->autentica($this->email, $this->password); // questi due parametri sono null, dove mi conviene settarli????
        }

        if ($_controller == 'utente' && $_task == 'logout') {
            // o il logout a seconda dei casi
            $this->logout();
            $flag = false;
        }

        return $flag;

    }

    public function autentica($user_mail, $user_psw) {
        // qui faccio la query al db e controllo
        $vutente = USingleton::getInstances('VUtente');
        $futente = new FUtente();
        $user = $futente->load($user_mail);

        $string = 'user: '.$user['email'].', password: '.$user['password'];
        echo $string;

        $flag = false;

        if ($user == false) {
            // login request false
        } else {
            if ($user->email == $user_mail && $user->password == $user_psw) {

                // good login
                $_session = USingleton::getInstances('USession');
                $_session->setValue('email', $user->email);
                $_session->setValue('user_type', $user->admin);
                echo $user->email.' '.$user->password;
                $flag = true;

            } else {
                // bad data
                $this->errore_generico = 'email/password errata';
            }
            // bad email
            $this->errore_email = 'email non esistente';
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

    private function logout() {

        $vutente = USingleton::getInstances('VUtente');
        $vutente->setLayout('logout');
        $tmpTpl = $vutente->processaTemplate();
        $vutente->assegnaComponente('content', $tmpTpl);
        return $vutente->processaTemplate('logout');

    }

}
