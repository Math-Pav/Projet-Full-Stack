<?php

function getAllPdv(PDO $pdo,string | null $orderBy = null, int $limit = 15, int $offset = 0): array {
    $query = "SELECT * FROM pdv";

    if ($orderBy !== null) {
        $query .= " ORDER BY " . $orderBy;
    }

    $query .= " LIMIT :limit OFFSET :offset";
    $res = $pdo->prepare($query);
    $res->bindParam(':limit', $limit, PDO::PARAM_INT);
    $res->bindParam(':offset', $offset, PDO::PARAM_INT);
    try {
        $res->execute();
    } catch (PDOException $e) {
        return "Erreur de requete : {$e->getMessage()}";
    }
    return $res->fetchAll(PDO::FETCH_ASSOC);
}

function deletePdv(PDO $pdo,int $id): int {
    $res = $pdo->prepare('DELETE FROM pdv WHERE id= :id');
    $res->bindParam(':id', $id, PDO::PARAM_INT);
    try {

        $res->execute();
    } catch (PDOException $e) {
        return "Erreur de requete : {$e->getMessage()}";
    }
    return true;
}

function getTotalPdvs(PDO $pdo): int {
    $query = "SELECT COUNT(*) AS total FROM pdv";
    $res = $pdo->prepare($query);
    try {
        $res->execute();
    } catch (Exception $e) {
        return $e->getMessage();
    }
    $result = $res->fetch(PDO::FETCH_ASSOC);
    return (int)$result['total'];
}

