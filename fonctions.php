<?php

function nettoyer($valeur) {
    return htmlspecialchars(trim($valeur));
}
function champ_requis($valeur) {
    return !empty(trim($valeur));
}
function generer_csrf() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}
function verifier_csrf($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}
function enregistrer_visite($pdo) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'];
    $page = $_SERVER['PHP_SELF'];
    $stmt = $pdo->prepare("INSERT INTO visites (adresse_ip, page) VALUES (?, ?)");
    $stmt->execute(array($ip, $page));
}