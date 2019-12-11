DELETE from nom_de_la_table
WHERE nom_de_colonne OPERATEUR "valeur"
[and|or "nom_de_colonne" OPERATEUR "valeur"];

[ ] = optionnel



CREATE TABLE Météo
    (`ville` varchar(9), `haut` int, `bas` int)
;
    
INSERT INTO Météo
    (`ville`, `haut`, `bas`)
VALUES
    ('Bruxelles', 27, 13),
    ('Liège', 25, 15),
    ('Namur', 26, 15),
    ('Charleroi', 25, 12),
    ('Bruges', 28, 16)
;


DELETE FROM Météo
WHERE ville='Liège'
;