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

    // look for new submissions
    if (isset($_POST['button'])) {
        // filter list to sanitize entries
        $filters = [
            'name' => FILTER_SANITIZE_STRING,
            'difficulty' => FILTER_SANITIZE_STRING,
            'distance' => FILTER_SANITIZE_NUMBER_INT,
            'available' => FILTER_UNSAFE_RAW,
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

        $sql = 'INSERT INTO `hiking`(`name`, `difficulty`, `distance`, `duration`, `height_difference`, `available`) VALUES(:name, :difficulty, :distance, :duration, :height_difference, :available)';
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
        ]);

        echo 'Randonnée Ajoutée'.'<br/>';
    }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ajouter une randonnée</title>
	<link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
</head>
<body>
	<a href="/SQL-becode/hiking/read.php">Liste des données</a>
	<h1>Ajouter</h1>
	<form action="create.php" method="post">
		<div>
			<label for="name">Name</label>
			<input type="text" name="name" value="">
		</div>

		<div>
			<label for="difficulty">Difficulté</label>
			<select name="difficulty">
				<option value="Très_facile">Très facile</option>
				<option value="Facile">Facile</option>
				<option value="Moyen">Moyen</option>
				<option value="Difficile">Difficile</option>
				<option value="Très_difficile">Très difficile</option>
			</select>
		</div>

		<div>
			<label for="distance">Distance</label>
			<input type="text" name="distance" value="">
		</div>
		<div>
			<label for="duration">Durée</label>
			<input type="time" name="duration" value="">
		</div>
		<div>
			<label for="height_difference">Dénivelé</label>
			<input type="text" name="height_difference" value="">
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
