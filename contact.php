<?php
session_start();
require __DIR__ . '/composants/fonctions.php';
require __DIR__ . '/config/connexion.php';

enregistrer_visite($pdo);

$erreurs = array();
$succes = false;
$nom = $email = $message = '';
$recap_nom = ''; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    if (!verifier_csrf($_POST['csrf_token'] ?? '')) {
        die("Request invalide.");
    } 
    
    $nom = nettoyer($_POST['nom'] ?? '');
    $email = nettoyer($_POST['email'] ?? '');
    $message = nettoyer($_POST['message'] ?? '');
    
    if (!champ_requis($nom)) {
        $erreurs[] = "Le nom est requis.";
    }
    if (!champ_requis($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erreurs[] = "Un email valide est requis.";
    }
    if (!champ_requis($message)) {
        $erreurs[] = "Le message est requis.";
    }
    
    if (empty($erreurs)) {
        $stmt = $pdo->prepare("INSERT INTO messages_contact (nom, email, message) VALUES (?, ?, ?)");
        $stmt->execute([$nom, $email, $message]);
        
        $succes = true;
        $recap_nom = $nom; 
        $nom = $email = $message = ''; 
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - Mayo Cassandra</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    
    <nav class="navbar">
        <?php require 'composants/navigation.php'; ?>
    </nav>
    
    <section id="Contact" class="section">
        <h2 class="title">Contact</h2>

        <?php if ($succes): ?> 
            <p class="message-succes"> Merci <?= $recap_nom ?>, ton message a bien été envoyé !</p> 
        <?php endif; ?>

        <?php if (!empty($erreurs)): ?> 
            <ul class="message-erreur"> 
                <?php foreach ($erreurs as $erreur): ?> 
                     <li> <?= $erreur ?></li> 
                <?php endforeach; ?> 
            </ul> 
        <?php endif; ?>
        
        <form class="contact-form" method="POST" action="contact.php">
            <input type="hidden" name="csrf_token" value="<?= generer_csrf() ?>">
            <input type="text" placeholder="Entrez votre nom" name="nom" value="<?= $nom ?>" required>
            <input type="email" placeholder="Entrez votre email" name="email" value="<?= $email ?>" required>
            <textarea placeholder="Votre message" name="message" required><?= $message ?></textarea>
            <button type="submit">Envoyer</button>
        </form>
        
        <div class="contact-info">
            <p>Ou contactez-moi directement :</p>
            <p><strong>Email :</strong> mayocassandra611@gmail.com</p>
        </div>

        <div class="socials">
            <h3>Mes réseaux</h3>
            <a href="https://github.com/ariesgroove" target="_blank" class="social-link">
                💻 GitHub
            </a>
            <br> <a href="https://instagram.com/cassandrra_m" target="_blank" class="social-link"> 
            📸 Instagram
            </a>
             </a>
            <br> <a href="https://x.com/whoiscassandrra" target="_blank" class="social-link">
            🐦 Twitter / X
            </a>
        </div>
    </section>

    <?php require 'composants/pied-de-page.php'; ?>
</body>
</html>