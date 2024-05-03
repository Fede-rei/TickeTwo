CREATE DATABASE IF NOT EXISTS ticketwo;
USE ticketwo;

CREATE TABLE IF NOT EXISTS Utente(
    id_utente INT AUTO_INCREMENT,
    password VARCHAR(50),
    tipo BOOLEAN,
    mail VARCHAR(50),
    id_ticket INT,
    PRIMARY KEY(id_utente)
);

CREATE TABLE IF NOT EXISTS Evento(
    id_evento INT AUTO_INCREMENT,
    nome VARCHAR(50),
    descrizione VARCHAR(500),
    data DATETIME,
    luogo VARCHAR(50),
    image VARCHAR(200),
    PRIMARY KEY(id_evento)
);

CREATE TABLE IF NOT EXISTS Biglietto(
    id_Biglietto INT AUTO_INCREMENT,
    prezzo DOUBLE,
    posto INT,
    id_user INT,
    id_event INT,
    PRIMARY KEY(id_Biglietto),
    FOREIGN KEY(id_event) REFERENCES Evento(id_evento)
);


CREATE TABLE IF NOT EXISTS Acquisti(
    id_acquisto INT AUTO_INCREMENT,
    id_cliente INT,
    id_ticket INT,
    FOREIGN KEY(id_acquisto) REFERENCES Utente(id_utente),
    FOREIGN KEY(id_ticket) REFERENCES Biglietto(id_Biglietto)
);