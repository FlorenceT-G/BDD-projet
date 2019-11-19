INSERT INTO `personne`(pseudo, mail, naissance, inscription, nom, prenom, residence)
VALUES
(
	'martin_m',
	'martinmatin@domaine.fr',
	'1969-07-04',
	'2019-10-25',
	'Matin',
	'Martin',
	'Saint-Herblain'
);

INSERT INTO `recensement`(pseudo, nomverna, _date, lieu)
VALUES
(
	'martin_m',
	'Tique',
	'2019-10-25',
	'Lac de Grand-Lieu'
);

INSERT INTO `especes`(nomverna, nomscien, classe, nuisance_ssp, nuisance_ff, nuisance_agri, nuisance_a)
VALUES
(
	'Tique',
	'Ixodes ricinus',
	'Insectes',
	'True',
	'False',
	'False',
	'False'
);

INSERT INTO`provoque`(nom_maladie, nomverna)
VALUES
(
	'Maladie de Lyme',
	'Tique'
)

INSERT INTO `maladie`(nom_maladie, mortel, douleur, atteinte_neuro, atteinte_phy)
VALUES
(
	'Maladie de Lyme',
	'False',
	'True',
	'True',
	'True'
)
