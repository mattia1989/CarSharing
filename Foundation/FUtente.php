<?php

/**
 * class FUtente
 * @author Mattia Di Luca
 */
class FUtente extends FDatabase {
    
    public function __construct()
    {
        parent::__construct();

        USingleton::getInstances('FDatabase');

        $this->table = 'Utente';
        $this->keytable = 'email';
        $this->resultClass = 'EUtente';

    }

}

?>
