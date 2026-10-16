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










