<?php
    function getUser (PDO $pdo,$name): array | bool{

        $query = 'SELECT name, password FROM user WHERE name= :name';
        $res = $pdo->prepare($query);
        $res->bindParam(':name', $name);
        try {
            $res->execute();
        } catch (Exception $e) {
            return " erreur : ".$e->getCode()." :<b> ".$e->getMessage();
        }
        return $res->fetch();
    }
