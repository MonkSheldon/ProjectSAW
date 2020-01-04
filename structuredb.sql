CREATE TABLE cliente (
    idCliente      INT AUTO_INCREMENT PRIMARY KEY,
    email          VARCHAR(30) UNIQUE,
    pword          VARCHAR(41) NOT NULL,
    cookie         INT,
    isAdmin        TINYINT NOT NULL DEFAULT 0,
    nome           VARCHAR(20) NOT NULL,
    cognome        VARCHAR(20) NOT NULL,
    telefono       VARCHAR(15)
);

CREATE TABLE ordine (
    idOrdine       INT AUTO_INCREMENT PRIMARY KEY,
    dataOra        DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    idCliente      INT NOT NULL,
    UNIQUE(dataOra, idCliente),
    FOREIGN KEY (idCliente) REFERENCES cliente(idCliente)
);

CREATE TABLE modello (
    idModello      INT AUTO_INCREMENT PRIMARY KEY,
    nome           VARCHAR(20),
    marca          VARCHAR(20),
    tipoMotore     ENUM('benzina', 'gasolio', 'elettrico', 'velocipede') NOT NULL,
    tipoModello    ENUM('macchina', 'moto', 'treno', 'nave', 'aereo', 'bicicletta') NOT NULL,
    noPasseggeri   INT NOT NULL,
    peso           DECIMAL(5, 2) NOT NULL,
    potenza        DECIMAL(5, 2) NOT NULL,
    prezzo         DECIMAL(5, 2) NOT NULL,
    larghezza      DECIMAL(5, 2) NOT NULL,
    lunghezza      DECIMAL(5, 2) NOT NULL,
    altezza        DECIMAL(5, 2) NOT NULL,
    colore         VARCHAR(7) NOT NULL,
    UNIQUE(nome, marca)
);

CREATE TABLE cliente_modello (
    idCliente      INT NOT NULL,
    idModello      INT NOT NULL,
    FOREIGN KEY (idCliente) REFERENCES cliente(idCliente),
    FOREIGN KEY (idModello) REFERENCES modello(idModello),
    PRIMARY KEY(idCliente, idModello)
);

CREATE TABLE veicolo (
    targa          CHAR(7) PRIMARY KEY,
    idOrdine       INT NOT NULL,
    idModello      INT NOT NULL,
    FOREIGN KEY (idOrdine) REFERENCES ordine(idOrdine),
    FOREIGN KEY (idModello) REFERENCES modello(idModello)
);
