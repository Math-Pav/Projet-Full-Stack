<?php
/**
* @var $users
 * @var $currentPage
 * @var $totalPages
 */
?>
<div class="container">
    <div class="row">
        <div class="mt-2 mb-2">
            <h1 class="text-center">Liste des utilisateurs</h1>
        </div>
        <div class="mb-3 d-flex justify-content-end">
            <a href="index.php?component=user&action&create" type="button"
               class="btn btn-primary" ><i class="fa fa-plus me-2"></i>Ajouter</a>
        </div>
        <div class="row">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">
                        <a href="index.php?component=users&orderBy=id">
                            ID
                        </a>
                    </th>
                    <th scope="col">
                        <a href="index.php?component=users&orderBy=name">
                            Name
                        </a>
                    </th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($users as $user): ?>
                    <tr>
                        <td><?php echo $user['id']; ?></td>
                        <td><?php echo $user['name']; ?></td>
                        <td>
                            <?php if ($user['id'] !== $_SESSION['user_id']) : ?>
                                <a href="index.php?component=users&action=delete&id=<?php echo htmlspecialchars($user['id'], ENT_QUOTES, 'UTF-8'); ?>"
                                   onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            <?php endif; ?>

                            <a href="index.php?component=user&action=edit&id=<?php echo $user["id"] ?>">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center align-items-center">
        <div class="col-12 text-center">
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item <?= ($i === $currentPage) ? 'active' : '' ?>">
                            <a class="page-link" href="index.php?component=users&page=<?= $i ?>">
                                <?= $i ?>
                            </a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
        </div>
    </div>
</div>
