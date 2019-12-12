<?php

    // db vars
    $host = 'localhost';
    $user = 'kevin';
    $password = 'test1234';
    $dbname = 'weatherapp';

    // set DSN (data source name)
    $dsn = 'mysql:host='.$host.';dbname='.$dbname;

    // create PDO instance
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

    // get the
    $sql = 'SELECT * FROM Météo';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $cities = $stmt->fetchall(); //nb: default of FETCH_OBJ was set before

    // echo cities to the screen
    // var_dump($cities);

    function generateTable($cities)
    {
        foreach ($cities as $city) {
            // echo $city->ville.'<br/>';
            echo"
                <tr>
                    <td>{$city->ville}</td>
                    <td>{$city->bas}</td>
                    <td>{$city->haut}</td>
                </tr>
            ";
        }
    }

if (isset($_POST['submit'])) {
    // filter list to sanitize entries
    $filters = [
        'ville' => FILTER_SANITIZE_STRING,
        'haut' => FILTER_SANITIZE_NUMBER_FLOAT,
        'bas' => FILTER_SANITIZE_NUMBER_FLOAT,
    ];

    // array with sanitized vars
    $SanitizedResult = filter_input_array(INPUT_POST, $filters);

    // grab all sanitized vars
    foreach ($filters as $key => $value) {
        $SanitizedResult[$key] = trim($SanitizedResult[$key]);
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
    header('location: index.php');
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
        <title>weatherapp</title>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col s12 m6">
                    <table class="striped centered">
                        <thead>
                            <tr>
                                <th>Ville</th>
                                <th>Minimas</th>
                                <th>Maximas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php generateTable($cities); ?>
                        </tbody>
                    </table>
                </div>
                <div class="col s12 m5 offset-m1">
                    <h6 class="center-align">Ajouter une ville</h6>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                        <div class="input-field">
                            <label for="ville" class="grey-text text-darken-4">Ville</label>
                            <input type="text" name="ville" id="ville" class="validate" required value=""/>
                        </div>                        
                        <div class="input-field">
                            <label for="bas" class="grey-text text-darken-4">Minima</label>
                            <input type="text" name="bas" id="bas" class="validate" required value=""/>
                        </div>                        
                        <div class="input-field">
                            <label for="haut" class="grey-text text-darken-4">Maxima</label>
                            <input type="text" name="haut" id="haut" class="validate" required value=""/>
                        </div>
                        <div class="input-field center">
                            <button class="btn-large waves-effect waves-light" type="submit" name="submit" value="submit">Ajouter</button>
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
    </script>
    </body>
</html>