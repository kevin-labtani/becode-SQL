<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
  </head>
  <body>

    <form action="check_login.php" method="post">
      <div>
        <label for="username">Identifiant</label>
        <input type="text" name="login">
      </div>
      <div>
        <label for="password">Mot de passe </label>
        <input type="password" name="pwd">
      </div>
      <div>
        <button type="submit" name="submit">Se connecter</button>
      </div>
    </form>
  </body>
</html>
