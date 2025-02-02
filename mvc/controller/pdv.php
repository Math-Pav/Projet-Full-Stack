<?php

require "model/pdv.php";
/**
 * @var PDO $pdo
 */

if (isset($_POST['edit_button'])){
    $name = !empty($_POST['name']) ? $_POST['name'] : null;
    $id_group = !empty($_POST['id_group']) ? (int)$_POST['id_group'] : 1;
    $siren = !empty($_POST['siren']) ? $_POST['siren'] : null;
    $rue = !empty($_POST['rue']) ? $_POST['rue'] : null;
    $code_postal = !empty($_POST['code_postal']) ? $_POST['code_postal'] : null;
    $ville = !empty($_POST['ville']) ? $_POST['ville'] : null;
    $x_pos = !empty($_POST['x_pos']) ? $_POST['x_pos'] : null;
    $y_pos = !empty($_POST['y_pos']) ? $_POST['y_pos'] : null;
    $manager = !empty($_POST['manager']) ? $_POST['manager'] : null;
    $id_hourly = isset($_POST['id_hourly']) && $_POST['id_hourly'] !== '' ? (int)$_POST['id_hourly'] : 1;
    $image = !empty($_POST['image']) ? $_POST['image'] : null;
    $id = (int)$_GET['id'];

    if (!is_int($id)) {
        $errors[] = "id au mauvais format";
    }

    if (!is_int($id_hourly) || $id_hourly <= 0) {
        $errors[] = "L'ID horaire doit être un entier positif.";
    }

    if (!empty($image)) {
        $resetImageResult = resetImage($pdo, $id);
        if ($resetImageResult !== true) {
            $errors[] = $resetImageResult;
        }
    }

    $image = null;
    if (!empty($_FILES["image"]["tmp_name"])){
        $tmp_name = $_FILES["image"]["tmp_name"];
        $file_name = $_FILES["image"]["name"];

        $ext = pathinfo($file_name, PATHINFO_EXTENSION);
        $unique_filename = uniqid();
        $final_name = $unique_filename . "." . $ext;

        move_uploaded_file($tmp_name, $_SERVER["DOCUMENT_ROOT"] . UPLOAD_DIRECTORY . $final_name);
        $image = $final_name;
    }

    if (
        !empty($name) &&
        !empty($siren) &&
        !empty($rue) &&
        !empty($code_postal) &&
        !empty($ville) &&
        !empty($x_pos) &&
        !empty($y_pos) &&
        !empty($manager) &&
        !empty($id_hourly)

    ) {
        $name = cleanString($name);
        $siren = cleanString($siren);
        $rue = cleanString($rue);
        $code_postal = cleanString($code_postal);
        $ville = cleanString($ville);
        $x_pos = cleanString($x_pos);
        $y_pos = cleanString($y_pos);
        $manager = cleanString($manager);
        $id_hourly = cleanString($id_hourly);

        if (empty($errors)) {
            $res = updatePdv(
                $pdo,
                $id,
                $name,
                $id_group,
                $siren,
                $rue,
                $code_postal,
                $ville,
                $x_pos,
                $y_pos,
                $manager,
                $id_hourly,
                $image
            );
        }
    }
}

if(isset($_GET['id'])){
    $id = (int)$_GET['id'];

    if (!filter_var($id, FILTER_VALIDATE_INT)) {
        $errors[] = "id au mauvais format";
    }
    else {
        $pdv = getPdv($pdo, $id);
        if (!is_array($pdv)){
            $errors[] = $pdv;
        }
    }
}

if (isset($_POST['valid_button'])) {
    $name = trim($_POST['name']);
    $id_group = (int)trim($_POST['id_group']);
    $siren = trim($_POST['siren']);
    $rue = trim($_POST['rue']);
    $code_postal = trim($_POST['code_postal']);
    $ville = trim($_POST['ville']);
    $x_pos = trim($_POST['x_pos']);
    $y_pos = trim($_POST['y_pos']);
    $manager = trim($_POST['manager']);
    $id_hourly = trim($_POST['id_hourly']);
    $image = $_FILES["image"]["name"];
    if (
        empty($name) ||
        empty($siren) ||
        empty($rue) ||
        empty($code_postal) ||
        empty($ville) ||
        empty($x_pos) ||
        empty($y_pos) || 
        empty($manager) ||
        empty($id_hourly) ||
        empty($image)
        ){
        $errors[] = "Tous les champs sont obligatoires";
    }

    $image = null;
    if (!empty($_FILES["image"]["tmp_name"])){
        $tmp_name = $_FILES["image"]["tmp_name"];
        $file_name = $_FILES["image"]["name"];

        $ext = pathinfo($file_name, PATHINFO_EXTENSION);
        $unique_filename = uniqid();
        $final_name = $unique_filename . "." . $ext;

        move_uploaded_file($tmp_name, $_SERVER["DOCUMENT_ROOT"] . UPLOAD_DIRECTORY . $final_name);
        $image = $final_name;
    }

    echo createPdv
    (
        $pdo,
        $name,
        $id_group,
        $siren,
        $rue,
        $code_postal,
        $ville,
        $x_pos,
        $y_pos,
        $manager,
        $id_hourly,
        $image
    );
}

require "view/pdv.php";