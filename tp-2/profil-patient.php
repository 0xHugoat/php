
<?php

require_once('connexion.php');

// Récupérer l'ID du patient dans l'URL
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

// Vérifier que l'ID est valide
if ($id === false || $id === null || $id <= 0) {
    exit("Identifiant du patient invalide.");
}

// Préparer la requête SQL
$sql = "SELECT * FROM patients WHERE id = :id";

$stmt = $db->prepare($sql);

// Exécuter la requête
$stmt->execute([
    ':id' => $id
]);

// Récupérer un seul patient
$patient = $stmt->fetch();

// Vérifier que le patient existe
if (!$patient) {
    exit("Patient introuvable.");
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil patient | MediCare</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>



    <main class="container">

        <a href="liste-patients.php" class="patients-link">
            ← Retour à la liste des patients
        </a>

        <div class="page-heading">
            <span class="eyebrow">DOSSIER PATIENT</span>
            <h1>Profil du patient</h1>
            <p>Consultez les informations du patient.</p>
        </div>

        <div class="form-card">

            <div class="patient-header">

                <div class="patient-avatar">
                    <?= htmlspecialchars(
                        strtoupper(
                            substr($patient['firstname'], 0, 1) .
                            substr($patient['lastname'], 0, 1)
                        )
                    ) ?>
                </div>

                <div class="patient-identity">
                    <h3>
                        <?= htmlspecialchars($patient['firstname']) ?>
                        <?= htmlspecialchars($patient['lastname']) ?>
                    </h3>

                    <span>
                        Patient n°<?= htmlspecialchars((string)$patient['id']) ?>
                    </span>
                </div>

            </div>

            <div class="profile-information">

                <div class="profile-field">
                    <label>Nom</label>
                    <p><?= htmlspecialchars($patient['lastname']) ?></p>
                </div>

                <div class="profile-field">
                    <label>Prénom</label>
                    <p><?= htmlspecialchars($patient['firstname']) ?></p>
                </div>

                <div class="profile-field">
                    <label>Date de naissance</label>
                    <p><?= htmlspecialchars($patient['birthdate']) ?></p>
                </div>

                <div class="profile-field">
                    <label>Téléphone</label>
                    <p>
                        <a href="tel:<?= htmlspecialchars($patient['phone']) ?>">
                            <?= htmlspecialchars($patient['phone']) ?>
                        </a>
                    </p>
                </div>

                <div class="profile-field">
                    <label>Adresse e-mail</label>
                    <p>
                        <a href="mailto:<?= htmlspecialchars($patient['mail']) ?>">
                            <?= htmlspecialchars($patient['mail']) ?>
                        </a>
                    </p>
                </div>

            </div>

        </div>

    </main>

</body>
</html>
