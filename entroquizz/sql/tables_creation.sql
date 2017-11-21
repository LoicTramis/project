CREATE TABLE Theme(
        id_theme SERIAL PRIMARY KEY NOT NULL,
        nom_theme VARCHAR(50) UNIQUE NOT NULL
 );

CREATE TABLE Question(
	id_question SERIAL PRIMARY KEY NOT NULL,
	type_question VARCHAR(20) NOT NULL,
	text_question VARCHAR(300) NULL,
	difficulte VARCHAR(20)NOT NULL,
	id_theme INTEGER REFERENCES Theme(id_theme) NOT NULL
);

CREATE TABLE Quizz(
	id_quizz INTEGER PRIMARY KEY NOT NULL,
	id_question INTEGER REFERENCES Question(id_question) NOT NULL
);

CREATE TABLE Question_ON(
	id_question_on SERIAL PRIMARY KEY NOT NULL,
	reponse BOOLEAN NOT NULL,
	id_question INTEGER REFERENCES Question(id_question) NOT NULL
);

CREATE TABLE Question_CM(
	id_question_cm SERIAL PRIMARY KEY NOT NULL,
	choix_1 VARCHAR(30) NOT NULL,
	choix_2 VARCHAR(30) NOT NULL,
	choix_3 VARCHAR(30) NOT NULL,
	choix_4 VARCHAR(30) NOT NULL,
	reponse_1 VARCHAR(30) NOT NULL,
	reponse_2 VARCHAR(30) NOT NULL,
	reponse_3 VARCHAR(30) NOT NULL,
	reponse_4 VARCHAR(30) NOT NULL,
	id_question INTEGER REFERENCES Question(id_question) NOT NULL
);

CREATE TABLE Question_Texte(
	id_question_texte SERIAL PRIMARY KEY NOT NULL,
	reponse_exacte VARCHAR(20) NOT NULL,
	reponse_correct1 VARCHAR(20) NULL,
	reponse_correct2 VARCHAR(20) NULL,
	reponse_correct3 VARCHAR(20) NULL,
	id_question INTEGER REFERENCES Question(id_question) NOT NULL
);

CREATE TABLE Utilisateur(
	id_utilisateur SERIAL PRIMARY KEY NOT NULL,
	login VARCHAR(30) NOT NULL,
	email VARCHAR(30) NOT NULL,
	motdepasse VARCHAR(30) NOT NULL,
	admini BOOLEAN NULL,
	avatar BYTEA NULL,
	badge_niveau BYTEA NULL,
	ip VARCHAR(15) NOT NULL
);

CREATE TABLE Historique(
	id_historique SERIAL PRIMARY KEY NOT NULL,
	type_mode VARCHAR(30) NOT NULL,
	score INTEGER NULL, 
	date_heure TIMESTAMP WITH TIME ZONE NOT NULL,
	difficulté VARCHAR(30) NOT NULL,
	nom_theme VARCHAR(30) NOT NULL,
	id_quizz INTEGER REFERENCES Quizz(id_quizz) NOT NULL ,
	id_utilisateur INTEGER REFERENCES Utilisateur(id_utilisateur) NOT NULL
);

CREATE TABLE Statistique(
	id_utilisateur INTEGER NOT NULL,
	nombre_points INTEGER NOT NULL,
	nombre_quizz INTEGER NOT NULL,  
	classement INTEGER NOT NULL,   
	id_quizz INTEGER REFERENCES Quizz(id_quizz) NOT NULL ,
	id_historique INTEGER REFERENCES Historique(id_historique) NOT NULL 
);

CREATE TABLE Commentaire(
	id_commentaire SERIAL PRIMARY KEY NOT NULL,
	date_heure TIMESTAMP WITH TIME ZONE NOT NULL,
	text_commentaire TEXT NOT NULL,
	id_utilisateur INTEGER REFERENCES Utilisateur(id_utilisateur) NOT NULL

);

CREATE TABLE Proposition(
	id_prop SERIAL PRIMARY KEY NOT NULL,
	type_question VARCHAR(30) NOT NULL,
	text_question VARCHAR(300) NOT NULL,
	id_utilisateur INTEGER REFERENCES Utilisateur(id_utilisateur) NOT NULL
	
);

CREATE TABLE Proposition_Txt(
	id_prop_txt SERIAL PRIMARY KEY NOT NULL, 
	reponse_exacte VARCHAR(20) NOT NULL,
	reponse_correct1 VARCHAR(20) NULL,
	reponse_correct2 VARCHAR(20) NULL,
	reponse_correct3 VARCHAR(20) NULL,
	id_prop INTEGER REFERENCES Proposition(id_prop) NOT NULL 
);

CREATE TABLE Proposition_CM(
	id_prop_cm SERIAL PRIMARY KEY NOT NULL ,
	choix_1 VARCHAR(30) NOT NULL,
	choix_2 VARCHAR(30) NOT NULL,
	choix_3 VARCHAR(30) NOT NULL,
	choix_4 VARCHAR(30) NOT NULL,
	reponse_1  VARCHAR(30) NOT NULL,
	reponse_2 VARCHAR(30) NOT NULL,
	reponse_3 VARCHAR(30) NOT NULL,
	reponse_4 VARCHAR(30) NOT NULL,
	id_prop INTEGER REFERENCES Proposition(id_prop) NOT NULL UNIQUE
);

CREATE TABLE Proposition_ON(
	id_prop_on SERIAL PRIMARY KEY UNIQUE NOT NULL,
	reponse BOOLEAN NOT NULL,
	id_prop INTEGER REFERENCES Proposition(id_prop) NOT NULL
);

COMMIT WORK;
