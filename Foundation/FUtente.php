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

    public function addUser($paramUser) {

        $colonne = '';
        $valori = '\'';

//        $paramRow = mysqli_real_escape_string($this->connessione, $paramRow);

        foreach ($paramUser as $key => $value) {
            // scarto i campi non buoni mediante le etichette

            $cutente = USingleton::getInstances('CUtente');
            if ($key == 'password') {
                $value = $cutente->maskPassword($value);
            }

            if ($key != 'ripeti_password') {

                $colonne = $colonne.$key.', ';
                $valori = $valori.$value.'\', \'';

            }

            if ($key == 'nDocumento') {
                $colonne .= 'stato, admin, ';
                $valori = substr($valori, 0, strlen($valori) - 2);
                $valori .= 'FALSE, FALSE, \'';
            }

        }

        $colonne = substr($colonne, 0, strlen($colonne) - 2);
        $valori = substr($valori, 0, strlen($valori) - 3);

        $query = 'INSERT INTO '.$this->table.' ('.$colonne.') VALUE ('.$valori.');';

        return $this->executeQuery($query);

    }

    public function activateUser($paramEmail) {
        // attivo l'utente anche sul db
        $query = 'UPDATE '.$this->table.' SET stato = TRUE WHERE '.$this->keytable.' = \''.$paramEmail.'\';';

        return $this->executeQuery($query);

    }

    public function updateUserPassword($paramEmail, $paramPassword) {
        // aggiorno solo la password
        $query = 'UPDATE '.$this->table.' SET password = \''.$paramPassword.'\' WHERE '.$this->keytable.' = \''.$paramEmail.'\';';

        return $this->executeQuery($query);

    }

}

?>
