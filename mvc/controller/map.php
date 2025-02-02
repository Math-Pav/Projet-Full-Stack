<?php

require "model/map.php";
/**
 * @var PDO $pdo
 */

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest'
) {
    $errors = [];
    $data = [];

    if (isset($_GET['action']) && $_GET['action'] === 'get_location') {
        $locations = getAllPosition($pdo);
        if ($locations) {
            $data['location'] = $locations;
        } else {
            $errors[] = "Aucune localisation trouvée.";
        }
    }

    if (!empty($errors)) {
        header('Content-Type: application/json');
        echo json_encode(["errors" => $errors]);
        exit();
    } else {
        header('Content-Type: application/json');
        echo json_encode($data);
        exit();
    }
}

require "view/map.php";