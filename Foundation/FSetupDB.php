<?php

/**
 * Class FInstallaDB
 * Crea il DB al primo avvio
 * @author Mattia Di Luca
 */
class FSetupDB {

    public function __construct() {
    }

    public function creaDB($paramConnection) {
        $tmpConnection = mysqli_connect($paramConnection['localhost'], $paramConnection['username'], $paramConnection['password']);

        if (!$tmpConnection) {
            // errore connessione
        } else {

            // creo il db
            $creaDB = "DROP DATABASE IF EXISTS ".$paramConnection['database'].";
                CREATE DATABASE ".$paramConnection['database'].";";
            if (!mysqli_query($tmpConnection, $creaDB)) {
                // errore creazione db
            } else {
                // setto il DB
                mysqli_select_db($tmpConnection, $paramConnection['database']);
                // creo le tabelle
                $user_table = "CREATE TABLE carsharing2.Utente (
                    email VARCHAR(25) UNIQUE NOT NULL PRIMARY KEY,
                    password VARCHAR(256) NOT NULL,
                    name VARCHAR(40) NOT NULL,
                    nDocumento VARCHAR(20) NOT NULL,
                    stato BINARY NOT NULL DEFAULT FALSE,
                    admin BINARY NOT NULL DEFAULT FALSE
                    ) ENGINE = InnoDB;";

                if (!mysqli_query($tmpConnection, $user_table)) {
                    // errore creazione tabella utente
                } else {
                    $tabella_mezzo = "CREATE TABLE Mezzo (
                      id BIGINT UNIQUE NOT NULL AUTO_INCREMENT PRIMARY KEY,
                      targa VARCHAR(10) NOT NULL,
                      modello VARCHAR(50) NOT NULL,
                      cilindrata DOUBLE NOT NULL,
                      carburante VARCHAR(100) NOT NULL,
                      km FLOAT NOT NULL,
                      colore VARCHAR(20) NOT NULL,
                      prezzo_giornaliero FLOAT NOT NULL
                    ) ENGINE = InnoDB;";

                    if (!mysqli_query($tmpConnection, $tabella_mezzo)) {
                        // errore creazione tabella mezzo
                    } else {
                        $tabella_parcheggio = "CREATE TABLE Parcheggio (
                          id BIGINT UNIQUE NOT NULL AUTO_INCREMENT PRIMARY KEY,
                          indirizzo VARCHAR(50) NOT NULL,
                          citta VARCHAR(30) NOT NULL,
                          provincia VARCHAR(2) NOT NULL
                        ) ENGINE = InnoDB;";

                        if (!mysqli_query($tmpConnection, $tabella_parcheggio)) {
                            // errore creazione tabella parcheggio
                        } else {
                            $tabella_prenotazioni = "CREATE TABLE Prenotazione (
                                  id BIGINT UNIQUE NOT NULL AUTO_INCREMENT PRIMARY KEY,
                                  user_email VARCHAR(25) NOT NULL,
                                  data_prelievo DATE NOT NULL,
                                  data_consegna DATE NOT NULL,
                                  parcheggio_prelievo BIGINT NOT NULL,
                                  parcheggio_consegna BIGINT NOT NULL,
                                  mezzo_id BIGINT NOT NULL,
                                  pagato BINARY NOT NULL DEFAULT FALSE,
                                  CONSTRAINT `utente_noleggio` FOREIGN KEY (user_email) REFERENCES Utente(email),
                                  CONSTRAINT `mezzo_noleggio` FOREIGN KEY (mezzo_id) REFERENCES Mezzo(id)
                                ) ENGINE = InnoDB;";

                            if (!mysqli_query($tmpConnection, $tabella_prenotazioni)) {
                                // errore creazione tabella prenotazioni
                            } else {
                                $tabella_link = "CREATE TABLE Prenotazione_Parcheggio (
                                  id_prenotazione BIGINT NOT NULL,
                                  id_parcheggio BIGINT NOT NULL,
                                  PRIMARY KEY (id_prenotazione, id_parcheggio),
                                  CONSTRAINT `prenotazione` FOREIGN KEY (id_prenotazione) REFERENCES Prenotazione(id),
                                  CONSTRAINT `parcheggio` FOREIGN KEY (id_parcheggio) REFERENCES Parcheggio(id)
                                ) ENGINE = InnoDB;";

                                if (!mysqli_query($tmpConnection, $tabella_link)) {
                                    // errore creazione tabella prenotazione_parcheggio
                                } else {
                                    // è andato tutto a buon fine
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    public function inserisciDatiDiProva() {
        // qui faccio l'upload dei dati che mi possono servire
    }

}

?>
