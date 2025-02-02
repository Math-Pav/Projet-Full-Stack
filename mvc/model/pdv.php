<?php
/**
 * @var PDO $pdo
 * @var int $id
 * @return mixed|string
 */

function getPdv(PDO $pdo, int $id): array | string {
    $res = $pdo->prepare("SELECT * FROM pdv WHERE id = :id");
    $res->bindParam(":id", $id, PDO::PARAM_INT);
    try {
        $res->execute();
        return $res->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return "Erreur de requete : " . $e->getMessage();
    }
}

function updatePdv
(
    PDO $pdo,
     int $id,
     string $name,
     int $id_group,
     int $siren,
     string $rue,
     int $code_postal,
     string $ville,
     int $x_pos,
     int $y_pos,
     string $manager,
    int | null $id_hourly = 1,
    string | null $image = null
) {
    $res = $pdo->prepare("UPDATE `pdv` SET `name` = :name,`id_group` = :id_group,`siren` = :siren, `rue` = :rue, `code_postal` = :code_postal, `ville` = :ville, `x_pos` = :x_pos, `y_pos` = :y_pos, `manager` = :manager,`id_hourly` = :id_hourly, `image` = :image WHERE id = :id ");
    $res->bindParam(":id", $id, PDO::PARAM_INT);
    $res->bindParam(":name", $name, PDO::PARAM_STR);
    $res->bindParam(":id_group", $id_group, PDO::PARAM_INT);
    $res->bindParam(":siren", $siren, PDO::PARAM_STR);
    $res->bindParam(":rue", $rue, PDO::PARAM_STR);
    $res->bindParam(":code_postal", $code_postal, PDO::PARAM_STR);
    $res->bindParam(":ville", $ville, PDO::PARAM_STR);
    $res->bindParam(":x_pos", $x_pos, PDO::PARAM_INT);
    $res->bindParam(":y_pos", $y_pos, PDO::PARAM_INT);
    $res->bindParam(":manager", $manager, PDO::PARAM_STR);
    $res->bindParam(":id_hourly", $id_hourly, PDO::PARAM_INT);
    $res->bindParam(":image", $image, PDO::PARAM_STR);
    try {
        $res->execute();
    } catch (PDOException $e) {
        return "Erreur de requete : " . $e->getMessage();
    }
    return true;
}

function createPdv
(
    PDO $pdo,
    string $name,
    int $id_group,
    int $siren,
    string $rue,
    int $code_postal,
    string $ville,
    int $x_pos,
    int $y_pos,
    string $manager,
    int | null $id_hourly = 1,
    string | null $image = null
)
{
    $res = $pdo->prepare("INSERT INTO `pdv`(`name`,`id_group`,`siren`,`rue`,`code_postal`,`ville`,`x_pos`,`y_pos`,`manager`,`id_hourly`,`image`) VALUES 
    (:name, :id_group, :siren, :rue, :code_postal, :ville, :x_pos, :y_pos, :manager, :id_hourly, :image);");
    $res->bindParam(":name", $name, PDO::PARAM_STR);
    $res->bindParam(":id_group", $id_group, PDO::PARAM_INT);
    $res->bindParam(":siren", $siren, PDO::PARAM_STR);
    $res->bindParam(":rue", $rue, PDO::PARAM_STR);
    $res->bindParam(":code_postal", $code_postal, PDO::PARAM_STR);
    $res->bindParam(":ville", $ville, PDO::PARAM_STR);
    $res->bindParam(":x_pos", $x_pos, PDO::PARAM_INT);
    $res->bindParam(":y_pos", $y_pos, PDO::PARAM_INT);
    $res->bindParam(":manager", $manager, PDO::PARAM_STR);
    $res->bindParam(":id_hourly", $id_hourly, PDO::PARAM_INT);
    $res->bindParam(":image", $image, PDO::PARAM_STR);
    try {
        $res->execute();
    } catch (PDOException $e) {
        return "Erreur de requete : " . $e->getMessage();
    }
    return true;
}

function resetImage (PDO $pdo, int $id) {
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = "UPDATE `pdv` SET `image` = NULL WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    try {
        $stmt->execute();
    } catch (PDOException $e) {
        return "Erreur de requete : " . $e->getMessage();
    }
    return true;
}