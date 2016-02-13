DROP DATABASE IF EXISTS carsharing2;
CREATE DATABASE carsharing2;

CREATE TABLE carsharing2.Utente (
  email VARCHAR(25) UNIQUE NOT NULL PRIMARY KEY,
  password VARCHAR(256) NOT NULL,
  name VARCHAR(40) NOT NULL,
  nDocumento VARCHAR(20) NOT NULL,
  stato BINARY NOT NULL DEFAULT FALSE,
  admin BINARY NOT NULL DEFAULT FALSE
) ENGINE = InnoDB;

CREATE TABLE carsharing2.Mezzo (
  id BIGINT UNIQUE NOT NULL AUTO_INCREMENT PRIMARY KEY,
  targa VARCHAR(10) NOT NULL,
  modello VARCHAR(50) NOT NULL,
  cilindrata DOUBLE NOT NULL,
  carburante VARCHAR(100) NOT NULL,
  km FLOAT NOT NULL,
  colore VARCHAR(20) NOT NULL,
  prezzo_giornaliero FLOAT NOT NULL
) ENGINE = InnoDB;

CREATE TABLE carsharing2.Parcheggio (
  id BIGINT UNIQUE NOT NULL AUTO_INCREMENT PRIMARY KEY,
  indirizzo VARCHAR(50) NOT NULL,
  citta VARCHAR(30) NOT NULL,
  provincia VARCHAR(2) NOT NULL
) ENGINE = InnoDB;

CREATE TABLE carsharing2.Prenotazione (
  id BIGINT UNIQUE NOT NULL AUTO_INCREMENT PRIMARY KEY,
  user_email VARCHAR(25) NOT NULL,
  data_prelievo DATE NOT NULL,
  data_consegna DATE NOT NULL,
  parcheggio_prelievo BIGINT NOT NULL,
  parcheggio_consegna BIGINT NOT NULL,
  mezzo_id BIGINT NOT NULL,
  pagato BINARY NOT NULL DEFAULT FALSE,
  CONSTRAINT `utente_noleggio` FOREIGN KEY (user_email) REFERENCES carsharing2.Utente(email),
  CONSTRAINT `mezzo_noleggio` FOREIGN KEY (mezzo_id) REFERENCES carsharing2.Mezzo(id)
) ENGINE = InnoDB;

CREATE TABLE carsharing2.Prenotazione_Parcheggio (
  id_prenotazione BIGINT NOT NULL,
  id_parcheggio BIGINT NOT NULL,
  PRIMARY KEY (id_prenotazione, id_parcheggio),
  CONSTRAINT `prenotazione` FOREIGN KEY (id_prenotazione) REFERENCES carsharing2.Prenotazione(id),
  CONSTRAINT `parcheggio` FOREIGN KEY (id_parcheggio) REFERENCES carsharing2.Parcheggio(id)
) ENGINE = InnoDB;
