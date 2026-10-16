EXO 1 

<?php

if (isset($_GET['lastname']) && isset($_GET['firstname'])) {
    echo $_GET['lastname'];
    echo $_GET['firstname'];
}
?>

EXO 2

<?php

if (isset($_GET['age'])) {
    echo $_GET['age'];
}else{
    echo "Le paramètre est absent";
}
?>

EXO 3

<?php

if (isset($_GET['startDate']) && isset($_GET['endDate'])) {
    echo $_GET['startDate'];
    echo $_GET['endDate'];
}
?>

EXO 4

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="user.php" method="get">
        <input type="text">
        <input type="text">
        <input type="submit" value="Submit">
    </form>
</body>
</html>

EXO 5

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="user.php" method="post">
        <input type="text">
        <input type="text">
        <input type="submit" value="Submit">
    </form>
</body>
</html>

EXO 6

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="user.php" method="get">
        <input type="text" name="prenom">
        <input type="text" name="nom">
        <input type="submit" value="Submit">
    </form>
</body>
</html>

-----------------------------------------------

<?php

if (isset($_GET['prenom']) && isset($_GET['nom'])) {
    echo $_GET['prenom'];
    echo $_GET['nom'];
}

?>


EXO 7

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="user.php" method="post">
        <input type="text" name="prenom">
        <input type="text" name="nom">
        <input type="submit" value="Submit">
    </form>
</body>
</html>

-----------------------------------------------

<?php

if (isset($_POST['prenom']) && isset($_POST['nom'])) {
    echo $_POST['prenom'];
    echo $_POST['nom'];
}

?>

EXO 8

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="index.php" method="post">
        <input type="text" name="prenom">
        <input type="text" name="nom">
        <select name="choix" id="">
            <option value="Homme">Homme</option>
            <option value="Femme">Femme</option>
        </select>
        <input type="submit" value="Submit">
    </form>
</body>
</html>

<?php

if (isset($_POST['prenom']) && isset($_POST['nom']) && isset($_POST['choix'])) {
    echo $_POST['prenom'];
    echo $_POST['nom'];
    echo $_POST['choix'];
}


?>

EXO 9

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

if (isset($_POST['prenom']) && isset($_POST['nom']) && isset($_POST['choix'])) {
    echo htmlspecialchars($_POST['prenom']) . "<br>";
    echo htmlspecialchars($_POST['nom']) . "<br>";
    echo htmlspecialchars($_POST['choix']);
}else{
    ?>
    <form action="index.php" method="post">
        <input type="text" name="prenom">
        <input type="text" name="nom">
        <select name="choix" id="">
            <option value="Homme">Homme</option>
            <option value="Femme">Femme</option>
        </select>
        <input type="submit" value="Submit">
    </form>
    <?php
}


?>
</body>
</html>

EXO 10


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="index.php" method="post">
        <label for="fichier">Choisir un fichier :</label>
        <input type="file" name="fichier" id="fichier">
        <input type="text" name="prenom">
        <input type="text" name="nom">
        <select name="choix" id="">
            <option value="Homme">Homme</option>
            <option value="Femme">Femme</option>
        </select>
        <input type="submit" value="Submit">
    </form>
    




</body>
</html>
<?php

if (isset($_POST['prenom']) && isset($_POST['nom']) && isset($_POST['choix']) && isset($_POST['choix'])) {
    echo htmlspecialchars($_POST['prenom']) . "<br>";
    echo htmlspecialchars($_POST['nom']) . "<br>";
    echo htmlspecialchars($_POST['choix']). "<br>";
    echo htmlspecialchars($_POST['fichier']);
}

?>



EXO 11

<?php

$userAgent  = htmlspecialchars($_SERVER['HTTP_USER_AGENT'] ?? 'Inconnu');
$adresseIp  = htmlspecialchars($_SERVER['REMOTE_ADDR'] ?? 'Inconnue');
$nomServeur = htmlspecialchars($_SERVER['SERVER_NAME'] ?? 'Inconnu');

?>

<main>
        <h1>Informations de connexion</h1>
        <dl>
            <dt>Votre User Agent</dt>
            <dd><?= $userAgent ?></dd>

            <dt>Votre adresse IP</dt>
            <dd><?= $adresseIp ?></dd>

            <dt>Nom du serveur</dt>
            <dd><?= $nomServeur ?></dd>
        </dl>
    </main>


EXO 12

<?php
session_start();
$_SESSION['prenom'] = "Hugo"; 
$_SESSION['nom'] = "Lamotte";
$_SESSION['age'] = 17;

?>

<a href="user.php">Lien</a>

---------------------------------

<?php
session_start();
echo $_SESSION['prenom'];
echo $_SESSION['nom'];
echo $_SESSION['age'];

?>

EXO 13

<?php
// print_r($_POST);

if (isset($_POST['email']) && isset($_POST['password'])) {
    setcookie("email", $_POST['email'], time() + 3600, "/");
    setcookie("password", $_POST['password'], time() + 3600, "/");
}


if (isset($_COOKIE['email']) && isset($_COOKIE['password'])) {
    echo "Email: " . $_COOKIE['email'];
    echo "Password: " . $_COOKIE['password']; 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="index.php" method="post">
        <input type="email" name="email" id="">
        <input type="password" name="password" id="">
        <input type="submit" value="Submit">
    </form>
</body>
</html>
