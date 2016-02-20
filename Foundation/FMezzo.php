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

    public function setStatus($paramId, $paramStato)
    {
        $stato = $paramStato ? 'TRUE' : 'FALSE';
        $query = 'UPDATE '.$this->table.' SET stato ='.$stato.' WHERE '.$this->keytable.' =\' '.$paramId.'\';';

        return $this->executeQuery($query);

    }

}

?>
