<?php

    // db vars
    $host = 'localhost';
    $user = 'kevin';
    $password = 'test1234';
    $dbname = 'becode';

    // set DSN (data source name)
    $dsn = 'mysql:host='.$host.';dbname='.$dbname;

    // create PDO instance
    try {
        $pdo = new PDO($dsn, $user, $password);
    } catch (Exception $e) {
        // En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
    }
