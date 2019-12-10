CREATE TABLE cliente (
	idCliente      INT AUTO_INCREMENT PRIMARY KEY,
    email          VARCHAR(30) UNIQUE,
    pword          VARCHAR(41) NOT NULL,
    cookie         TIMESTAMP,
    nome           VARCHAR(20) NOT NULL,
    cognome        VARCHAR(20) NOT NULL,
    telefono       VARCHAR(15)
);

CREATE TABLE ordine (
	idOrdine       INT AUTO_INCREMENT PRIMARY KEY,
    dataOra        DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    idCliente      INT NOT NULL,
    noArticoli     INT NOT NULL,
    sconto         DECIMAL(4, 2) NOT NULL DEFAULT 0.0,
    UNIQUE(dataOra, idCliente),
    FOREIGN KEY (idCliente) REFERENCES cliente(idCliente)
);

CREATE TABLE categoria (
    idCategoria    INT AUTO_INCREMENT PRIMARY KEY,
    nome           VARCHAR(20) UNIQUE,
    tipoMezzo      ENUM('marea', 'aerea', 'terrea')
);

CREATE TABLE modello (
	nome           VARCHAR(20),
    marca          VARCHAR(20),
    idCategoria    INT NOT NULL,
    tipoMotore     ENUM('benzina', 'gasolio', 'elettrico', 'velocipede') NOT NULL,
    noPasseggeri   INT NOT NULL,
    peso           DECIMAL(5, 2) NOT NULL,
    potenza        DECIMAL(5, 2) NOT NULL,
    prezzo         DECIMAL(5, 2) NOT NULL,
    larghezza      DECIMAL(5, 2) NOT NULL,
    lunghezza      DECIMAL(5, 2) NOT NULL,
    altezza        DECIMAL(5, 2) NOT NULL,
    PRIMARY KEY(nome, marca),
    FOREIGN KEY (idCategoria) REFERENCES categoria(idCategoria)
);

CREATE TABLE veicolo (
	targa          CHAR(7) PRIMARY KEY,
    idOrdine       INT NOT NULL,
    nome           VARCHAR(20) NOT NULL,
    marca          VARCHAR(20) NOT NULL,
    colore         VARCHAR(20) NOT NULL,
    prezzoFinale   DECIMAL(5, 2) NOT NULL,
    FOREIGN KEY (nome, marca) REFERENCES modello(nome, marca),
    FOREIGN KEY (idOrdine) REFERENCES ordine(idOrdine)
);
