<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cassandra portfolio</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <?php require 'composants/fonctions.php'; ?>

        <nav class="navbar">
            <?php require 'composants/navigation.php'; ?>
        </nav>
        <header class="hero">
            <div class="hero-texte">
                <h1>Bonjour, je suis Mayo Cassandra</h1>
                <p>Étudiante en génie logiciel passionnée par le développement web, la cybersécurité et les bases de données.</p>
                <a href="./projets.php" class="btn">Voir mes Projets</a>
            </div>
            <div class="hero-image">
                <img src="image/profil.jpg" alt="Photo de profil">
            </div>
        </header>
         <section id="A propos" class="section">
             <h2 class="title">A propos</h2>
            <div class="A propos">
                <p>
                    Je suis étudiante en Gestion des Logiciels et Administration des Réseaux (GLAR) à l'ESTM. Ma formation couvre un large spectre de l'informatique: développement web, programmation, bases de données, cybersécurité et administration des systèmes et réseaux.
                </p>
            </div>
          </section>

          <section id="Competences" class="section">
        <h2 class="title">Competences</h2>
        <div class="Competences">
            <ul>
                <li>HTML / CSS</li>
                <li>JavaScript</li>
                <li>Design (Canva)</li>
            </ul>
        </div>
    </section>

    <section id="Mes projets" class="section">
        <h2 class="title">Mes Projets</h2>
        <div class="Mes projects">

            <div class="project-card">
                <h3>Portfolio personnel</h3>
                <p>Création d’un site web pour présenter mes compétences et projets.</p>
            </div>

            <div class="project-card">
                <h3>Business Model Canvas,Boutique en ligne</h3>
                <p>Projet de groupe : conception complète d'un Business Model Canvas pour une boutique de vêtements et parfums en ligne.</p>
            </div>

            <div class="project-card">
                <h3>Annuaire téléphonique — Langage C et MySQL</h3>
                <p> Application console développée en langage C sous CodeBlocks,connectée à une base de données MySQL. Fonctionnalités CRUD complètes : ajout, recherche, modification et suppression de contacts.</p>
            </div>

        </div>
    </section>
   
 <section id="Contact" class="section">
        <h2 class="title">Contact</h2>
        <form class="contact-form">
            <input type="text" placeholder="Entrez votre nom" required>
            <input type="email" placeholder="Entrez votre email" required>
            <textarea placeholder="Votre message" required></textarea>
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
    </div>
    </section>

    <?php require 'composants/pied-de-page.php'; ?>
</body>
</html>