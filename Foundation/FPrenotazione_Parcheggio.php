<?php

/**
 * @class FPrenotazione_Parcheggio
 * @author Mattia Di Luca
 */
class FPrenotazione_Parcheggio extends FDatabase {

    public function __construct()
    {
        parent::__construct();

        USingleton::getInstances('FDatabase');

        $this->table = 'Prenotazione_Parcheggio';
        $this->keytable = 'id';

    }

    public function getLastParcheggio($paramIdMezzo)
    {
        // carico l'ultima prenotazione con quell'id
        $query = 'SELECT * FROM Prenotazione WHERE mezzo_id = \''.$paramIdMezzo.'\';';
        $risultato = $this->executeQuery($query);
        // l'ultimo id sarà quello in posizione count-1
        $lastid = $risultato[count($risultato)-1]['id'];
        // ora prendo l'ultimo valore di prenotazione_parcheggio
        $query = 'SELECT * FROM Prenotazione_Parcheggio WHERE id_prenotazione = '.$lastid.';';
        $risultato = $this->executeQuery($query);
        return $risultato[count($risultato)-1];

    }

}