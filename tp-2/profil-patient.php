
<?php
require_once('connexion.php');


// Récupérer l'ID du patient
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id || $id <= 0) {
    exit("Identifiant du patient invalide.");
}

// Modifier les informations du patient
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $lastname = trim($_POST['lastname'] ?? '');
    $firstname = trim($_POST['firstname'] ?? '');
    $birthdate = $_POST['birthdate'] ?? '';
    $phone = trim($_POST['phone'] ?? '');
    $mail = trim($_POST['mail'] ?? '');

    if ($lastname === '' || $firstname === '' || $birthdate === '') {
        exit("Veuillez remplir les champs obligatoires.");
    }

    $sql = "UPDATE patients SET
                lastname = :lastname,
                firstname = :firstname,
                birthdate = :birthdate,
                phone = :phone,
                mail = :mail
            WHERE id = :id";

    $stmt = $db->prepare($sql);

    $stmt->execute([
        ':lastname' => $lastname,
        ':firstname' => $firstname,
        ':birthdate' => $birthdate,
        ':phone' => $phone,
        ':mail' => $mail,
        ':id' => $id
    ]);

    header("Location: profil-patient.php?id=" . $id);
    exit;
}

// Récupérer le patient
$sql = "SELECT * FROM patients WHERE id = :id";
$stmt = $db->prepare($sql);
$stmt->execute([':id' => $id]);

$patient = $stmt->fetch();
$sql = "SELECT * FROM appointments WHERE patient_id = :id";

$stmt = $db->prepare($sql);
$stmt->execute([':id' => $id]);

$appointments = $stmt->fetchAll();

if (!$patient) {
    exit("Patient introuvable.");
}

$editMode = isset($_GET['edit']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil patient</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php if ($editMode): ?>

    <main>
        <h1>Modifier le patient</h1>
        <p>Modifier les informations du patient.</p>

        <form method="post">

            <label for="firstname">Prénom</label>
            <input type="text" id="firstname" name="firstname"
                required value="<?= htmlspecialchars($patient['firstname']) ?>">

            <label for="lastname">Nom</label>
            <input type="text" id="lastname" name="lastname"
                required value="<?= htmlspecialchars($patient['lastname']) ?>">

            <label for="birthdate">Date de naissance</label>
            <input type="date" id="birthdate" name="birthdate"
                required value="<?= htmlspecialchars($patient['birthdate']) ?>">

            <label for="phone">Téléphone</label>
            <input type="tel" id="phone" name="phone"
                value="<?= htmlspecialchars($patient['phone']) ?>">

            <label for="mail">Email</label>
            <input type="email" id="mail" name="mail"
                value="<?= htmlspecialchars($patient['mail']) ?>">

            <div class="modification-patient-buttom">
                <a href="?id=<?= (int) $patient['id'] ?>">Annuler</a>
                <button type="submit">Enregistrer</button>
            </div>

        </form>
    </main>

<?php else: ?>

    <main class="profil">

        <a href="liste-patients.php">← Retour à la liste des patients</a>

        <h1>Profil du patient</h1>
        <p>Consultez les informations du patient.</p>

        <article>
            <h2>
                <?= htmlspecialchars($patient['firstname']) ?>
                <?= htmlspecialchars($patient['lastname']) ?>
            </h2>

            <p>Patient n°<?= (int) $patient['id'] ?></p>

            <h3>Informations personnelles</h3>

            <p>
                <strong>Nom :</strong>
                <?= htmlspecialchars($patient['lastname']) ?>
            </p>

            <p>
                <strong>Prénom :</strong>
                <?= htmlspecialchars($patient['firstname']) ?>
            </p>

            <p>
                <strong>Date de naissance :</strong>
                <?= htmlspecialchars($patient['birthdate']) ?>
            </p>

            <p>
                <strong>Téléphone :</strong>
                <a href="tel:<?= htmlspecialchars($patient['phone']) ?>">
                    <?= htmlspecialchars($patient['phone']) ?>
                </a>
            </p>

            <p>
                <strong>Email :</strong>
                <a href="mailto:<?= htmlspecialchars($patient['mail']) ?>">
                    <?= htmlspecialchars($patient['mail']) ?>
                </a>
            </p>

            <a href="?id=<?= (int) $patient['id'] ?>&edit=1">
                Modifier les informations
            </a>
            <h3>Rendez-vous du patient</h3>
            <?php if (empty($appointments)): ?>
                <p>Aucun rendez-vous enregistré pour ce patient.</p>
            <?php else: ?>
                <?php foreach($appointments as $appointment): ?>
                    <p>
            <strong>Date :</strong>
            <?= htmlspecialchars(
                date('d/m/Y à H:i', strtotime($appointment['datehour']))
            ) ?>
        </p>

        <a href="rendez-vous.php?id=<?= (int) $appointment['id'] ?>">
            Voir le rendez-vous →
        </a>

    <?php endforeach; ?>

<?php endif; ?>
        </article>

    </main>

<?php endif; ?>

</body>
</html>
