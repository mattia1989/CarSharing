DROP DATABASE IF EXISTS carsharing;
CREATE DATABASE carsharing;

CREATE TABLE carsharing.Utente (
  email VARCHAR(25) UNIQUE NOT NULL PRIMARY KEY,
  password VARCHAR(256) NOT NULL,
  nome VARCHAR(40) NOT NULL,
  nDocumento VARCHAR(20) NOT NULL,
  stato BINARY NOT NULL DEFAULT FALSE,
  admin BINARY NOT NULL DEFAULT FALSE
) ENGINE = InnoDB;

CREATE TABLE carsharing.Mezzo (
  id BIGINT UNIQUE NOT NULL AUTO_INCREMENT PRIMARY KEY,
  targa VARCHAR(10) NOT NULL,
  modello VARCHAR(50) NOT NULL,
  cilindrata DOUBLE NOT NULL,
  carburante VARCHAR(100) NOT NULL,
  km FLOAT NOT NULL,
  colore VARCHAR(20) NOT NULL,
  prezzo_giornaliero FLOAT NOT NULL,
  immagine MEDIUMBLOB NOT NULL,
  stato BOOLEAN NOT NULL
) ENGINE = InnoDB;

CREATE TABLE carsharing.Parcheggio (
  id BIGINT UNIQUE NOT NULL AUTO_INCREMENT PRIMARY KEY,
  indirizzo VARCHAR(50) NOT NULL,
  citta VARCHAR(30) NOT NULL,
  provincia VARCHAR(2) NOT NULL
) ENGINE = InnoDB;

CREATE TABLE carsharing.Prenotazione (
  id BIGINT UNIQUE NOT NULL AUTO_INCREMENT PRIMARY KEY,
  user_email VARCHAR(25) NOT NULL,
  data_prelievo DATE NOT NULL,
  data_consegna DATE,
  mezzo_id BIGINT NOT NULL,
  CONSTRAINT `utente_noleggio` FOREIGN KEY (user_email) REFERENCES carsharing.Utente(email),
  CONSTRAINT `mezzo_noleggio` FOREIGN KEY (mezzo_id) REFERENCES carsharing.Mezzo(id)
) ENGINE = InnoDB;

CREATE TABLE carsharing.Prenotazione_Parcheggio (
  id BIGINT NOT NULL AUTO_INCREMENT,
  id_prenotazione BIGINT NOT NULL,
  id_parcheggio BIGINT NOT NULL,
  PRIMARY KEY (id),
  CONSTRAINT `prenotazione` FOREIGN KEY (id_prenotazione) REFERENCES carsharing.Prenotazione(id),
  CONSTRAINT `parcheggio` FOREIGN KEY (id_parcheggio) REFERENCES carsharing.Parcheggio(id)
) ENGINE = InnoDB;

CREATE TABLE carsharing.UserRecovery (
  email VARCHAR(25) NOT NULL PRIMARY KEY,
  requestcode VARCHAR(256) NOT NULL
) ENGINE = InnoDB;
