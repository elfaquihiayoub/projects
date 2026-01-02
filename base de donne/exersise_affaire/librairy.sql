CREATE DATABASE librairy;
USE librairy;

CREATE TABLE RAYON (
    RayonID INT AUTO_INCREMENT PRIMARY KEY,
    Nom VARCHAR(100) NOT NULL
    
);

CREATE TABLE AUTEUR (
    AuteurID INT AUTO_INCREMENT PRIMARY KEY,
    Nom VARCHAR(100) NOT NULL
);
CREATE TABLE lecteur (
    LecteurID INT AUTO_INCREMENT PRIMARY KEY,
    Nom VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    tel VARCHAR(13) NOT NULL UNIQUE,
    Cin VARCHAR(8) NOT NULL UNIQUE

);
CREATE TABLE Ouvrage(
    OuvrageID INT AUTO_INCREMENT PRIMARY KEY,
    Titre VARCHAR(60) NOT NULL,
    AneePublication YEAR NOT NULL,
    RayonID INT,
    FOREIGN KEY (RayonID) REFERENCES RAYON(RayonID)

);
CREATE TABLE creationDouvrage(
     OuvrageID INT,
     AuteurID INT,
     PRIMARY KEY (OuvrageID, AuteurID),
    FOREIGN KEY (OuvrageID) REFERENCES Ouvrage(OuvrageID),
    FOREIGN KEY (AuteurID) REFERENCES AUTEUR(AuteurID)
    
);
CREATE TABLE Emprunt(
    EmpruntID INT AUTO_INCREMENT PRIMARY KEY,
    DateEmprunt DATE DEFAULT (CURRENT_DATE) ,
    DateRetour DATE NOT NULL,
    DateRetourPrevue DATE NOT NULL,
    DateRetourEffective DATE  NULL,
    LecteurID INT,
    OuvrageID INT,
    FOREIGN KEY (LecteurID) REFERENCES lecteur(LecteurID),
    FOREIGN KEY (OuvrageID) REFERENCES Ouvrage(OuvrageID)


);
CREATE TABLE PERSONELL(
    PersonellID INT AUTO_INCREMENT PRIMARY KEY,
    Nom VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    tel VARCHAR(13) NOT NULL UNIQUE,
    motDePasse VARCHAR(100) NOT NULL,
    ChefID INT,
    FOREIGN KEY (ChefID) REFERENCES PERSONELL(PersonellID)




);

INSERT INTO RAYON (Nom) VALUES
('Computer Science'),
('Literature'),
('Mathematics'),
('Physics'),
('History');


INSERT INTO AUTEUR (Nom) VALUES
('George Orwell'),
('J.K. Rowling'),
('Albert Camus'),
('Isaac Asimov'),
('Victor Hugo'),
('Paulo Coelho'),
('Fyodor Dostoevsky'),
('Stephen Hawking'),
('Yuval Noah Harari'),
('Jane Austen');


INSERT INTO lecteur (Nom, email, tel, Cin) VALUES
('Ahmed Benali', 'ahmed1@mail.com', '0611111111', 'AA111111'),
('Sara El Amrani', 'sara1@mail.com', '0622222222', 'BB222222'),
('Youssef Karim', 'youssef@mail.com', '0633333333', 'CC333333'),
('Imane Zahra', 'imane@mail.com', '0644444444', 'DD444444'),
('Omar Fassi', 'omar@mail.com', '0655555555', 'EE555555'),
('Khadija Alaoui', 'khadija@mail.com', '0666666666', 'FF666666'),
('Mehdi Rami', 'mehdi@mail.com', '0677777777', 'GG777777'),
('Salma Idrissi', 'salma@mail.com', '0688888888', 'HH888888'),
('Anas Bouchra', 'anas@mail.com', '0699999999', 'II999999'),
('Nour El Din', 'nour@mail.com', '0601010101', 'JJ101010');


INSERT INTO Ouvrage (Titre, AneePublication, RayonID) VALUES
('1984', 1949, 2),
('Harry Potter', 1997, 1),
('The Stranger', 1942, 2),
('Foundation', 1951, 1),
('Les Misérables', 1862, 5),
('The Alchemist', 1988, 2),
('Crime and Punishment', 1866, 2),
('A Brief History of Time', 1988, 4),
('Sapiens', 2011, 5),
('Pride and Prejudice', 1813, 2);


INSERT INTO creationDouvrage (OuvrageID, AuteurID) VALUES
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



INSERT INTO Emprunt (
    DateEmprunt,
    DateRetourPrevue,
    DateRetour,
    DateRetourEffective,
    LecteurID,
    OuvrageID
) VALUES
('2025-01-01', '2025-01-10', '2025-01-10', '2025-01-09', 1, 1),
('2025-01-02', '2025-01-12', '2025-01-12', '2025-01-11', 2, 2),
('2025-01-03', '2025-01-13', '2025-01-13', NULL, 3, 3),
('2025-01-04', '2025-01-14', '2025-01-14', '2025-01-14', 4, 4),
('2025-01-05', '2025-01-15', '2025-01-15', NULL, 5, 5),
('2025-01-06', '2025-01-16', '2025-01-16', '2025-01-15', 6, 6),
('2025-01-07', '2025-01-17', '2025-01-17', NULL, 7, 7),
('2025-01-08', '2025-01-18', '2025-01-18', '2025-01-18', 8, 8),
('2025-01-09', '2025-01-19', '2025-01-19', NULL, 9, 9),
('2025-01-10', '2025-01-20', '2025-01-20', '2025-01-20', 10, 10);




INSERT INTO PERSONELL (Nom, email, tel, motDePasse, ChefID) VALUES
('Admin', 'admin@mail.com', '0600000000', 'admin123', NULL),
('Supervisor', 'supervisor@mail.com', '0600000001', 'super123', 1),
('Staff One', 'staff1@mail.com', '0600000002', 'staff123', 2),
('Staff Two', 'staff2@mail.com', '0600000003', 'staff123', 2),
('Staff Three', 'staff3@mail.com', '0600000004', 'staff123', 2);
