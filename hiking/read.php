<?php

    require 'db.php';

    // set default attri for PDO
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

    session_start();
    // check if user is logged in
    if (!isset($_SESSION['login'], $_SESSION['pwd'])) {
        header('location: login.php');
    }

    $sql = 'SELECT * FROM user WHERE username = :username AND password <= :password';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'username' => $_SESSION['login'],
        'password' => sha1($_SESSION['pwd']),
    ]);
    $user = $stmt->fetch();

    if (empty($user)) {
        header('location: login.php');
    }

    // get the db data
    $sql = 'SELECT * FROM hiking';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $hiking = $stmt->fetchall(); //nb: default of FETCH_OBJ was set before

    // generate tables with db data
    function generateHiking($hiking)
    {
        foreach ($hiking as $hikes) {
            echo'
            <tr>
                <td><a href="update.php/?id='.$hikes->id.'">'.$hikes->name.'</a></td>
                <td>'.$hikes->difficulty.'</td>
                <td>'.$hikes->distance.' km</td>
                <td>'.$hikes->duration.'</td>
                <td>'.$hikes->height_difference.' m</td>
                <td>'.$hikes->available.'</td>
                <td>
                    <form action="read.php" method="POST">
                        <div class="">
                            <button class="btn-small red white-text darken-3 btn-flat" type="submit" name="remove" value="'.$hikes->id.'">Del</button>
                        </div>
                    </form>
                </td>
            </tr>
        ';
        }
    }

    // look for deletions
    if (isset($_POST['remove'])) {
        $id = $_POST['remove'];

        $sql = 'DELETE FROM hiking WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        header('location: read.php');
    }

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        <link rel="shortcut icon" type="image/png" href="assets/img/favicon.ico"/>
        <title>Hiking</title>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col s12 m6">
                    <h6 class="center-align">Table des Randonnées</h6>
                    <table class="striped centered">
                        <thead>
                            <tr>
                                <th>
                                    Nom de la randonnée
                                </th>
                                <th>
                                    Difficulté
                                </th>
                                <th>
                                    distance
                                </th>
                                <th>
                                    Durée
                                </th>
                                <th>
                                    Dénivelé
                                </th>
                                <th>
                                    Available
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php generateHiking($hiking); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--JavaScript at end of body for optimized loading-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        <script>
            // init materialize js stuff
            document.addEventListener("DOMContentLoaded", function() {
                M.AutoInit();
            });
    </script>
    </body>
</html>
