<?php

/**
 * class FPrenotazione
 * @author Mattia Di Luca
 */
class FPrenotazione extends FDatabase {
    
    public function __construct() {
        parent::__construct();
    
        USingleton::getInstances('FDatabase');
        
        $this->table = 'Prenotazione';
        $this->keytable = 'id';
        
    }
    
}

?>
