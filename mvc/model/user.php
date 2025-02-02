<?php

function update(PDO $pdo, int $id, string $name) {
    $res = $pdo->prepare("UPDATE `user` SET `name` = :name WHERE `id` = :id");
    $res->bindParam(':id', $id, PDO::PARAM_INT);
    $res->bindParam(':name', $name, PDO::PARAM_STR);
    try {
        $res->execute();
    } catch (PDOException $e) {
        return "Erreur de requete : {$e->getMessage()}";
    }
    return null;
}

function _count (PDO $pdo, int $id, string $name) {
    $res = $pdo->prepare("SELECT COUNT(*) AS user_number FROM `user` WHERE `id` <> :id AND `name` = :name");
    $res->bindParam(':id', $id, PDO::PARAM_INT);
    $res->bindParam(':name', $name, PDO::PARAM_STR);
    try {
        $res->execute();
        return $res->fetch();
    } catch (PDOException $e) {
        return "Erreur de verification du name : {$e->getMessage()}";
    }
}
function get(PDO $pdo, int $id) {
    $res = $pdo->prepare("SELECT * FROM `user` WHERE `id` = :id");
    $res->bindParam(':id', $id, PDO::PARAM_INT);
    try {
        $res->execute();
        return $res->fetch();
    } catch (PDOException $e) {
        return "Erreur de requete : {$e->getMessage()}";
    }
}

function updatePassword(PDO $pdo, int $id, string $password) {
    $res = $pdo->prepare("UPDATE `user` SET `password` = :password WHERE `id` = :id");
    $res->bindParam(':id', $id, PDO::PARAM_INT);
    $res->bindParam(':password', $password, PDO::PARAM_STR);
    try {
        $res->execute();
    } catch (PDOException $e) {
        return "Erreur de requete : {$e->getMessage()}";
    }
    return null;
}

function createUser(PDO $pdo, string $name, string $password) {
    $res = $pdo->prepare("INSERT INTO `user` (`name`, `password`) VALUES (:name, :password)");
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $res->bindParam(':name', $name, PDO::PARAM_STR);
    $res->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
    try {
        $res->execute();
    } catch (PDOException $e) {
        return "Erreur lors de la création du user : {$e->getMessage()}";
    }
    return null;
}