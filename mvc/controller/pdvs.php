<?php

require "model/pdvs.php";
/**
 * @var PDO $pdo
 */

if (isset($_GET['action']) && isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int) $_GET['id'];
    switch ($_GET['action']) {
        case 'delete':
            $delete = deletePdv($pdo,$id);
            if (empty($delete)) {
                $errors[] = "Impossible de supprimer un pdv";
            }else {
                header("Location: index.php?component=pdvs");
            }
            exit();
        case 'edit':
            header("Location: pdvEdit.php?component=pdv");
        default:
            break;
    }
}
$limit = 15;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$offset = ($page - 1) * $limit;

$orderBy = isset($_GET['orderBy']) ? cleanString($_GET['orderBy']) : null;
$pdvs = getAllPdv($pdo, $orderBy, $limit, $offset);
$totalPdvs = getTotalPdvs($pdo);
$totalPages = (int)ceil($totalPdvs / $limit);

require "view/pdvs.php";
