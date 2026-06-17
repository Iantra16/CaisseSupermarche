
PRAGMA foreign_keys = ON;

-- Création des tables
CREATE TABLE IF NOT EXISTS utilisateur (
    id       INTEGER PRIMARY KEY AUTOINCREMENT,
    login    TEXT NOT NULL UNIQUE,
    password TEXT NOT NULL
);

CREATE TABLE IF NOT EXISTS caisse (
    id      INTEGER PRIMARY KEY AUTOINCREMENT,
    numero  TEXT NOT NULL UNIQUE,
    libelle TEXT
);

CREATE TABLE IF NOT EXISTS produit (
    id             INTEGER PRIMARY KEY AUTOINCREMENT,
    designation    TEXT NOT NULL,
    prix           REAL NOT NULL,
    quantite_stock INTEGER NOT NULL DEFAULT 0
);

CREATE TABLE IF NOT EXISTS achat (
    id         INTEGER PRIMARY KEY AUTOINCREMENT,
    caisse_id  INTEGER NOT NULL,
    date_achat TEXT DEFAULT (datetime('now')),
    statut     TEXT DEFAULT 'en_cours',
    FOREIGN KEY (caisse_id) REFERENCES caisse(id)
);

CREATE TABLE IF NOT EXISTS achat_ligne (
    id            INTEGER PRIMARY KEY AUTOINCREMENT,
    achat_id      INTEGER NOT NULL,
    produit_id    INTEGER NOT NULL,
    quantite      INTEGER NOT NULL,
    prix_unitaire REAL NOT NULL,
    montant       REAL NOT NULL,
    FOREIGN KEY (achat_id)  REFERENCES achat(id),
    FOREIGN KEY (produit_id) REFERENCES produit(id)
);

-- Données initiales : 2 caisses
INSERT INTO caisse (numero, libelle) VALUES ('C01', 'Caisse 1');
INSERT INTO caisse (numero, libelle) VALUES ('C02', 'Caisse 2');

-- Données initiales : 5 produits
INSERT INTO produit (designation, prix, quantite_stock) VALUES ('Biscuit',  1000, 50);
INSERT INTO produit (designation, prix, quantite_stock) VALUES ('Pain',      400, 30);
INSERT INTO produit (designation, prix, quantite_stock) VALUES ('Lait',      800, 40);
INSERT INTO produit (designation, prix, quantite_stock) VALUES ('Sucre',     600, 60);
INSERT INTO produit (designation, prix, quantite_stock) VALUES ('Huile',    1500, 25);

-- Utilisateur par défaut (mot de passe : admin)
INSERT INTO utilisateur (login, password) VALUES ('admin', 'admin');