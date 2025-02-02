<?php
require_once 'vendor/autoload.php';
/**
 * @var PDO $pdo
 */

use Faker\Factory;

$faker = Factory::create('fr_FR');

$jours = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche'];

for ($i = 0; $i < 3; $i++) {
    $horaires = [];
    for ($j = 0; $j < count($jours); $j++) {
        $heureOuverture = $faker->numberBetween(10, 12) . 'H00';
        $heureFermeture = $faker->numberBetween(22, 24) . 'H00';
        $horaires[$jours[$j]] = "$heureOuverture - $heureFermeture";
    }

    $stmt = $pdo->prepare(
        "INSERT INTO hourly (lundi, mardi, mercredi, jeudi, vendredi, samedi, dimanche) 
         VALUES (:lundi, :mardi, :mercredi, :jeudi, :vendredi, :samedi, :dimanche)"
    );

    for ($j = 0; $j < count($jours); $j++) {
        $stmt->bindParam(":" . $jours[$j], $horaires[$jours[$j]]);
    }

    try {
        $stmt->execute();
        echo "Horaire ajouté pour le groupe $i : " . implode(", ", $horaires) . "\n";
    } catch (PDOException $e) {
        echo "Erreur lors de l'ajout : " . $e->getMessage() . "\n";
    }
}
