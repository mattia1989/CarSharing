<?php

/**
 * class CHome
 * @author Mattia Di Luca
 */
class CHome {

    public function setPage() {

        // perché non si vede neanche la home???

        $vhome = USingleton::getInstances('VHome');
        $usession = USingleton::getInstances('USession');
        // ripesco il template di base
        $tmp = $this->smista($usession->getValue('email'));
        // controllo se esiste l'utente
        $cutente = USingleton::getInstances('CUtente');
        $exist = $cutente->getCookie();
        // gli assegno la navbar
        if (!$exist['email']) {
            $vhome->setOspite();
        } else {
            if ($exist['admin'] == 0) {
                $vhome->setUtente($exist['email']);
            } else {
                $vhome->setAdmin($exist['email']);
            }
        }

        $vhome->setContent($tmp);
        $vhome->showPage();
        
    }

    /**
     * Smista le domande per i template da assegnare
     * @return mixed
     */
    public function smista($paramEmail) {
        
        $vhome = USingleton::getInstances('VHome');
        
        switch ($vhome->getController()) {
            
            case 'utente':
                $cutente = USingleton::getInstances('CUtente');
                $tmp = $cutente->smista($paramEmail);
                $vhome->setContent($tmp);
                break;
                
            case 'mezzo':
                $cmezzo = USingleton::getInstances('CMezzo');
                $tmp = $cmezzo->smista();
                $vhome->setContent($tmp);
                break;
            
            case 'parcheggio':
                $cparcheggio = USingleton::getInstances('CParcheggio');
                $tmp = $cparcheggio->smista();
                $vhome->setContent($tmp);
                break;

            case 'prenotazione':
                $cprenotazione = USingleton::getInstances('CPrenotazione');
                $tmp = $cprenotazione->smista();
                $vhome->setContent($tmp);
                break;
            
            default:
                return $vhome->processaTemplate('Home_default');
                $vhome->setContent($tmp);

        }
    }
    
}
