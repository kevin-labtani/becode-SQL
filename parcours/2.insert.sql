INSERT INTO nom_de_la_table
	(colonne1, colonne2, colonne3... dernière_colonne)
VALUES
	(value_colonne_1, value_colonne2, ... value_dernière_colonne)
;

CREATE TABLE Météo
    (`ville` varchar(9), `haut` int, `bas` int)
;
    
INSERT INTO Météo
    (`ville`, `haut`, `bas`)
VALUES
    ('Arlon', 34, 11)

;

SELECT * FROM Météo;

INSERT INTO Météo
    (ville, haut, bas)
VALUES
    ('Charleroi', 26, 20)
;
