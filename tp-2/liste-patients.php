
<?php
require_once('connexion.php');

$request = $db->query('SELECT * FROM patients');
$patients = $request->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des patients</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <main class="liste">
        <h1>Liste des patients</h1>
        <p>Consultez les dossiers de vos patients enregistrés.</p>

        <a href="ajout-patient.php">+ Ajouter un patient</a>

        <?php if (empty($patients)): ?>

            <h2>Aucun patient enregistré</h2>
            <p>Commencez par ajouter votre premier patient.</p>

        <?php else: ?>

            <section>
                <?php foreach ($patients as $patient): ?>

                    <article class="patient">

                        <h2>
                            <?= htmlspecialchars($patient['firstname']) ?>
                            <?= htmlspecialchars($patient['lastname']) ?>
                        </h2>

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

                        <a href="profil-patient.php?id=<?= (int) $patient['id'] ?>">
                            Voir le profil →
                        </a>

                    </article>

                <?php endforeach; ?>
            </section>

        <?php endif; ?>

    </main>

</body>
</html>
