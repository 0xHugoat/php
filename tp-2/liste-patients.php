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
    <title>Liste des patients | MediCare</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>


    <main class="container">

        <div class="page-top">
            <div class="page-heading">
                <span class="eyebrow">GESTION DES PATIENTS</span>
                <h1>Liste des patients</h1>
                <p>Consultez les dossiers de vos patients enregistrés.</p>
            </div>

            <a href="ajout-patient.php" class="add-button">
                + Ajouter un patient
            </a>
        </div>

        <?php if (empty($patients)): ?>

            <div class="empty-state">
                <div class="empty-icon">♙</div>
                <h2>Aucun patient enregistré</h2>
                <p>Commencez par ajouter votre premier patient.</p>
                <a href="ajout-patient.php" class="add-button">
                    + Ajouter un patient
                </a>
            </div>

        <?php else: ?>

            <div class="patients-grid">

                <?php foreach ($patients as $patient): ?>

                    <article class="patient">

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
                                <span>Patient</span>
                            </div>

                        </div>

                        <dl class="patient-details">

                            <div class="detail-row">
                                <dt>📅 Date de naissance</dt>
                                <dd>
                                    <?= htmlspecialchars($patient['birthdate']) ?>
                                </dd>
                            </div>

                            <div class="detail-row">
                                <dt>☎ Téléphone</dt>
                                <dd>
                                    <a href="tel:<?= htmlspecialchars($patient['phone']) ?>">
                                        <?= htmlspecialchars($patient['phone']) ?>
                                    </a>
                                </dd>
                            </div>

                            <div class="detail-row">
                                <dt>✉ Adresse e-mail</dt>
                                <dd>
                                    <a href="mailto:<?= htmlspecialchars($patient['mail']) ?>">
                                        <?= htmlspecialchars($patient['mail']) ?>
                                    </a>
                                </dd>
                            </div>

                        </dl>

                        <a href="./profil-patient.php?id=<?= $patient['id'] ?>" class="profile-button">
                            Voir le profil
                            <span>→</span>
                        </a>

                    </article>

                <?php endforeach; ?>

            </div>

        <?php endif; ?>

    </main>

</body>
</html>
