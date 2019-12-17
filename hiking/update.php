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
        'password' => $_SESSION['pwd'],
    ]);
    $user = $stmt->fetch();

    if (empty($user)) {
        header('location: login.php');
    }

    $id = $_GET['id'];

    // get the db data
    $sql = 'SELECT * FROM hiking WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
    $hikes = $stmt->fetch(); //nb: default of FETCH_OBJ was set before

    $name = $hikes->name;
    $difficulty = $hikes->difficulty;
    $distance = $hikes->distance;
    $duration = $hikes->duration;
    $height_difference = $hikes->height_difference;

    // generate easiness selector
    $ease = ['Très_facile' => 'Très facile', 'Facile' => 'Facile', 'Moyen' => 'Moyen', 'Difficile' => 'Difficile', 'Très_difficile' => 'Très difficile'];

    function difficultySelector($ease, $difficulty)
    {
        foreach ($ease as $key => $value) {
            $selected = '';
            if (($key == $difficulty)) {
                $selected = 'selected';
            }
            echo "<option {$selected} value={$key}>{$value}</option>";
        }
    }

    // look for new submissions
    if (isset($_POST['button'])) {
        // filter list to sanitize entries
        $filters = [
            'name' => FILTER_SANITIZE_STRING,
            'difficulty' => FILTER_SANITIZE_STRING,
            'distance' => FILTER_SANITIZE_NUMBER_INT,
            'available' => FILTER_SANITIZE_NUMBER_INT,
            'duration' => FILTER_UNSAFE_RAW,
            'height_difference' => FILTER_SANITIZE_NUMBER_INT,
        ];

        // array with sanitized vars
        $SanitizedResult = filter_input_array(INPUT_POST, $filters);

        // grab all sanitized vars
        foreach ($filters as $key => $value) {
            $SanitizedResult[$key] = trim($SanitizedResult[$key]);
        }

        $name = $SanitizedResult['name'];
        $difficulty = $SanitizedResult['difficulty'];
        $distance = $SanitizedResult['distance'];
        $duration = $SanitizedResult['duration'];
        $available = $SanitizedResult['available'];
        $height_difference = $SanitizedResult['height_difference'];

        $sql = 'UPDATE hiking SET name = :name, difficulty = :difficulty, distance = :distance, duration = :duration, height_difference = :height_difference, available = :available WHERE id = :id';
        $stmt = $pdo->prepare($sql);

        if (!$stmt) {
            echo "\nPDO::errorInfo():\n";
            print_r($dbh->errorInfo());
        }

        $stmt->execute([
            'name' => $name,
            'difficulty' => $difficulty,
            'distance' => $distance,
            'duration' => $duration,
            'height_difference' => $height_difference,
            'available' => $available,
            'id' => $id,
        ]);

        echo 'Randonnée Updated'.'<br/>';
    }

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Modifier une randonnée</title>
	<link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
</head>
<body>
	<a href="/SQL-becode/hiking/read.php">Liste des données</a>
	<h1>Modifier</h1>
	<form action="" method="post">
		<div>
			<label for="name">Name</label>
			<input type="text" name="name" value="<?php echo $name ?? ''; ?>">
		</div>

		<div>
			<label for="difficulty">Difficulté</label>
			<select name="difficulty">
                <?php difficultySelector($ease, $difficulty); ?>
			</select>
		</div>
		
		<div>
			<label for="distance">Distance</label>
			<input type="text" name="distance" value="<?php echo $distance ?? ''; ?>">
		</div>
		<div>
			<label for="duration">Durée</label>
			<input type="duration" name="duration" value="<?php echo $duration ?? ''; ?>">
		</div>
		<div>
			<label for="height_difference">Dénivelé</label>
			<input type="text" name="height_difference" value="<?php echo $height_difference ?? ''; ?>">
        </div>
        <div>
            <input type="radio" id="choice1"
            name="available" value="1" checked>
            <label for="choice1">Available</label>

            <input type="radio" id="choice2"
            name="available" value="0">
            <label for="choice2">Unavailable</label>
		</div>
		<button type="submit" name="button">Envoyer</button>
	</form>
</body>
</html>
