CREATE DATABASE blog_db;
USE blog_db;
 -- table utilisateur
 CREATE TABLE utilisateur(
    id_utilisateur INT AUTO_INCREMENT PRIMARY KEY,
	nom VARCHAR(100) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
	mot_de_passe VARCHAR(255)  NOT NULL,
	date_inscreption DATETIME DEFAULT CURRENT_TIMESTAMP
 )	;
 -- table CATEGORY
  CREATE TABLE category(
    id_category INT AUTO_INCREMENT PRIMARY KEY,
	nom VARCHAR(100) NOT NULL UNIQUE
 )	;
 -- table ARTICLE
 CREATE TABLE article(
    id_article INT AUTO_INCREMENT PRIMARY KEY,
	titre VARCHAR(100) NOT NULL ,
    contenue TEXT NOT NULL,
	mot_de_passe VARCHAR(255)  NOT NULL,
	date_publication DATETIME DEFAULT CURRENT_TIMESTAMP,
    statut ENUM('publie','brouillon') NOT NULL,
    id_utilisateur INT,
	id_category INT,
     FOREIGN KEY (id_utilisateur) REFERENCES utilisateur(id_utilisateur),
     FOREIGN KEY (id_category) REFERENCES category(id_category)
     
 )	;
 -- table COMMENTAIRE
 CREATE TABLE commentaire(
    id_commentaire INT AUTO_INCREMENT PRIMARY KEY,
	date_commentaire DATETIME DEFAULT CURRENT_TIMESTAMP,
    id_utilisateur INT,
	id_article INT,
     FOREIGN KEY (id_utilisateur) REFERENCES utilisateur(id_utilisateur),
     FOREIGN KEY (id_article) REFERENCES article(id_article)
     
 )	;