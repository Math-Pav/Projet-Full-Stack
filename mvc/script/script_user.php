<?php
require_once 'vendor/autoload.php';
/**
 * @var PDO $pdo
 */

use Faker\Factory;

$faker = Factory::create('fr_FR');

for ($i = 0; $i < 100; $i++) {
    $name = $faker->userName;
    $plainPassword = $faker->password;
    $hashedPassword = password_hash($plainPassword, PASSWORD_BCRYPT);

    $stmt = $pdo->prepare("INSERT INTO user (name, password) VALUES (:name, :password)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':password', $hashedPassword);

    try {
        $stmt->execute();
        echo "Utilisateur ajouté : $name avec mot de passe haché\n";
    } catch (PDOException $e) {
        echo "Erreur lors de l'ajout : " . $e->getMessage() . "\n";
    }
}

