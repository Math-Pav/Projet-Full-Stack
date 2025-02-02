<?php
require_once 'vendor/autoload.php';
/**
 * @var PDO $pdo
 */

use Faker\Factory;

$faker = Factory::create('fr_FR');

for ($i = 0; $i < 100; $i++) {
    $name = ucfirst($faker->word);
    $id_group = $faker->numberBetween(0, 10);
    $siren = str_pad($faker->randomNumber(9, true), 9, '0', STR_PAD_LEFT);
    $rue = $faker->streetName;
    $code_postal = $faker->postcode;
    $ville = $faker->city; //
    $x_pos = $faker->latitude(41.0, 51.0);
    $y_pos = $faker->longitude(-5.0, 9.0);
    $manager = $faker->name;
    $id_hourly = $faker->numberBetween(1, 3);

    $stmt = $pdo->prepare(
        "INSERT INTO pdv (name, id_group, siren, rue, code_postal, ville, x_pos, y_pos, manager, id_hourly) 
         VALUES (:name, :id_group, :siren, :rue, :code_postal, :ville, :x_pos, :y_pos, :manager, :id_hourly)"
    );

    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':id_group', $id_group);
    $stmt->bindParam(':siren', $siren);
    $stmt->bindParam(':rue', $rue);
    $stmt->bindParam(':code_postal', $code_postal);
    $stmt->bindParam(':ville', $ville);
    $stmt->bindParam(':x_pos', $x_pos);
    $stmt->bindParam(':y_pos', $y_pos);
    $stmt->bindParam(':manager', $manager);
    $stmt->bindParam(':id_hourly', $id_hourly);

    try {
        $stmt->execute();
        echo "PDV ajouté : $name, $rue, $code_postal $ville, $manager\n";
    } catch (PDOException $e) {
        echo "Erreur lors de l'ajout : " . $e->getMessage() . "\n";
    }
}

