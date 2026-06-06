<?php
session_start();
require __DIR__ . '/composants/fonctions.php';
require __DIR__ . '/config/connexion.php';

enregistrer_visite($pdo);

$mot_cle = nettoyer($_GET['q'] ?? '');
$resultats = array();

if ($mot_cle !== '') {
    $stmt = $pdo->prepare("SELECT * FROM projets WHERE titre LIKE ? OR description LIKE ? OR technologies LIKE ?");
    $stmt->execute(array('%' . $mot_cle . '%', '%' . $mot_cle . '%', '%' . $mot_cle . '%'));
} else {
    $stmt = $pdo->query("SELECT * FROM projets ORDER BY id DESC");
}
$resultats = $stmt->fetchAll();

$erreurs_demande = array();
$succes_demande = false;
$d_nom = $d_email = $d_type = $d_description = $d_budget = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verifier_csrf($_POST['csrf_token'] ?? '')) {
        die("Request invalide.");
    } 
        $d_nom = nettoyer($_POST['nom'] ?? '');
        $d_email = nettoyer($_POST['email'] ?? '');
        $d_type = nettoyer($_POST['type_projet'] ?? '');
        $d_description = nettoyer($_POST['description'] ?? '');
        $d_budget = nettoyer($_POST['budget'] ?? '');
        if (!champ_requis($d_nom)) {
            $erreurs_demande[] = "Le nom est requis.";
        }
        if (!champ_requis($d_email) || !filter_var($d_email, FILTER_VALIDATE_EMAIL)) {
            $erreurs_demande[] = "Un email valide est requis.";
        }
        if (!champ_requis($d_type)) {
            $erreurs_demande[] = "Le type de projet est requis.";
        }
        if (!champ_requis($d_description)) {
            $erreurs_demande[] = "La description est requise.";
        }
        if (!champ_requis($d_budget)) {
            $erreurs_demande[] = "Le budget est requis.";
        }
        if (empty($erreurs_demande)) {
            $stmt = $pdo->prepare("INSERT INTO demandes_projet (nom, email, type_projet, description, budget) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$d_nom, $d_email, $d_type, $d_description, $d_budget]);
            $succes_demande = true;

            $recap_nom = $d_nom;
            $recap_email = $d_email;
            $recap_type = $d_type;
            $recap_description = $d_description;
            $recap_budget = $d_budget;

            $d_nom = $d_email = $d_type = $d_description = $d_budget = '';
        
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projets - Mayo Cassandra</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>

    <nav class="navbar">
        <?php require 'composants/navigation.php'; ?>
    </nav>

    <section id="projets" class="section">
        <h2 class="title">Mes Projets</h2>

        <form class="search-form" method="GET" action="projets.php">
            <input type="text" name="q" placeholder="Rechercher un projet..." value="<?= $mot_cle ?>">
            <button type="submit">🔍 Rechercher</button>
        </form>

        <?php if ($mot_cle !== ''): ?>
            <p>Résultats pour : <strong><?= $mot_cle ?></strong></p>
        <?php endif; ?>

        <div class="projects-grid">
            <?php if (empty($resultats)): ?>
                <p>Aucun projet trouvé.</p>
            <?php endif; ?>

            <?php foreach ($resultats as $projet): ?>
                <article class="project-card">
                    <?php if ($projet['image']): ?>
                        <img src="image/projets/<?= nettoyer($projet['image']) ?>" alt="<?= nettoyer($projet['titre']) ?>">
                    <?php endif; ?>
                    <h3><?= nettoyer($projet['titre']) ?></h3>
                    <p><?= nl2br(nettoyer($projet['description'])) ?></p>
                    <p><strong>Technologies :</strong> <?= nettoyer($projet['technologies']) ?></p>
                    <?php if ($projet['lien']): ?>
                        <a href="<?= nettoyer($projet['lien']) ?>" target="_blank" class="btn">Voir le projet</a>
                    <?php endif; ?>
                </article>
            <?php endforeach; ?>
        </div>
    </section>

    <section id="demande-projet" class="section">
        <h2 class="title">Soumettre une demande de projet</h2>

        <?php if ($succes_demande): ?>
            <div class="message-succes">
                <p>Merci <?= $recap_nom ?>, votre demande a bien été envoyée !</p>
                <p><strong>Récapitulatif :</strong></p>
                <ul>
                    <li>Email : <?= $recap_email ?></li>
                    <li>Type de projet : <?= $recap_type ?></li>
                    <li>Description : <?= $recap_description ?></li>
                    <li>Budget : <?= $recap_budget ?></li>
                </ul>
            </div>
        <?php endif; ?>

        <?php if (!empty($erreurs_demande)): ?>
            <ul class="message-erreur">
                <?php foreach ($erreurs_demande as $erreur): ?>
                    <li> <?= $erreur ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <form class="contact-form" method="POST" action="projets.php">
            <input type="hidden" name="csrf_token" value="<?= generer_csrf() ?>">
            <input type="text" name="nom" placeholder="Votre nom" value="<?= $d_nom ?>" required>
            <input type="email" name="email" placeholder="Votre email" value="<?= $d_email ?>" required>
            <input type="text" name="type_projet" placeholder="Type de projet" value="<?= $d_type ?>" required>
            <textarea name="description" placeholder="Description" required><?= $d_description ?></textarea>
            <input type="text" name="budget" placeholder="Budget estimé (CFA)" value="<?= $d_budget ?>" required>
            <button type="submit">Envoyer la demande</button>
        </form>
    </section>

    <?php require 'composants/pied-de-page.php'; ?>
</body>
</html>

      