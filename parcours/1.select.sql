SELECT
colonne1, colonne2, colonne3, colonne4
FROM
nom_de_la_table
WHERE
condition
;

=	"égal à"
>	"plus grand que"
<	"plus petit que"
>=	"plus grand ou égal à"
<=	"plus petit ou égal à"
<>	"différent de"
LIKE "qui ressemble à"

SELECT ville FROM météo ORDER BY ville ASC;

SELECT ville FROM météo ORDER BY ville ASC LIMIT 0,1 ;

SELECT CONCAT('ville: ', ville, ': ', bas, '/', haut ) FROM météo;

SELECT COUNT(*) FROM météo;

SELECT COUNT(*) FROM météo WHERE ville='Bruxelles';

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

SELECT ville, bas FROM Météo;

SELECT ville FROM Météo WHERE bas <> 15;

SELECT ville FROM Météo WHERE ville LIKE 'Br%';

SELECT ville FROM Météo WHERE haut<=28 AND haut>=26;



CREATE TABLE octocats
    (`promo` varchar(17), `firstname` varchar(15), `lastname` varchar(19), `gender` varchar(1), `birthdate` varchar(10), `age` int, `mail` varchar(29), `github` varchar(15))
;
    
INSERT INTO octocats
    (`promo`, `firstname`, `lastname`, `gender`, `birthdate`, `age`, `github`)
VALUES
    ('promo1-central', 'Safia', 'Bihmedn', 'F', '17/11/1990', 26, 'Safia54'),
    ('promo1-central', 'salvatore', 'saia', 'M', '20/06/1978', 38, 'salv236'),
    ('promo1-central', 'Thomas', 'Demilito', 'M', '10/03/1989', 28, 'Blutshy'),
    ('promo1-central', 'Estelle', 'Desmeurs', 'F', '28/08/1991', 25, 'EstelleDesmeurs'),
    ('promo1-central', 'geoffrey', 'marique', 'M', '09/11/1990', 26, 'creageo'),
    ('promo1-central', 'Khaled', 'Nzisabira', 'M', '26/01/1995', 22, 'THEBUNICORN'),
    ('promo1-central', 'Jimmy', 'Riguelle', 'M', '05/09/1977', 39, 'jimmyriguelle'),
    ('promo1-central', 'Daniela', 'Santos', 'F', '29/05/1984', 33, 'dnllromao'),
    ('promo1-central', 'Gabriele', 'Virga', 'M', '09/10/1994', 22, 'GabrieleVir'),
    ('promo1-central', 'Kreshnik', 'Ibërdemaj', 'M', '30/07/1985', 31, 'beThek'),
    ('promo1-central', 'Dan', 'Jansoone', 'M', '18/10/1993', 23, 'DanJsn'),
    ('promo1-central', 'Jayce Marcel', 'Kaje Banziziki', 'M', '01/03/1992', 25, 'KJayce'),
    ('promo1-central', 'Eric', 'Nsukami Zaki Mbambu', 'M', '16/05/1978', 39, 'zakysun'),
    ('promo1-central', 'David', 'Vandervaeren', 'M', '22/11/1988', 28, 'ddvdv'),
    ('promo1-central', 'Habib', 'El Maaza Gomez', 'M', '27/01/1972', 45, 'ModjoInc'),
    ('promo1-central', 'Ludovic', 'Patho', 'M', '24/06/1984', 32, 'LudovicPatho'),
    ('promo1-central', 'Santiago', 'Astete', 'M', '24/04/2017', 49, 'GitSanty'),
    ('promo1-central', 'Nadia', 'Nachit', 'F', '30/03/1982', 35, 'Nadia098'),
    ('promo1-central', 'Hugo', 'Barcelona', 'M', '31/05/1989', 27, 'kvalrie'),
    ('promo1-anderlecht', 'Miriam', 'Azzouz', 'F', '03/01/1980', 37, 'soyouz21'),
    ('promo1-anderlecht', 'Nadia', 'Benazouz', 'F', '25/08/1981', 35, 'nadiabena'),
    ('promo1-anderlecht', 'Hania', 'Doumer', 'F', '03/08/1973', 43, 'anya75'),
    ('promo1-anderlecht', 'Victor', 'Lanckriet', 'M', '09/05/1996', 21, 'lanckrietvictor'),
    ('promo1-anderlecht', 'Gary', 'Luypaert', 'M', '21/07/1989', 27, 'GaryLuypaert'),
    ('promo1-anderlecht', 'Michael', 'Mesmeaker', 'M', '07/04/1993', 24, 'Rivanos'),
    ('promo1-anderlecht', 'Japhet', 'Nkouayi', 'M', '04/04/1992', 25, 'JaphetNkouayi'),
    ('promo1-anderlecht', 'Juan Pablo', 'Quintero Torres', 'M', '25/01/1991', 26, 'Jqu1nteroT'),
    ('promo1-anderlecht', 'Thomas', 'Tonneau', 'M', '03/10/1993', 23, 'Thomas-Tonneau'),
    ('promo1-anderlecht', 'Claudy', 'Via', 'M', '29/11/1960', 56, 'ezaho'),
    ('promo1-anderlecht', 'Gilles', 'Youtou', 'M', '28/12/1978', 38, 'bbycode'),
    ('promo1-anderlecht', 'Adrian', 'Zochowski', 'M', '18/03/1996', 21, 'Zochowski'),
    ('promo1-anderlecht', 'Maria', 'Pedro Miala', 'F', '23/08/1980', 36, 'JOVITQ')
;

SELECT firstname, lastname, age FROM octocats;
SELECT * FROM octocats WHERE lastname LIKE 'N%';
SELECT firstname, lastname, birthdate FROM octocats WHERE promo='promo1-anderlecht';

SELECT firstname, lastname FROM octocats ORDER BY firstname ASC;
SELECT firstname, lastname, age FROM octocats ORDER BY age ASC;
SELECT firstname, lastname, age FROM octocats WHERE promo='promo1-central' AND age>=23 AND age<=28 ORDER BY age ASC;
SELECT firstname, lastname, age 
FROM octocats 
WHERE promo='promo1-central' 
AND age BETWEEN 23 AND 28 
ORDER BY age ASC;

SELECT firstname, lastname, age 
FROM octocats 
WHERE promo='promo1-central' 
ORDER BY age DESC
LIMIT 0,1 ;

SELECT COUNT(*) 
FROM octocats 
WHERE gender='F'
AND promo='promo1-central';

SELECT COUNT(*) 
FROM octocats 
WHERE gender='F'
AND promo='promo1-central';

SELECT COUNT(*) 
FROM octocats 
WHERE firstname='Nadia';



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

SELECT CONCAT('Demain le maxima observé en Belgique sera de: ', haut, ' degrés')
FROM Météo
ORDER BY haut DESC
LIMIT 0,1 ;


CREATE TABLE octocats
    (`promo` varchar(17), `firstname` varchar(15), `lastname` varchar(19), `gender` varchar(1), `birthdate` datetime, `age` int, `mail` varchar(29), `github` varchar(15))
;
    
INSERT INTO octocats
    (`promo`, `firstname`, `lastname`, `gender`, `birthdate`, `age`, `github`)
VALUES
    ('promo1-anderlecht', 'Victor', 'Lanckriet', 'M', '1996-05-09 00:00:00', 21, 'lanckrietvictor'),
    ('promo1-anderlecht', 'Adrian', 'Zochowski', 'M', '1996-03-18 00:00:00', 21, 'Zochowski'),
    ('promo1-central', 'Khaled', 'Nzisabira', 'M', '1995-01-26 00:00:00', 22, 'THEBUNICORN'),
    ('promo1-central', 'Gabriele', 'Virga', 'M', '1994-10-09 00:00:00', 22, 'GabrieleVir'),
    ('promo1-central', 'Dan', 'Jansoone', 'M', '1993-10-18 00:00:00', 23, 'DanJsn'),
    ('promo1-anderlecht', 'Thomas', 'Tonneau', 'M', '1993-10-03 00:00:00', 23, 'Thomas-Tonneau'),
    ('promo1-anderlecht', 'Michael', 'Mesmeaker', 'M', '1993-04-07 00:00:00', 24, 'Rivanos'),
    ('promo1-central', 'Estelle', 'Desmeurs', 'F', '1991-08-28 00:00:00', 25, 'EstelleDesmeurs'),
    ('promo1-central', 'Jayce Marcel', 'Kaje Banziziki', 'M', '1992-03-01 00:00:00', 25, 'KJayce'),
    ('promo1-anderlecht', 'Japhet', 'Nkouayi', 'M', '1992-04-04 00:00:00', 25, 'JaphetNkouayi'),
    ('promo1-central', 'Safia', 'Bihmedn', 'F', '1990-11-17 00:00:00', 26, 'Safia54'),
    ('promo1-central', 'geoffrey', 'marique', 'M', '1990-11-09 00:00:00', 26, 'creageo'),
    ('promo1-anderlecht', 'Juan Pablo', 'Quintero Torres', 'M', '1991-01-25 00:00:00', 26, 'Jqu1nteroT'),
    ('promo1-central', 'Hugo', 'Barcelona', 'M', '1989-05-31 00:00:00', 27, 'kvalrie'),
    ('promo1-anderlecht', 'Gary', 'Luypaert', 'M', '1989-07-21 00:00:00', 27, 'GaryLuypaert'),
    ('promo1-central', 'Thomas', 'Demilito', 'M', '1989-03-10 00:00:00', 28, 'Blutshy'),
    ('promo1-central', 'David', 'Vandervaeren', 'M', '1988-11-22 00:00:00', 28, 'ddvdv'),
    ('promo1-central', 'Kreshnik', 'Ibërdemaj', 'M', '1985-07-30 00:00:00', 31, 'beThek'),
    ('promo1-central', 'Ludovic', 'Patho', 'M', '1984-06-24 00:00:00', 32, 'LudovicPatho'),
    ('promo1-central', 'Daniela', 'Santos', 'F', '1984-05-29 00:00:00', 33, 'dnllromao'),
    ('promo1-central', 'Nadia', 'Nachit', 'F', '1982-03-30 00:00:00', 35, 'Nadia098'),
    ('promo1-anderlecht', 'Nadia', 'Benazouz', 'F', '1981-08-25 00:00:00', 35, 'nadiabena'),
    ('promo1-anderlecht', 'Maria', 'Pedro Miala', 'F', '1980-08-23 00:00:00', 36, 'JOVITQ'),
    ('promo1-anderlecht', 'Miriam', 'Azzouz', 'F', '1980-01-03 00:00:00', 37, 'soyouz21'),
    ('promo1-central', 'salvatore', 'saia', 'M', '1978-06-20 00:00:00', 38, 'salv236'),
    ('promo1-anderlecht', 'Gilles', 'Youtou', 'M', '1978-12-28 00:00:00', 38, 'bbycode'),
    ('promo1-central', 'Jimmy', 'Riguelle', 'M', '1977-09-05 00:00:00', 39, 'jimmyriguelle'),
    ('promo1-central', 'Eric', 'Nsukami Zaki Mbambu', 'M', '1978-05-16 00:00:00', 39, 'zakysun'),
    ('promo1-anderlecht', 'Hania', 'Doumer', 'F', '1973-08-03 00:00:00', 43, 'anya75'),
    ('promo1-central', 'Habib', 'El Maaza Gomez', 'M', '1972-01-27 00:00:00', 45, 'ModjoInc'),
    ('promo1-central', 'Santiago', 'Astete', 'M', '2017-04-24 00:00:00', 49, 'GitSanty'),
    ('promo1-anderlecht', 'Claudy', 'Via', 'M', '1960-11-29 00:00:00', 56, 'ezaho')
;



SELECT firstname, year(birthdate) FROM octocats;
