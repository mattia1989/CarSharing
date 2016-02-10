<?php

/**
 * class CHome
 * @author Mattia Di Luca
 */
class CHome {

    public function setPage() {
        
        $vhome = USingleton::getInstances('VHome');
        $cutente = USingleton::getInstances('CUtente');
        $_user = $cutente->getUtente();
        $tmpTpl = $this->smista($_user);
        $vhome->setContent($tmpTpl);

        if ($_user != false) {
            $vhome->setRegistrato();
        } else {
            $vhome->setOspite();
        }
        $vhome->setContent($tmpTpl);
        $vhome->showPage();
        
    }

    /**
     * Smista le domande per i template da assegnare
     * @return mixed
     */
    public function smista($param) {
        
        $vhome = USingleton::getInstances('VHome');
        
        switch ($vhome->getController()) {
            
            case 'utente':
                $cutente = USingleton::getInstances('CUtente');
                return $cutente->smista($param);
                break;

            case 'registrazione':
                $vhome->setRegistrazione();
                break;
                
            case 'mezzi':
                break;
            
            case 'parcheggi':
                break;
            
            case 'disponibili':
                break;
            
            case 'area_amministrativa':
                break;
            
            default:
                return $vhome->processaTemplate('Home_default');
                
        }
    }
    
}
