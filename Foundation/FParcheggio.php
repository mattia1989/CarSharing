<?php

/**
 * class FParcheggio
 * @author Mattia Di Luca
 */
class FParcheggio extends FDatabase {
    
    public function __construct() {
        parent::__construct();
        
        USingleton::getInstances('FDatabase');
        
        $this->table = 'Parcheggio';
        $this->keytable = 'id';
        $this->resultClass = 'EParcheggio';
        
    }
    
}

?>
