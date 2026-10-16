
<?php
require_once('connexion.php');

// Récupérer l'ID du rendez-vous
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id || $id <= 0) {
    exit("Identifiant du rendez-vous invalide.");
}

// Modifier le rendez-vous
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $datehour = trim($_POST['datehour'] ?? '');

    if ($datehour === '') {
        exit("Veuillez renseigner une date.");
    }

    $sql = "UPDATE appointments
            SET datehour = :datehour
            WHERE id = :id";

    $stmt = $db->prepare($sql);

    $stmt->execute([
        ':datehour' => $datehour,
        ':id' => $id
    ]);

    header("Location: profil-rendezvous.php?id=" . $id);
    exit;
}

// Récupérer le rendez-vous et son patient
$sql = "SELECT appointments.*,
               patients.firstname,
               patients.lastname
        FROM appointments
        INNER JOIN patients
        ON appointments.patient_id = patients.id
        WHERE appointments.id = :id";

$stmt = $db->prepare($sql);
$stmt->execute([':id' => $id]);

$appointment = $stmt->fetch();

if (!$appointment) {
    exit("Rendez-vous introuvable.");
}

$editMode = isset($_GET['edit']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil du rendez-vous</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php if ($editMode): ?>

    <main>
        <h1>Modifier le rendez-vous</h1>
        <p>Modifier la date et l'heure du rendez-vous.</p>

        <form method="post">

            <label for="datehour">Date et heure du rendez-vous</label>

            <input
                type="datetime-local"
                id="datehour"
                name="datehour"
                required
                value="<?= htmlspecialchars(
                    date('Y-m-d\TH:i', strtotime($appointment['datehour']))
                ) ?>"
            >

            <div class="modification-patient-buttom">
                <a href="?id=<?= (int) $appointment['id'] ?>">
                    Annuler
                </a>

                <button type="submit">Enregistrer</button>
            </div>

        </form>
    </main>

<?php else: ?>

    <main class="profil">

        <a href="liste-rendezvous.php">
            ← Retour à la liste des rendez-vous
        </a>

        <h1>Rendez-vous</h1>
        <p>Consultez les informations du rendez-vous.</p>

        <article>

            <h2>
                <?= htmlspecialchars($appointment['firstname']) ?>
                <?= htmlspecialchars($appointment['lastname']) ?>
            </h2>

            <p>
                <strong>Rendez-vous n° :</strong>
                <?= (int) $appointment['id'] ?>
            </p>

            <p>
                <strong>Date et heure :</strong>
                <?= htmlspecialchars(
                    date('d/m/Y à H:i', strtotime($appointment['datehour']))
                ) ?>
            </p>

            <p>
                <strong>Patient :</strong>
                <a href="profil-patient.php?id=<?= (int) $appointment['patient_id'] ?>">
                    Voir le profil du patient
                </a>
            </p>

            <a href="?id=<?= (int) $appointment['id'] ?>&edit=1">
                Modifier le rendez-vous
            </a>
            

        </article>

    </main>

<?php endif; ?>

</body>
</html>
