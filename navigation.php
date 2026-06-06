<?php $page_courante = basename($_SERVER['PHP_SELF']); ?>
<ul class="nav-links">
    <li><a href="index.php" <?php if ($page_courante === 'index.php') echo 'class="actif"'; ?>>Accueil</a></li>
    <li><a href="apropos.php" <?php if ($page_courante === 'apropos.php') echo 'class="actif"'; ?>>A propos</a></li>
    <li><a href="competences.php" <?php if ($page_courante === 'competences.php') echo 'class="actif"'; ?>>Compétences</a></li>
    <li><a href="projets.php" <?php if ($page_courante === 'projets.php') echo 'class="actif"'; ?>>Projets</a></li>
    <li><a href="contact.php" <?php if ($page_courante === 'contact.php') echo 'class="actif"'; ?>>Contact</a></li>
</ul>