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
        $this->resultClass = 'EPrenotazione';
        
    }

    public function getPrenotazioneInCorso($paramEmail) {
        // vedo se l'utente ha delle prenotazioni in corso
        $query = 'SELECT * FROM '.$this->table.' WHERE user_email = \''.$paramEmail.'\' AND data_consegna = \'null\';';

        return $this->executeQuery($query);

    }

    public function chiudiPrenotazione($paramIdPrenotazione) {
        // completo la prenotazione
        $dataAttuale = date('Y-m-d');
        $query = 'UPDATE '.$this->table.' SET data_consegna = \''.$dataAttuale.'\';';

        return $this->executeQuery($query);

    }
    
}

?>
