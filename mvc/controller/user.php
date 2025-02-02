<?php
require "model/user.php";
/**
 * @var PDO $pdo
 */

if (isset($_POST['edit_button'])){
    $name = !empty($_POST['name']) ? $_POST['name'] : null;
    $password = !empty($_POST['password']) ? $_POST['password'] : null;
    $confirmation = !empty($_POST['confirmation']) ? $_POST['confirmation'] : null;
    $id = (int)$_GET['id'];
    if (!is_numeric($id)){
        $errors[] = "id au mauvais format";
    }

    if (!empty($name)){
        $name = cleanString($name);

        $res = _count($pdo, $id, $name);

        if ($res ['user_number'] !==0) {
            $errors[] = 'le user est déjà utilisé';
        }

        if(empty($errors)){
            $res = update($pdo, $id, $name);
            if(!empty($res)){
                $errors[] = $res;
            } else {
                header('Location: index.php?component=users');
                exit();
            }
        }

        if (!empty($password) && !empty($confirmation) && !empty($errors)){
            $password = cleanString($password);
            $confirmation = cleanString($confirmation);

            if ($confirmation !== $password){
                $errors[] = "Les mots de passe ne correspondent pas";
            } else {
                $password = password_hash($password, PASSWORD_DEFAULT);
                $res = updatePassword($pdo, $id, $password);

                header('Location: index.php?component=users');
                exit();
            }
        }
    }
}

if (isset($_GET['id'])){
    $id = (int)$_GET['id'];

    if (!is_int($id)){
        $errors[] = "id au mauvais format";
    } else {
        $user = get($pdo, $id);
        if (!is_array($user)){
            $errors[] = $user;
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['valid_button'])){
        $name = trim($_POST['name']);
        $password = trim($_POST['password']);
        if (empty($name) || empty($password)){
            $errors[]="Tous les champs sont obligatoires";
        }
        echo createUser($pdo, $name, $password);
    }
}

require "view/user.php";
