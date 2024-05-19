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

CREATE TABLE IF NOT EXISTS Carrello(
    id_carrello INT AUTO_INCREMENT,
    id_biglietto INT,
    id_utente INT,
    quantita INT,
    PRIMARY KEY(id_carrello),
    FOREIGN KEY(id_utente) REFERENCES Utente(id_utente),
    FOREIGN KEY(id_biglietto) REFERENCES Biglietto(id_Biglietto)
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

CREATE TRIGGER aggiornamento_posti_disponibili_update
    AFTER UPDATE ON Acquisti
    FOR EACH ROW
BEGIN
    UPDATE Evento SET posti = posti - (NEW.q - OLD.q) WHERE id_evento = NEW.id_ticket;
END;


-- pw: !Admin2024!
INSERT INTO Utente (id_utente,username,password,tipo,mail,pfp) VALUES (0,'Admin','$2y$10$Dwi5SNVH1O3jZp7SlMIykuA9M0hX9YJod5mlxn1ZhvuqoJk86qPhO','1','Admin@ticketwo.com','0.png');


INSERT INTO Evento (nome, descrizione, data, luogo, image, posti) VALUES
    ('Concerto Rock', 'Un concerto emozionante con le migliori band rock della citta.', '2024-06-15 20:00:00', 'Teatro XYZ', '1.jpg', 100),
    ('Mostra Arte Moderna', 'Una mostra che esplora le ultime tendenze dell arte contemporanea.', '2024-07-10 10:00:00', 'Galleria Arte ABC', '2.jpg', 50),
    ('Corso di Cucina Italiana', 'Impara a cucinare i piatti italiani piu famosi con uno chef professionista.', '2024-08-05 18:00:00', 'Scuola di Cucina Italia', '3.jpg', 30),
    ('Festival del Cinema', 'Proiezione dei migliori film indipendenti.', '2024-09-20 18:00:00', 'Cinema Paradiso', '4.jpg', 150),
    ('Spettacolo di Magia', 'Uno spettacolo di magia per tutta la famiglia.', '2024-06-25 17:00:00', 'Teatro Magico', '5.jpg', 120),
    ('Conferenza Tecnologia', 'Le ultime novita nel campo della tecnologia.', '2024-10-15 09:00:00', 'Centro Congressi', '6.jpg', 200),
    ('Maratona Benefica', 'Una corsa per raccogliere fondi per la ricerca medica.', '2024-07-22 07:00:00', 'Parco Centrale', '7.jpg', 500),
    ('Spettacolo Teatrale', 'Una rappresentazione teatrale emozionante.', '2024-11-30 20:00:00', 'Teatro Comunale', '8.jpg', 80),
    ('Festival del Cibo', 'Degustazione di cibi provenienti da tutto il mondo.', '2024-08-12 12:00:00', 'Piazza Grande', '9.jpg', 250),
    ('Esposizione Canina', 'Una competizione per i migliori cani di razza.', '2024-09-05 10:00:00', 'Fiera Canina', '10.jpg', 300);

INSERT INTO Biglietto (prezzo, id_event) VALUES
    (50.00, 1), -- Concerto Rock
    (20.00, 2), -- Mostra Arte Moderna
    (60.00, 3), -- Corso di Cucina Italiana
    (30.00, 4), -- Festival del Cinema
    (25.00, 5), -- Spettacolo di Magia
    (100.00, 6), -- Conferenza Tecnologia
    (10.00, 7), -- Maratona Benefica
    (35.00, 8), -- Spettacolo Teatrale
    (15.00, 9), -- Festival del Cibo
    (40.00, 10); -- Esposizione Canina
