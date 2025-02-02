<?php

require "model/login.php";
/**
 * @var PDO $pdo
 */

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest'
) {
    $errors = [];
    $name = !empty($_POST['name']) ? $_POST['name'] : NULL;
    $password = !empty($_POST['password']) ? $_POST['password'] : NULL;

    if (!empty($name) && !empty($password)) {
        $name = cleanString($name);
        $password = cleanString($password);

        $user = getUser($pdo, $name);

        $isMatchPassword = is_array($user) && password_verify($password, $user['password']);
        if ($isMatchPassword) {
            $_SESSION['auth'] = true;
            $_SESSION['user_id']= $user['id'];
            $_SESSION['user_name']= $user['name'];
            header('Content-Type: application/json');
            echo json_encode(["authentication" => true]);
            exit();
        } else {
            $errors[] = "Wrong password";
        }

    }
    if(!empty($errors)) {
        header('Content-Type: application/json');
        echo json_encode(["errors" => $errors]);
        exit();
    }
}
require "view/login.php";