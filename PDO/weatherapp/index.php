<?php

    // form vars
    $ville = $bas = $haut = '';

    // errors array
    $errors = ['ville' => '', 'bas' => '', 'haut' => ''];

    // regex for validation
    $regSafe = '/[\^<,\"@\/\{\}\(\)\*\$%\?=>:\|]+/i';

    // db vars
    $host = 'localhost';
    $user = 'kevin';
    $password = 'test1234';
    $dbname = 'weatherapp';

    // set DSN (data source name)
    $dsn = 'mysql:host='.$host.';dbname='.$dbname;

    // create PDO instance
    try {
        $pdo = new PDO($dsn, $user, $password);
    } catch (Exception $e) {
        // En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
    }

    // set default attri for PDO
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

    // get the db data
    $sql = 'SELECT * FROM Météo';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $cities = $stmt->fetchall(); //nb: default of FETCH_OBJ was set before

    // look for new submissions
    if (isset($_POST['submit'])) {
        // filter list to sanitize entries
        $filters = [
            'ville' => FILTER_SANITIZE_STRING,
            'haut' => FILTER_SANITIZE_NUMBER_INT,
            'bas' => FILTER_SANITIZE_NUMBER_INT,
        ];

        // array with sanitized vars
        $SanitizedResult = filter_input_array(INPUT_POST, $filters);

        // grab all sanitized vars
        foreach ($filters as $key => $value) {
            $SanitizedResult[$key] = trim($SanitizedResult[$key]);
        }

        // sanitized and valid chars and max length for ville
        if (empty($SanitizedResult['ville'])) {
            $errors['ville'] = 'Entrez une ville, s\'il vous plaît';
        } elseif (preg_match($regSafe, $SanitizedResult['ville'])) {
            $errors['ville'] = 'Utilizez uniquement des charactères valides, s\'il vous plaît';
        } elseif (strlen($_POST['ville']) > 20) {
            $errors['ville'] = 'La longeur maximale authorisée est de 20 charactères';
        }

        // sanitized and valid chars and float for bas
        if (empty($SanitizedResult['bas'])) {
            $errors['bas'] = 'Entrez un nombre entier s\'il vous plaît';
        } elseif (preg_match($regSafe, $SanitizedResult['bas'])) {
            $errors['bas'] = 'Utilizez uniquement des charactères valides, s\'il vous plaît';
        } elseif (strlen($_POST['bas']) > 5) {
            $errors['bas'] = 'La longeur maximale authorisée est de 5 charactères';
        }

        // sanitized and valid chars and float for haut
        if (empty($SanitizedResult['haut'])) {
            $errors['haut'] = 'Entrez un nombre entier s\'il vous plaît';
        } elseif (preg_match($regSafe, $SanitizedResult['haut'])) {
            $errors['haut'] = 'Utilizez uniquement des charactères valides, s\'il vous plaît';
        } elseif (strlen($_POST['haut']) > 5) {
            $errors['haut'] = 'La longeur maximale authorisée est de 5 charactères';
        }

        // redirect to reload page if no errors
        if (!array_filter($errors)) {
            header('location: index.php');
        }

        // get data from form
        $ville = $SanitizedResult['ville'];
        $haut = $SanitizedResult['haut'];
        $bas = $SanitizedResult['bas'];

        $sql = 'INSERT INTO Météo(ville, haut, bas) VALUES(:ville, :haut, :bas)';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'ville' => $ville,
            'haut' => $haut,
            'bas' => $bas,
        ]);
    }

    // look for deletions
    if (isset($_POST['remove'])) {
        $ville = $_POST['remove'];

        $sql = 'DELETE FROM Météo WHERE ville = :ville';
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['ville' => $ville]);
        header('location: index.php');
    }

    // generate tables with db data
    function generateTable($cities)
    {
        foreach ($cities as $city) {
            // echo $city->ville.'<br/>';
            echo'
            <tr>
                <td>'.$city->ville.'</td>
                <td>'.$city->bas.'</td>
                <td>'.$city->haut.'</td>
                <td>
                    <form action="index.php" method="POST">
                        <div class="">
                            <button class="btn-small red white-text darken-3 btn-flat" type="submit" name="remove" value="'.$city->ville.'">Del</button>
                        </div>
                    </form>
                </td>
            </tr>
        ';
        }
    }
?>
<!-- <td><a href="" class="btn-small red white-text darken-3 btn-flat">del</a></td> -->
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
        <title>weatherapp</title>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col s12 m6">
                    <h6 class="center-align">Table des Températures</h6>
                    <table class="striped centered">
                            </tr>
                        </thead>
                        <tbody>
                            <?php generateTable($cities); ?>
                        </tbody>
                    </table>
                </div>
                <div class="col s12 m5 offset-m1">
                    <h6 class="center-align">Ajouter une Ville</h6>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                        <div class="input-field">
                            <label for="ville" class="grey-text text-darken-4">Ville</label>
                            <input type="text" name="ville" id="ville" class="validate" required data-length="20" value="<?php echo $SanitizedResult['ville'] ?? ''; ?>"/>
                            <div class="red-text fn-error"><?php echo $errors['ville']; ?></div>
                        </div>                        
                        <div class="input-field">
                            <label for="bas" class="grey-text text-darken-4">Minima (nombre entier)</label>
                            <input type="number" name="bas" id="bas" class="validate" required data-length="5" value="<?php echo $SanitizedResult['bas'] ?? ''; ?>"/>
                            <div class="red-text fn-error"><?php echo $errors['bas']; ?></div>
                        </div>                        
                        <div class="input-field">
                            <label for="haut" class="grey-text text-darken-4">Maxima (nombre entier)</label>
                            <input type="number" name="haut" id="haut" class="validate" required data-length="5" value="<?php echo $SanitizedResult['haut'] ?? ''; ?>"/>
                            <div class="red-text fn-error"><?php echo $errors['haut']; ?></div>
                        </div>
                        <div class="input-field center">
                            <button class="btn-large waves-effect waves-light blue-grey" type="submit" name="submit" value="submit">Ajouter</button>
                        </div>
                    </form>
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
            // init char counters for fields with max length
            var textNeedCount = document.querySelectorAll('#ville, #bas, #haut');
            M.CharacterCounter.init(textNeedCount);
    </script>
    </body>
</html>