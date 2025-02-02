<?php
require_once 'vendor/autoload.php';
/**
 * @var PDO $pdo
 */

use Faker\Factory;

$faker = Factory::create('fr_FR');

$prefixes = ['Alliance', 'Union', 'Groupement', 'Consortium', 'Réseau', 'Collectif'];
$regions = ['Nord', 'Sud', 'Est', 'Ouest', 'Central', 'National'];
$types = ['Commerçants', 'Supermarchés', 'Pharmacies', 'Garages', 'Distributeurs'];

$groupements = [];

for ($i = 0; $i < 10; $i++) {
    $name = $faker->randomElement($prefixes) . ' script_group_pdv.php' . $faker->randomElement($regions) . ' des ' . $faker->randomElement($types);
    $groupements[] = $name;

    $stmt = $pdo->prepare("INSERT INTO group_pdv (name) VALUES (:name)");
    $stmt->bindParam(':name', $name);

    try {
        $stmt->execute();
        echo "Groupement ajouté : $name\n";
    } catch (PDOException $e) {
        echo "Erreur lors de l'ajout : " . $e->getMessage() . "\n";
    }
}