CREATE DATABASE library;
USE library;

-- =====================
-- TABLE RAYON
-- =====================
CREATE TABLE rayon (
    rayon_id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL
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
    cin VARCHAR(8) NOT NULL UNIQUE
);

-- =====================
-- TABLE OUVRAGE
-- =====================
CREATE TABLE ouvrage (
    ouvrage_id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(200) NOT NULL,
    annee_publication YEAR NOT NULL,
    rayon_id INT NOT NULL,
    FOREIGN KEY (rayon_id) REFERENCES rayon(rayon_id)
);

-- =====================
-- TABLE ASSOCIATION OUVRAGE / AUTEUR
-- =====================
CREATE TABLE ouvrage_auteur (
    ouvrage_id INT,
    auteur_id INT,
    PRIMARY KEY (ouvrage_id, auteur_id),
    FOREIGN KEY (ouvrage_id) REFERENCES ouvrage(ouvrage_id),
    FOREIGN KEY (auteur_id) REFERENCES auteur(auteur_id)
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
    FOREIGN KEY (ouvrage_id) REFERENCES ouvrage(ouvrage_id)
);

-- =====================
-- TABLE PERSONNEL
-- =====================
CREATE TABLE personnel (
    personnel_id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    tel VARCHAR(15) NOT NULL UNIQUE,
    mot_de_passe VARCHAR(255) NOT NULL,
    chef_id INT NULL,
    FOREIGN KEY (chef_id) REFERENCES personnel(personnel_id)
);



-- insert daataa----------------------------------------------------------------------------------------------------

-- =====================
-- DATA FOR RAYON
-- =====================
INSERT INTO rayon (nom) VALUES
('Littérature'),
('Science'),
('Histoire'),
('Art'),
('Informatique'),
('Philosophie'),
('Biologie'),
('Mathématiques'),
('Géographie'),
('Musique');

-- =====================
-- DATA FOR AUTEUR
-- =====================
INSERT INTO auteur (nom, prenom) VALUES
('Hugo', 'Victor'),
('Camus', 'Albert'),
('Flaubert', 'Gustave'),
('Curie', 'Marie'),
('Einstein', 'Albert'),
('Shakespeare', 'William'),
('Dumas', 'Alexandre'),
('Hemingway', 'Ernest'),
('Tolkien', 'J.R.R.'),
('Proust', 'Marcel');

-- =====================
-- DATA FOR LECTEUR
-- =====================
INSERT INTO lecteur (nom, prenom, email, tel, cin) VALUES
('El Fassi', 'Ahmed', 'ahmed.elfassi@email.com', '0612345678', 'AB123456'),
('Benali', 'Salma', 'salma.benali@email.com', '0612345679', 'AB123457'),
('Rashid', 'Youssef', 'youssef.rashid@email.com', '0612345680', 'AB123458'),
('Nadia', 'Fatima', 'fatima.nadia@email.com', '0612345681', 'AB123459'),
('Karim', 'Said', 'karim.said@email.com', '0612345682', 'AB123460'),
('Leila', 'Hanae', 'hanae.leila@email.com', '0612345683', 'AB123461'),
('Omar', 'Bilal', 'bilal.omar@email.com', '0612345684', 'AB123462'),
('Sara', 'Imane', 'sara.imane@email.com', '0612345685', 'AB123463'),
('Yassine', 'Amine', 'yassine.amine@email.com', '0612345686', 'AB123464'),
('Rania', 'Meryem', 'meryem.rania@email.com', '0612345687', 'AB123465');

-- =====================
-- DATA FOR OUVRAGE
-- =====================
INSERT INTO ouvrage (titre, annee_publication, rayon_id) VALUES
('Les Misérables', 1912, 1),
('LÉtranger', 1942, 1),
('Madame Bovary', 1920, 1),
('Principes de Chimie', 1903, 2),
('Relativité: Théorie et Applications', 1916, 2),
('Hamlet', 1980, 1),
('Le Comte de Monte-Cristo', 2000, 1),
('Le Vieil Homme et la Mer', 1952, 1),
('Le Seigneur des Anneaux', 1954, 1),
('À la recherche du temps perdu', 1913, 1);


INSERT INTO ouvrage (titre, annee_publication, rayon_id) VALUES
('le book de test', 1952, 4);

-- =====================
-- DATA FOR OUVRAGE_AUTEUR
-- =====================
INSERT INTO ouvrage_auteur (ouvrage_id, auteur_id) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10);

-- =====================
-- DATA FOR EMPRUNT
-- =====================
INSERT INTO emprunt (date_emprunt, date_retour_prevue, date_retour_effective, lecteur_id, ouvrage_id) VALUES
('2026-01-01', '2026-01-15', NULL, 1, 1),
('2026-01-02', '2026-01-16', NULL, 2, 2),
('2026-01-03', '2026-01-17', NULL, 3, 3),
('2026-01-04', '2026-01-18', NULL, 4, 4),
('2026-01-05', '2026-01-19', NULL, 5, 5),
('2026-01-06', '2026-01-20', NULL, 6, 6),
('2026-01-07', '2026-01-21', NULL, 7, 7),
('2026-01-08', '2026-01-22', NULL, 8, 8),
('2026-01-09', '2026-01-23', NULL, 9, 9),
('2026-01-10', '2026-01-24', NULL, 10, 10);

-- =====================
-- DATA FOR PERSONNEL
-- =====================
INSERT INTO personnel (nom, email, tel, mot_de_passe, chef_id) VALUES
('Ahmed', 'ahmed.personnel@email.com', '0611000001', 'pass123', NULL),
('Salma', 'salma.personnel@email.com', '0611000002', 'pass123', 1),
('Youssef', 'youssef.personnel@email.com', '0611000003', 'pass123', 1),
('Fatima', 'fatima.personnel@email.com', '0611000004', 'pass123', 2),
('Karim', 'karim.personnel@email.com', '0611000005', 'pass123', 2),
('Hanae', 'hanae.personnel@email.com', '0611000006', 'pass123', 3),
('Bilal', 'bilal.personnel@email.com', '0611000007', 'pass123', 3),
('Imane', 'imane.personnel@email.com', '0611000008', 'pass123', 4),
('Amine', 'amine.personnel@email.com', '0611000009', 'pass123', 4),
('Meryem', 'meryem.personnel@email.com', '0611000010', 'pass123', 5);


                                        -- inserted the data -------------------------------------------------------------------------------------------------------------------



SELECT * FROM rayon;

SELECT nom,prenom FROM auteur;

SELECT titre,annee_publication FROM ouvrage;

SELECT nom,prenom,email FROM lecteur;

SELECT * FROM ouvrage
WHERE annee_publication >1950;

SELECT *
FROM lecteur
WHERE nom LIKE 'M%';
SELECT *
FROM ouvrage
ORDER BY annee_publication DESC;

SELECT *
FROM emprunt
WHERE date_retour_effective IS NULL;


SELECT ouvrage.titre,ouvrage.annee_publication,rayon.nom AS rayon_name
FROM ouvrage
INNER JOIN rayon  ON ouvrage.rayon_id = rayon.rayon_id
;



SELECT ouvrage.titre ,auteur.nom AS nom , auteur.prenom AS prenom
FROM ouvrage
INNER JOIN ouvrage_auteur  ON ouvrage.ouvrage_id = ouvrage_auteur.ouvrage_id
INNER JOIN auteur ON ouvrage_auteur.auteur_id=auteur.auteur_id
;


SELECT lecteur.nom, lecteur.prenom , lecteur.email, lecteur.cin 
FROM lecteur
INNER JOIN emprunt ON lecteur.lecteur_id=emprunt.lecteur_id;



SELECT rayon_id,count(*) AS nombre_de_ouvrage
from ouvrage
GROUP BY rayon_id;

-- select done------------------------------------------------------

UPDATE lecteur
SET lecteur.email='fatima.nadia123@email.com'
WHERE lecteur.cin='AB123459';


UPDATE lecteur
SET tel = '0606060606'
WHERE cin LIKE '%123464';

UPDATE ouvrage
SET rayon_id=3
WHERE ouvrage.titre='Les Misérables';


UPDATE emprunt
SET emprunt.date_retour_effective=CURRENT_DATE
WHERE lecteur_id=1 AND ouvrage_id=1;


UPDATE personnel
SET chef_id=5
WHERE nom LIKE 'Imane' AND personnel_id != 5;


DELETE FROM emprunt 
WHERE emprunt.emprunt_id=2;

DELETE lecteur FROM lecteur
LEFT JOIN emprunt ON lecteur.lecteur_id = emprunt.lecteur_id
WHERE emprunt.lecteur_id IS NULL;


SELECT * FROM ouvrage
LEFT JOIN emprunt ON ouvrage.ouvrage_id = emprunt.ouvrage_id
WHERE emprunt.ouvrage_id IS NULL;



DELETE FROM ouvrage_auteur
WHERE ouvrage_id IN (SELECT * FROM(
    SELECT ouvrage_id
    FROM ouvrage
    LEFT JOIN emprunt 
        ON ouvrage.ouvrage_id = emprunt.ouvrage_id
    WHERE emprunt.ouvrage_id IS NULL)
 AS sub_request);


delete from ouvrage_auteur
where ouvrage_id in (
	select ouvrage_id
    from emprunt
    where emprunt.ouvrage_id IS NULL
);
delete from ouvrage
where ouvrage_id in (
	select ouvrage_id
    from emprunt
    where emprunt.ouvrage_id IS NULL
);











