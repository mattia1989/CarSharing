<?php

/**
 * class CHome
 * @author Mattia Di Luca
 */
class CHome {

    public function setPage() {

        // perché non si vede neanche la home???

        $vhome = USingleton::getInstances('VHome');
        // ripesco il template di base
        $tmp = $this->smista('mail@gmail.com');
        // controllo se esiste l'utente
        $cutente = USingleton::getInstances('CUtente');
        $exist = $cutente->getUser();
        // gli assegno la navbar
        echo 'laaaaaaaaaaaaaa'.$exist['email'];
        if (!$exist) {
            $vhome->setOspite();
        } else {
            echo 'looooooooooooool'.$exist['email'];
            $vhome->setUtente($exist['email']);
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
                
            case 'mezzi':
                break;
            
            case 'parcheggi':
                break;
            
            default:
                return $vhome->processaTemplate('Home_default');
//                $vhome->setContent($tmp);
        }
    }
    
}
