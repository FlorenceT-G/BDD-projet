CREATE TABLE personne
(
    pseudo VARCHAR(30) PRIMARY KEY NOT NULL,
    mail VARCHAR(255) NOT NULL,
    naissance DATE NOT NULL,
    inscription DATE NOT NULL,
    nom VARCHAR(30) NOT NULL,
    prenom VARCHAR(30) NOT NULL,
    residence VARCHAR(255) NOT NULL
);

CREATE TABLE recensement
(
    pseudo VARCHAR(30) NOT NULL,
    nomverna VARCHAR(100) NOT NULL,
    _date DATE NOT NULL,
    lieu VARCHAR(255) NOT NULL,
	FOREIGN KEY (pseudo) REFERENCES personne(pseudo),
	FOREIGN KEY (nomverna) REFERENCES especes(nomverna)
);

CREATE TABLE especes
(
	nomverna VARCHAR(100) PRIMARY KEY NOT NULL,
	nomscien VARCHAR(100) NOT NULL,
	classe VARCHAR(30) NOT NULL,
	nuisance_ssp TINYINT(1) NOT NULL,
	nuisance_ff TINYINT(1) NOT NULL,
	nuisance_agri TINYINT(1) NOT NULL,
	nuisance_a TINYINT(1) NOT NULL
);

CREATE TABLE provoque
(
	nomverna VARCHAR(100) NOT NULL,
	nom_maladie VARCHAR(100) NOT NULL,
	FOREIGN KEY(nomverna) REFERENCES especes(nomverna),
	FOREIGN KEY(nom_maladie) REFERENCES maladie(nom_maladie)
);


CREATE TABLE maladie
(
	nom_maladie VARCHAR(100) PRIMARY KEY NOT NULL;
	mortel TINYINT(1) NOT NULL,
	douleur TINYINT(1) NOT NULL,
	atteinte_neuro TINYINT(1) NOT NULL,
	atteinte_phy TINYINT(1) NOT NULL
);

ALTER TABLE espece
MODIFY nuisance_ssp TINYINT(1),
MODIFY nuisance_ff TINYINT(1),
MODIFY nuisance_agri TINYINT(1),
MODIFY nuisance_a TINYINT(1)

ALTER TABLE maladie
MODIFY mortel TINYINT(1),
MODIFY douleur TINYINT(1),
MODIFY atteinte_neuro TINYINT(1),
MODIFY atteinte_phy TINYINT(1)
