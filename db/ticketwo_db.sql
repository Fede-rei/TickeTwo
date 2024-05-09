CREATE DATABASE IF NOT EXISTS ticketwo;
USE ticketwo;

CREATE TABLE IF NOT EXISTS Utente(
    id_utente INT AUTO_INCREMENT,
    username VARCHAR(50),
    password VARCHAR(50),
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
    image VARCHAR(10000),
    posti INT,
    PRIMARY KEY(id_evento)
);

CREATE TABLE IF NOT EXISTS Biglietto(
    id_Biglietto INT AUTO_INCREMENT,
    prezzo DOUBLE,
    posto INT,
    id_event INT,
    PRIMARY KEY(id_Biglietto),
    FOREIGN KEY(id_event) REFERENCES Evento(id_evento)
);

CREATE TABLE IF NOT EXISTS Acquisti(
    id_acquisto INT AUTO_INCREMENT,
    id_cliente INT,
    id_ticket INT,
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


-- Inserimento di utenti
-- Inserimento di utenti senza la colonna 'username_errato'
INSERT INTO Utente (username, password, tipo, mail, pfp) VALUES
('alice', 'password1', 1, 'alice@example.com', 'pfp_alice.jpg'),
('bob', 'password2', 0, 'bob@example.com', 'pfp_bob.jpg'),
('charlie', 'password3', 1, 'charlie@example.com', 'pfp_charlie.jpg');

-- Inserimento di eventi
INSERT INTO Evento (nome, descrizione, data, luogo, image, posti) VALUES
('Concerto Rock', 'Un concerto di musica rock con band locali', '2024-06-15 19:00:00', 'Arena Civica', 'concerto_rock.jpg', 500),
('Mostra d\'Arte', 'Una mostra d\'arte contemporanea con artisti emergenti', '2024-07-20 10:00:00', 'Galleria d\'Arte Moderna', 'mostra_arte.jpg', 200),
('Seminario Tecnologico', 'Un seminario sulla tecnologia del futuro', '2024-08-10 14:00:00', 'Centro Congressi', 'seminario_tecnologico.jpg', 100);

-- Inserimento di biglietti
INSERT INTO Biglietto (prezzo, posto, id_event) VALUES
(25.00, 1, 1),
(25.00, 2, 1),
(20.00, 1, 2),
(20.00, 2, 2),
(30.00, 1, 3),
(30.00, 2, 3);

-- Inserimento di acquisti
INSERT INTO Acquisti (id_cliente, id_ticket) VALUES
(1, 1),
(2, 2),
(3, 3),
(1, 4),
(2, 5),
(3, 6);

-- Inserimento nel carrello
INSERT INTO Carrello (id_biglietto, id_utente, quantita) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 1, 1),
(5, 2, 1),
(6, 3, 1);

SELECT * FROM Evento WHERE nome LIKE 'concerto%';

-- Inserimento di eventi con nomi che iniziano con 'concerto' e link immagine specifico
INSERT INTO Evento (nome, descrizione, data, luogo, image, posti) VALUES
('Concerto Rock 1', 'Descrizione del concerto rock 1', '2024-06-15 19:00:00', 'Arena Civica', 'https://picsum.photos/200/300', 500),
('Concerto Jazz 2', 'Descrizione del concerto jazz 2', '2024-07-20 10:00:00', 'Galleria d\'Arte Moderna', 'https://picsum.photos/200/300', 200),
('Concerto Classico 3', 'Descrizione del concerto classico 3', '2024-08-10 14:00:00', 'Centro Congressi', 'https://picsum.photos/200/300', 100);
