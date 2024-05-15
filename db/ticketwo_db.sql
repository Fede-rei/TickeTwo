CREATE DATABASE IF NOT EXISTS ticketwo;
USE ticketwo;

CREATE TABLE IF NOT EXISTS Utente(
    id_utente INT AUTO_INCREMENT,
    username VARCHAR(50),
    password varchar(200),
    tipo BOOLEAN,
    mail VARCHAR(50),
    pfp VARCHAR(50),
    PRIMARY KEY(id_utente)
);

CREATE TABLE IF NOT EXISTS Evento(
    id_evento INT AUTO_INCREMENT,
    nome VARCHAR(50),
    descrizione VARCHAR(500),
    data DATETIME,
    luogo VARCHAR(50),
    image VARCHAR(20),
    posti INT,
    PRIMARY KEY(id_evento)
);

CREATE TABLE IF NOT EXISTS Biglietto(
    id_Biglietto INT AUTO_INCREMENT,
    prezzo DOUBLE,
    id_event INT,
    PRIMARY KEY(id_Biglietto),
    FOREIGN KEY(id_event) REFERENCES Evento(id_evento)
);

CREATE TABLE IF NOT EXISTS Acquisti(
    id_acquisto INT AUTO_INCREMENT,
    id_cliente INT,
    id_ticket INT,
    q int,
    PRIMARY KEY(id_acquisto),
    FOREIGN KEY(id_cliente) REFERENCES Utente(id_utente),
    FOREIGN KEY(id_ticket) REFERENCES Biglietto(id_Biglietto)
);

CREATE TRIGGER controllo_quantità_biglietti
    BEFORE INSERT ON Acquisti
    FOR EACH ROW
BEGIN
    DECLARE biglietti_disponibili INT;
    SELECT posti INTO biglietti_disponibili FROM Evento WHERE id_evento = NEW.id_ticket;
    IF NEW.q > biglietti_disponibili THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Non ci sono abbastanza biglietti disponibili';
    END IF;
END;

CREATE TRIGGER aggiornamento_posti_disponibili
    AFTER INSERT ON Acquisti
    FOR EACH ROW
BEGIN
    UPDATE Evento SET posti = posti - NEW.q WHERE id_evento = NEW.id_ticket;
END;




CREATE TABLE IF NOT EXISTS Carrello(
    id_carrello INT AUTO_INCREMENT,
    id_biglietto INT,
    id_utente INT,
    quantita INT,
    PRIMARY KEY(id_carrello),
    FOREIGN KEY(id_utente) REFERENCES Utente(id_utente),
    FOREIGN KEY(id_biglietto) REFERENCES Biglietto(id_Biglietto)
);

INSERT INTO Utente (id_utente,username,password,tipo,mail,pfp) VALUES (0,'Admin','$2y$10$Dwi5SNVH1O3jZp7SlMIykuA9M0hX9YJod5mlxn1ZhvuqoJk86qPhO','1','Admin@ticketwo.com','0.png');
