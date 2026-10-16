
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un patient | MediCare</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    

    <main class="container">

        <div class="page-heading">
            <span class="eyebrow">GESTION DES PATIENTS</span>
            <h1>Ajouter un patient</h1>
            <p>Renseignez les informations ci-dessous pour créer
               un nouveau dossier patient.</p>
        </div>

        <div class="form-card">

            <div class="card-header">
                <div class="card-icon">✚</div>
                <div>
                    <h2>Informations du patient</h2>
                    <p>Complétez les champs du formulaire.</p>
                </div>
            </div>

            <form action="" method="post">

                <div class="form-grid">

                    <div class="form-group">
                        <label for="lastname">Nom du patient</label>
                        <input type="text"
                               name="lastname"
                               id="lastname"
                               placeholder="Ex : Dupont">
                    </div>

                    <div class="form-group">
                        <label for="firstname">Prénom du patient</label>
                        <input type="text"
                               name="firstname"
                               id="firstname"
                               placeholder="Ex : Jean">
                    </div>

                    <div class="form-group">
                        <label for="birthdate">Date de naissance</label>
                        <input type="date"
                               name="birthdate"
                               id="birthdate"
                               required>
                    </div>

                    <div class="form-group">
                        <label for="phone">Numéro de téléphone</label>
                        <input type="number"
                               name="phone"
                               id="phone"
                               placeholder="Ex : 0612345678">
                    </div>

                    <div class="form-group full-width">
                        <label for="mail">Adresse e-mail</label>
                        <input type="email"
                               name="mail"
                               id="mail"
                               placeholder="Ex : jean.dupont@email.com">
                    </div>

                </div>

                <div class="form-footer">

                    <input type="submit"
                           value="+ Créer le patient">
                </div>

            </form>

        </div>

        <a href="liste-patients.php" class="patients-link">
            ← Voir la liste des patients
        </a>

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

    if ($resultat) {
        echo "Donnée insérée avec succès !";
    } else {
        echo "Erreur lors de l'insertion.";
    }
}

?>

<a href="liste-patients.php">Liste de patients</a>