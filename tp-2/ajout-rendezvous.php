
<?php
require_once('connexion.php');

// Récupérer tous les patients
$request = $db->query('SELECT * FROM patients');
$patients = $request->fetchAll();

// Ajouter un rendez-vous
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $patient_id = $_POST['patient_id'] ?? '';
    $datehour = trim($_POST['datehour'] ?? '');

    if ($patient_id === '' || $datehour === '') {
        exit("Veuillez remplir les champs obligatoires.");
    }

    $patient_id = filter_var($patient_id, FILTER_VALIDATE_INT);

    if ($patient_id === false || $patient_id <= 0) {
        exit("Patient invalide.");
    }

    $sql = "INSERT INTO appointments
            (patient_id, datehour)
            VALUES
            (:patient_id, :datehour)";

    $stmt = $db->prepare($sql);

    $resultat = $stmt->execute([
        ':patient_id' => $patient_id,
        ':datehour' => $datehour
    ]);

    if ($resultat) {
        header("Location: liste-rendezvous.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un rendez-vous</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <main>
        <h1>Ajouter un rendez-vous</h1>
        <p>Renseignez les informations du rendez-vous.</p>

        <form method="post">

            <label for="patientId">Sélectionner un patient</label>
            <select name="patient_id" id="patientId" required>

                <option value="">-- Veuillez choisir un patient --</option>

                <?php foreach ($patients as $patient): ?>
                    <option value="<?= (int) $patient['id'] ?>">
                        <?= htmlspecialchars($patient['firstname'] . ' ' . $patient['lastname']) ?>
                    </option>
                <?php endforeach; ?>

            </select>

            <label for="dateRDV">Date et heure du RDV</label>
            <input
                type="datetime-local"
                id="dateRDV"
                name="datehour"
                required
            >

            <button type="submit">Valider les informations</button>

        </form>

        <a href="liste-rendezvous.php">
            ← Voir la liste des rendez-vous
        </a>
    </main>

</body>
</html>
