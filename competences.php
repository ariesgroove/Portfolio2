<!DOCTYPE html>
<html lang="fr"> <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Compétences</title>
    <link rel="stylesheet" href="./style.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
    <?php require 'composants/fonctions.php'; ?>

    <nav class="navbar">
        <?php require 'composants/navigation.php'; ?>
    </nav>
     
    <section id="Competences" class="section">
        <h2 class="title">Compétences</h2>
        <div class="Competences">
            <ul>
                <li><i class="fab fa-html5" style="color: #e34c26;"></i> <i class="fab fa-css3-alt" style="color: #264de4;"></i> HTML / CSS</li>
                <br><li><i class="fab fa-js" style="color: #f7df1e; background: #000; padding: 1px 3px; border-radius: 3px;"></i> JavaScript</li>
                <br><li><i class="fas fa-palette" style="color: #00c4cc;"></i> Design (Canva)</li>
                <br><li><i class="fas fa-database" style="color: #4db33d;"></i> Bases de données (MySQL)</li>
            </ul>
        </div>
    </section>
    
    <?php require 'composants/pied-de-page.php'; ?>
</body>
</html>