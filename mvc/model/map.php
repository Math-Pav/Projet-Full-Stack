<?php
function getAllPosition(PDO $pdo) {
    $res = $pdo->prepare("SELECT name, rue, ville x_pos, y_pos FROM pdv WHERE x_pos IS NOT NULL AND y_pos IS NOT NULL
");
    try {
        $res->execute();
    } catch (PDOException $e) {
        return "Erreur de requete : " . $e->getMessage();
    }
    return $res->fetchAll();
}
