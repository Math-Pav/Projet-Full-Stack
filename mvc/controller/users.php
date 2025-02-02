<?php
require "model/users.php";
/**
 * @var PDO $pdo
 */
if (isset($_GET['action']) && isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int) $_GET['id'];
    switch ($_GET['action']) {
        case 'delete':
            $delete = deleteUser($pdo,$id);
            if (empty($delete)) {
                $errors[] = "Impossible de supprimer un user";
            }else {
                header("Location: index.php?component=users");
            }
            exit();
        case 'edit':
            header("Location: index.php?component=user");
        default:
            break;
    }
}

$limit = 15;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$offset = ($page - 1) * $limit;

$orderBy = $_GET['orderBy'] ? cleanString($_GET['orderBy']) : null;
$users = getAllUsers($pdo, $orderBy, $limit, $offset);
$totalUsers = getTotalUsers($pdo);
$totalPages = (int)ceil($totalUsers / $limit);

require "view/users.php";
