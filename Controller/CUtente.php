<?php

/**
 * Description of CUtente
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

            case 'attivazione':
                $flag = $this->richiestaAttivazione($paramEmail);
                return $this->esitoAttivazione($flag);

            case 'attiva':
                $flag = $this->attiva($vutente->getEmailGET(), $vutente->getRequestCode());
                return $this->esitoAttiva($flag);

            case 'attiva_admin_interface':
                $flag = $this->attivaUtente($vutente->getEmail());
                return $this->esitoAttivaUtente($flag);

            case 'recuperapsw':
                return $vutente->processaTemplateUtente('recuperapsw');
                break;

            case 'redirectpsw':
                // devo controllare se è nel db:
                $flag = $this->richiestaRecupero();
                return $this->esitoRecupero($flag);
                break;

            case 'changepsw':
                // controllo se il codice corrisponde a quello inviato via email
                $flag = $this->richiestaCambioPsw($vutente->getEmailGET(), $vutente->getRequestCode());
                return $this->esitoRichiestaCambioPsw($flag);
                break;

            case 'submit_new_psw':
                // inserisco la nuova psw nel DB e nel caso faccio la redirect
                $flag = $this->updateUserPsw($vutente->getEmailGET(), $vutente->getNewPassword());
                return $this->esitoUpdatePsw($flag);
                break;

            case 'area_utente':
                return $this->riempiTemplateUtente();
                break;

            case 'area_amministratore':
                return $vutente->processaTemplateUtente('area_amministratore');
                break;

            case 'lista_utenti':
                return $vutente->impostaTemplateLista();
                break;

            case 'logout':
                $this->proceduraLogout();
                return$vutente->setRedirectText('Logout effettuato, stai per essere reindirizzato alla home...');
//                return $vutente->processaTemplateUtente('redirect');
                break;

            case 'invia_mail_di_prova':
                UEmail::sendMail('matt.1989@yahoo.it', 'mattia', 'beta test subject', 'testo della email di prova');
                return $vutente->processaTemplateUtente('redirect');

            case 'modifica_utente':
                // devo tornare al pannello d'amministrazione
                break;

            case 'cancella':
                $flag = $this->richiestaRimuovi($vutente->getEmail());
                return $this->esitoRimuovi($flag);
                // devo tornare al pannello d'amministrazione
                break;

        }
    }

    /* GETTER */

    /**
     * @return string
     */
    public function getErroreGenerico() {
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
        $userEmail = $vutente->getEmailGET();
        $flag = $this->checkIfExists($userEmail);
        // faccio lo switch dei casi ed invio la risposta sopra
        if ($flag == false) {
            // setto l'errore
            $this->errore_generico = 'utente non esistente';
            $flag = 0;
        } else {
            // invio l'email con il link per cambiare la password
            $flagEmail = $this->createRecoveryLink($userEmail, 'changepsw'); // dalla procedura d'invio deve tornare un booleano
            if ($flagEmail) {
                // procedura andata a buon fine
                $flag = 2;
            } else {
                // non sono riuscito a mandare l'email
                $flag = 1;
            }

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
            return true;
        }

    }

    private function creaUtente($paramDatiUtente) {
        // carico i dati dell'utente sul db
        $user = new FUtente();
        $insertResult = $user->addUser($paramDatiUtente);

        return $insertResult;

    }

    private function richiestaAttivazione($paramEmail) {
        // controllo che l'utente esista e non sia già attivo
        $futente = new FUtente();
        $esito = $futente->load($paramEmail);

        if (!$esito['stato']) {
            // l'utente non è attivo
            return $this->createRecoveryLink($paramEmail, 'attiva');
        } else {
            // l'utente è attivo
            return '2';
        }

    }

    private function attiva($paramEmail, $paramRequestcode) {
        // completo l'attivazione
        $fuserrecovery = new FUserRecovery();
        $fuserrecoveryDB = $fuserrecovery->load($paramEmail);

        if ($fuserrecoveryDB['requestcode'] == $paramRequestcode) {
            // tutto coincide, attivo l'utente
            $futente = new FUtente();
            $risultato1 = $futente->activateUser($paramEmail);
            $risultato2 = $fuserrecovery->deleteRow($paramEmail);

            if ($risultato1 && $risultato2) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }

    }

    private function richiestaCambioPsw($paramEmail, $paramRequestcode) {
        // controllo che gli altri parametri siano giusti
        echo $paramEmail.$paramRequestcode;
        $fuserRecover = new FUserRecovery();
        $fuserRecoverload = $fuserRecover->load($paramEmail);
        if ($fuserRecoverload['requestcode'] == $paramRequestcode) {
            // l'ho trovato quindi setto il flag a 1 e levo il link dalla tabella
            return $fuserRecover->deleteRow($paramEmail);
        } else {
            // l'utente non ha effettuato la richiesta prima
            return false;
        }

    }

    public function esitoLogin($paramEsito) {

        $vutente = USingleton::getInstances('VUtente');

        $template = '';
        if ($paramEsito != false) {
            // imposto il layout con la redirect
            $template = $vutente->setRedirectText('Accesso effettuato, stai per essere reindirizzato alla home...');
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
                $template = $vutente->setRedirectText('Registrazione effettuata, controlla l\'emial per completare la registrazione ed attivare l\'account');
                break;

            case 2:
                // esiste: importo il layout di login
                $vutente->setErroreLogin($this->errore_generico);
                $template = $vutente->processaTemplateUtente('login');
                break;

        }

        return $template;

    }

    private function esitoAttivazione($paramEsito) {

        $vutente = USingleton::getInstances('VUtente');

        switch ($paramEsito) {

            case '0': {
                // qualcosa è andato storto
                return $vutente->setRedirectText('Si sono verificati dei problemi, stai per essere reindirizzato alla home');
            }

            case '1': {
                // tutto ok
                return $vutente->setRedirectText('Email inviata, stai per essere reindirizzato alla home');
            }

            case '2': {
                // utente già attivo
                return $vutente->setRedirectText('Utente già attivo, stai per essere reindirizzato alla home');
            }
        }

    }

    private function esitoAttiva($paramFlag) {

        $vutente = USingleton::getInstances('VUtente');
        $stringResult = '';
        if ($paramFlag) {
            $stringResult = 'Attivazione andata a buon fine, stai per essere reindirizzato alla home';
        } else {
            $stringResult = 'Si è verificato un errore, stai per essere reindirizzato alla home';
        }

        return $vutente->setRedirectText($stringResult);

    }

    private function esitoRecupero($paramEsito) {

        $template = '';
        $vutente = USingleton::getInstances('VUtente');

        switch ($paramEsito) {

            case '0': {
                // email non presente, setto l'errore
                $vutente->setErroreRecupero($this->errore_generico);
                return $vutente->processaTemplateUtente('recuperapsw');
            }

            case '1': {
                // l'email è presente ma non sono riuscito a mandare l'email
                return $vutente->setRedirectText('Procedura di recupero non riuscita, stati per essere reindirizzato alla home');
            }

            case '2': {
                // procedura andata a buon fine
                return $vutente->setRedirectText('\'Procedura di recupero effettuata, ti abbiamo inviato una email...\'');
            }

        }

    }

    private function esitoRichiestaCambioPsw($paramFlag) {

        $vutente = USingleton::getInstances('VUtente');

        switch ($paramFlag) {

            case '0': {
                // procedura non andata a buon fine
                return $vutente->setRedirectText('Link non valido, stai per essere reindirizzato alla home');
            }

            case '1': {
                // procedura andata a buon fine, setto il layout per cambiare password
                return $vutente->processaTemplateUtente('inseriscipsw');
            }
        }
    }

    private function esitoUpdatePsw($paramFlag) {
        echo $paramFlag;

        $vutente = USingleton::getInstances('VUtente');

        switch ($paramFlag) {

            case '0': {
                // procedura interrotta, occorre ricominciare da capo
                return $vutente->setRedirectText('Si è verificato un problema, occorre riavviare la procedura');
            }

            case '1': {
                // procedura andata a buon fine, redirect alla login page
                return $vutente->processaTemplateUtente('login');
            }

        }

    }

    private function riempiTemplateUtente() {
        // recupero il cookie ed in base a quello richiamo l'utente sul db
        $user = $this->getCookie();
        $userDB = new FUtente();
        $userload = $userDB->load($user['email']);

        // controllo il valore caricato e setto i dati sulla view
        $vutente = USingleton::getInstances('VUtente');
        $template = '';

        if (!$userload['email']) {
            // redirect alla pagina di redirect per la home
            $template = $vutente->setRedirectText('Utente non presente, stai per essere reindirizzato alla home...');
        } else {
            // carico i dati sulla view
            $template = $vutente->setUserData($userload, 'utente');
        }

        return $template;

    }

    private function createRecoveryLink($paramUseremail, $paramTaskValue) {
        // creo il link
        $link = $this->generateRandomCode();
        $row = array();
        $row['email'] = $paramUseremail;
        $row['requestcode'] = $link;
        // lo metto nell'apposita tabella con la useremail
        $futenterecovery = new FUserRecovery();
        $flagInsert = $futenterecovery->addRow($row);
        $flagEmail = $this->sendRecoveryEmail($row, $paramTaskValue);
        if ($flagEmail && $flagInsert) {
            return true;
        } else {
            return false;
        }

    }

    private function generateRandomCode($paramLength = 128) {
        // genero la stringa random da abbinare alla useremail
        return sha1($this->generateRandomString($paramLength).$this->generateRandomString($paramLength));

    }

    private function generateRandomString($paramLength) {
        // generatore di stringhe random di lunghezza fissa
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $paramLength; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;

    }

    private function sendRecoveryEmail($paramRequest, $paramTaskValue) {
        // creo il link da inviare
        $linkEmail = urlencode($paramRequest['email']); // devo trasformarla prima
        $sendLink = 'index.php?controller=utente&task='.$paramTaskValue.'&email_recupero='.$linkEmail.'&requestcode='.$paramRequest['requestcode'];
        echo $sendLink;
        $flagEmail = true;// prendo l'indirizzo $paramRequest['email'] ed insieme al $sendLink che va nel body invio e mi faccio tornare un bool
        if ($flagEmail) {
            return true;
        } else {
            return false;
        }

    }

    private function updateUserPsw($paramEmail, $paramNewPassword) {
        // aggiorno la nuova password nel db
        $futente = new FUtente();
        $esito = $futente->updateUserPassword($paramEmail, $this->maskPassword($paramNewPassword));

        return $esito;

    }

    private function proceduraLogout() {

        // cancello i cookie
        $usession = USingleton::getInstances('USession');
        $usession->removeValue('email');
        $usession->removeValue('admin');
        return $usession->destroySession();

    }

    private function richiestaRimuovi($paramUseremail) {
        // controllo se esiste e nel caso faccio la drop
        if ($this->checkIfExists($paramUseremail)) {
            // cancello l'utenet
            $futente = new FUtente();
            return $futente->deleteRow($paramUseremail);
        } else {
            return $value = 'Email inesistente';
        }

    }

    private function esitoRimuovi($paramFlag) {

        $vutente = USingleton::getInstances('VUtente');
        if($paramFlag) {
            if ($paramFlag == 0) {
                return $vutente->setRedirectText('Si è verificato un errore');
            } else {
                return $vutente->setRedirectText('Operazione effettutata');
            }
        } else {
            return $vutente->setRedirectText($paramFlag);
        }

    }

    private function attivaUtente($paramUserEmail) {
        // controllo se esiste
        echo $paramUserEmail;
        $futente = new FUtente();
        $esito = $futente->load($paramUserEmail);
        if (!$esito['stato']) {
            // lo attivo
            return $futente->activateUser($paramUserEmail);
        } else {
            return $flag = 'Utente non esistente';
        }

    }

    private function esitoAttivaUtente($paramFlag) {

        $vutente = USingleton::getInstances('VUtente');
        echo $paramFlag;
        if($paramFlag != 0) {
            if ($paramFlag == 1) {
                return $vutente->setRedirectText('Operazione effettuata con successo');
            } else {
                return $vutente->setRedirectText('Si è verificato un errore');
            }
            return $vutente->setRedirectText('Utente non trovato');
        }
    }

}
