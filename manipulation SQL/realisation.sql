CREATE DATABASE library_realisation;
USE library_realisation;

-- =====================
-- TABLE RAYON
-- =====================
CREATE TABLE rayon (
    rayon_id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    CONSTRAINT unq_nom_rayon CHECK (nom IN ('Littérature','Science','Histoire','Art','Informatique','Philosophie','Biologie','Mathématiques','Géographie','Musique'))
);

-- =====================
-- TABLE AUTEUR
-- =====================
CREATE TABLE auteur (
    auteur_id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL
);

-- =====================
-- TABLE LECTEUR
-- =====================
CREATE TABLE lecteur (
    lecteur_id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    tel VARCHAR(15) NOT NULL UNIQUE,
    cin VARCHAR(8) NOT NULL UNIQUE,
    CONSTRAINT check_phone_number CHECK(CHAR_LENGTH(tel) >= 10) 
);

-- =====================
-- TABLE OUVRAGE
-- =====================
CREATE TABLE ouvrage (
    ouvrage_id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(200) NOT NULL,
    annee_publication YEAR NOT NULL,
    rayon_id INT NOT NULL,
    FOREIGN KEY (rayon_id) REFERENCES rayon(rayon_id),
    CONSTRAINT unq_ouvrage UNIQUE (ouvrage_id,annee_publication),
    CONSTRAINT validation_date_pub CHECK  (annee_publication >=1900 AND annee_publication <= YEAR(CURRENT_DATE()))
);

-- =====================
-- TABLE ASSOCIATION OUVRAGE / AUTEUR
-- =====================
CREATE TABLE ouvrage_auteur (
    ouvrage_id INT,
    auteur_id INT,
    PRIMARY KEY (ouvrage_id, auteur_id),
    FOREIGN KEY (ouvrage_id) REFERENCES ouvrage(ouvrage_id),
    FOREIGN KEY (auteur_id) REFERENCES auteur(auteur_id),
    CONSTRAINT unq_ouvrage_auteur UNIQUE (ouvrage_id,auteur_id)
    
);

-- =====================
-- TABLE EMPRUNT
-- =====================
CREATE TABLE emprunt (
    emprunt_id INT AUTO_INCREMENT PRIMARY KEY,
    date_emprunt DATE NOT NULL DEFAULT CURRENT_DATE,
    date_retour_prevue DATE NOT NULL,
    date_retour_effective DATE NULL,
    lecteur_id INT NOT NULL,
    ouvrage_id INT NOT NULL,
    FOREIGN KEY (lecteur_id) REFERENCES lecteur(lecteur_id),
    FOREIGN KEY (ouvrage_id) REFERENCES ouvrage(ouvrage_id),
    CONSTRAINT check_date_emprunt CHECK (date_emprunt <= CURRENT_DATE()),
    CONSTRAINT check_date_retour_effective CHECK ( DATEDIFF(date_retour_prevue, date_emprunt) <= 30)
);

-- =====================
-- TABLE PERSONNEL
-- =====================
CREATE TABLE personnel (
    personnel_id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    cin VARCHAR(8) NOT NULL UNIQUE,
    tel VARCHAR(15) NOT NULL UNIQUE,
    mot_de_passe VARCHAR(255) NOT NULL,
    chef_id INT NULL,
    FOREIGN KEY (chef_id) REFERENCES personnel(personnel_id)
);


