

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un patient</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <main>
        <h1>Ajouter un patient</h1>
        <p>Renseignez les informations du patient.</p>

        <form method="post">
            <label for="firstname">Prénom</label>
            <input type="text" id="firstname" name="firstname" required>

            <label for="lastname">Nom</label>
            <input type="text" id="lastname" name="lastname" required>

            <label for="birthdate">Date de naissance</label>
            <input type="date" id="birthdate" name="birthdate" required>

            <label for="phone">Téléphone</label>
            <input type="tel" id="phone" name="phone">

            <label for="mail">Email</label>
            <input type="email" id="mail" name="mail">

            <button type="submit">Ajouter le patient</button>
        </form>

        <a href="liste-patients.php">← Voir la liste des patients</a>
    </main>

</body>
</html>


<?php

require_once('connexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $lastname = trim($_POST['lastname'] ?? '');
    $firstname = trim($_POST['firstname'] ?? '');
    $birthdate = $_POST['birthdate'] ?? '';
    $phone = trim($_POST['phone'] ?? '');
    $mail = trim($_POST['mail'] ?? '');

    if ($lastname === '' || $firstname === '' || $birthdate === '') {
        exit("Veuillez remplir les champs obligatoires.");
    }

    $sql = "INSERT INTO patients
            (lastname, firstname, birthdate, phone, mail)
            VALUES
            (:lastname, :firstname, :birthdate, :phone, :mail)";

    $stmt = $db->prepare($sql);

    $resultat = $stmt->execute([
        ':lastname' => $lastname,
        ':firstname' => $firstname,
        ':birthdate' => $birthdate,
        ':phone' => $phone,
        ':mail' => $mail
    ]);

}

?>

