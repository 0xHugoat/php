<?php
require_once('connexion.php');

// Récupérer les rendez-vous avec les patients
$sql = "SELECT appointments.*, patients.firstname, patients.lastname
        FROM appointments
        INNER JOIN patients
        ON appointments.patient_id = patients.id";

$request = $db->query($sql);
$appointments = $request->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des rendez-vous</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <main class="liste">
        <h1>Liste des rendez-vous</h1>
        <p>Consultez les rendez-vous de vos patients enregistrés.</p>

        <a href="ajout-rendezvous.php">+ Ajouter un rendez-vous</a>

        <?php if (empty($appointments)): ?>

            <h2>Aucun rendez-vous enregistré</h2>
            <p>Commencez par ajouter votre premier rendez-vous.</p>

        <?php else: ?>

            <section>
                <?php foreach ($appointments as $appointment): ?>

                    <article class="patient">

                        <h2>
                            <?= htmlspecialchars($appointment['firstname']) ?>
                            <?= htmlspecialchars($appointment['lastname']) ?>
                        </h2>

                        <p>
                            <strong>Date du rendez-vous :</strong>
                            <?= htmlspecialchars($appointment['datehour']) ?>
                        </p>

                        <a href="rendez-vous.php?id=<?= (int) $appointment['id'] ?>">
                            Voir le rendez-vous →
                        </a>

                    </article>

                <?php endforeach; ?>
            </section>

        <?php endif; ?>