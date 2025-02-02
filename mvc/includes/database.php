<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=projet_full_stack",'root','0000');
} catch (Exception $e) {
    $errors[] = "Erreur de connexion à la bdd {$e->getMessage()}";
}