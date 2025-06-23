<?php
session_start();
include_once("db.php");

$user = $_SESSION['user'] ?? null;
if (!$user || !is_array($user)) {
    die("Accès refusé : utilisateur non connecté.");
}

if ($user['role'] !== 'admin') {
    die("Accès refusé : vous n'êtes pas administrateur.");
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
    die("ID boutique invalide.");
}

$stmt = $PDO->prepare("SELECT COUNT(*) FROM stocks WHERE boutique_id = ?");
$stmt->execute([$id]);
$stockCount = (int) $stmt->fetchColumn();

if ($stockCount > 0) {
    die("Impossible de supprimer une boutique avec des stocks.");
}

$stmtDel = $PDO->prepare("DELETE FROM boutiques WHERE id = ?");
$success = $stmtDel->execute([$id]);

if ($success) {
    header("Location: supergerant.php?msg=Suppression réussie");
    exit;
} else {
    die("Erreur lors de la suppression.");
}
