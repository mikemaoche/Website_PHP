/*	Script cr�ation des tables
	pour le site MyAnimTv
	cr�� le : 23 mars 2016	
	cours : Projet Synth�se 
	fait par l'�l�ve : Mike Mao Che
	pour l'enseignant : Jean-Christophe Demers 
	langage : mysql */

-- CR�ATION DE LA BASE DE DONN�ES
DROP DATABASE IF EXISTS test;
CREATE DATABASE test CHARACTER SET 'utf8';

-- ON D�FINIT SUR QUELLE BASE DE DONN�ES ON TRAVAIL
USE test;

-- CR�ATION DES TABLES DANS TEST
DROP TABLE IF EXISTS Usagers;
DROP TABLE IF EXISTS Commentaires;
DROP TABLE IF EXISTS Signalement;
DROP TABLE IF EXISTS Videos;
DROP TABLE IF EXISTS Evaluations;
DROP TABLE IF EXISTS Annonces;
DROP TABLE IF EXISTS Favoris;
DROP TABLE IF EXISTS Demandes;

CREATE TABLE Usagers(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	nom VARCHAR(64),
	email VARCHAR(64),
	mdp TEXT,
	img_path TEXT,
	statut ENUM('usager','admin'),
	UNIQUE(nom),
	UNIQUE(email)
);

CREATE TABLE Commentaires(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	commentaire TEXT,
	datant TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	usagersID INT,
	videosID INT
);

CREATE TABLE Signalement(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	usagersID INT,
	commentaireID INT
);

CREATE TABLE Videos(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	titre VARCHAR(30),
	url TEXT,
	datant TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE Evaluations(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	note INT NOT NULL DEFAULT 0,
	videosID INT,
	usagersID INT
);

CREATE TABLE Favoris(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	usagersID INT,
	videosID INT
);

CREATE TABLE Demandes(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	nom_video VARCHAR(64),
	langue VARCHAR(20),
	usagersID INT
);

COMMIT;