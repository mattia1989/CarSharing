<?php

/**
 * class FMezzo
 * @author Mattia Di Luca
 */
class FMezzo extends FDatabase {
    
    public function __construct() {
        parent::__construct();
    
        USingleton::getInstances('FDatabase');
        
        $this->table = 'Mezzo';
        $this->keytable = 'id';
        $this->resultClass = 'EMezzo';
        
    }

    public function getAllElement() {
        // prendo l'array di mezzi nel db
        $query = 'SELECT * FROM Mezzo;';
        return $this->executeQuery($query);

    }
    
}

?>
