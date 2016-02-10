<?php

/**
 * class FSetup
 * Questa classe viene utilizzata la prima volta alla creazione del DB per il Setup
 * @author Mattia Di Luca
 */
class FSetup {
    
    public function __construct() {
    }
    
    /**
     * 
     * @param type $paramConnection
     * @return boolean
     */
    public function createDB($paramConnection) {
        
        $tmpConnection = mysqli_connect($paramConnection['host'], $paramConnection['username'], $paramConnection['password']);
        
        if ($tmpConnection) {
            
           $tmpQuery = "CREATE Database " . $paramConnection['nomedb'];
           if (mysqli_query($tmpQuery, $tmpConnection)) {
               
               mysqli_select_db($paramConnection['nomedb'], $tmpConnection);
               
               // Creo la tabella Utenti
               
               $user_table = 'CREATE TABLE Utente ( '
                       . 'id BIGINT UNIQUE NOT NULL'
                       . 'name VARCHAR(20) UNIQUE NOT NULL, '
                       . 'password VARCHAR(20) NOT NULL, '
                       . 'email VARCHAR(40) UNIQUE NOT NULL, '
                       . 'n_documento VARCHAR(30) UNIQUE NOT NULL, '
                       . 'stato BIN NOT NULL DEFAULT 0, '
                       . 'admin BIN NOT NULL DEFAULT 0, '
                       . 'PRIMARY KEY (id))';
               
               if (mysqli_query($user_table)) {
                   
                   // Creo la tabella Mezzi
                   
                   $auto_table = 'CREATE TABLE Mezzo ('
                           . 'targa VARCHAR(8) NOT NULL,'
                           . 'modello VARCHAR(40) NOT NULL, '
                           . 'cilindrata DOUBLE NOT NULL, '
                           . 'carburante enum(Benzina, Diesel, GPL, Metano, Ibrida) NOT NULL, '
                           . 'km FLOAT(10) NOT NULL, '
                           . 'colore VARCHAR(30) NOT NULL, '
                           . 'prezzo_giornaliero FLOAT(10) NOT NULL, '
                           . 'prezzo_orario FLOAT(10) NOT NULL,'
                           . 'PRIMARY KEY (targa))';
                   
                   if (mysqli_query($auto_table)) {
                       
                       // Creo la tabella dei parcheggi
                       
                       $parking_table = 'CREATE TABLE Parcheggio ( '
                               . 'id BIGINT NOT NULL, '
                               . 'indirizzo VARCHAR(50) NOT NULL,'
                               . 'citta VARCHAR(50) NOT NULL, '
                               . 'provincia VARCHAR(15) NOT NULL,'
                               . 'PRIMARY KEY (id))';
                       
                       if (mysqli_query($parking_table)) {
                           
                           $ordine_table = 'CREATE TABLE Ordine ( '
                                   . 'id BIGINT NOT NULL, '
                                   . 'utenteID BIGINT NOT NULL, '
                                   . 'item INT DEFAULT NULL, '
                                   . 'pagato BIT NOT NULL DEFAULT 0, '
                                   . 'PRIMARY KEY (id),'
                                   . 'FOREIGN KEY (utenteID) REFERENCES Utente(id) ON DELETE CASCADE ON UPDATE CASCADE)';
                           
                           if (mysqli_query($ordine_table)) {
                               
                               $prenotazione_table = 'CREATE TABLE Prenotazione ( '
                                       . 'id BIGINT UNIQUE NOT NULL, '
                                       . 'data_prelievo DATE NOT NULL, '
                                       . 'data_consegna DATE NOT NULL, '
                                       . 'ordineID BIGINT NOT NULL, '
                                       . 'mezzoTarga VARCHAR(8) NOT NULL, '
                                       . 'PRIMARY KEY (id), '
                                       . 'FOREIGN KEY (ordineID) REFERENCES Ordine(id) ON DELETE CASCADE ON UPDATE CASCADE, '
                                       . 'FOREIGN KEY (mezzoTarga) REFERENCES Mezzo(targa) ON DELETE CASCADE ON UPDATE CASCADE)';
                               
                               if (mysqli_query($prenotazione_table)) {
                                   
                                   $tmpParking = 'CREATE TABLE Prenotazione_Parcheggio ('
                                           . 'prenotazioneID BIGINT NOT NULL,'
                                           . 'parcheggioID BIGINT NOT NULL, '
                                           . 'FOREIGN KEY (prenotazioneID) REFERENCES Prenotazione(id) ON DELETE CASCADE ON UNPDATE CASCADE,'
                                           . 'FOREIGN KEY (pracheggioID) REFERENCES Parcheggio(id) ON DELETE CASCADE ON UPDATE CASCADE)';
                                   
                                   if (mysqli_query($tmpParking)) {
                                       
                                       // Il database è stato creato correttamente
                                       
                                       return TRUE;
                                       
                                   } else return $this->createProcedureError($paramConnection);
                                   
                               } else return $this->createProcedureError($paramConnection);
                               
                           } else return $this->createProcedureError($paramConnection);

                       } else return $this->createProcedureError($paramConnection);
                       
                   } else return $this->createProcedureError($paramConnection);
                   
               } else return $this->createProcedureError($paramConnection);
               
           } else return $this->createProcedureError($paramConnection);
           
        } else return $this->createProcedureError($paramConnection);
        
    }
    
    public function insertSampleData() {
        // Con questa devo caricare i dati di prova sul db
    }
    
    private function createProcedureError($paramConnection) {
        
        // Procedura d'escape per quando la creazione non va a buon fine
        
        // Cancello il db
        
        echo mysqli_error();
        $drop_db = "DROP Database " . $paramConnection['nomedb'];
        mysqli_query($drop_db);

        return FALSE;
                                       
    }
    
}

?>
