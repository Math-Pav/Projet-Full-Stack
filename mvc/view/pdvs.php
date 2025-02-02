<?php
/**
* @var $pdvs
 * @var $currentPage
 * @var $totalPages
 */
?>
<div class="container">
    <div class="row">
        <div class="mt-2 mb-2">
            <h1 class="text-center">Liste des PDV</h1>
        </div>
        <div class="mb-3 d-flex justify-content-end">
            <a href="index.php?component=pdv&action=create" type="button"
               class="btn btn-primary" ><i class="fa fa-plus me-2"></i>Ajouter</a>
        </div>
        <div class="row">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">
                        <a href="index.php?component=pdvs&orderBy=id">
                            ID
                        </a>
                    </th>
                    <th scope="col">
                        <a href="index.php?component=pdvs&orderBy=name">
                            Name
                        </a>
                    </th>
                    <th scope="col">
                        <a href="index.php?component=pdvs&orderBy=id_group">
                            ID_group
                        </a>
                    </th>
                    <th scope="col">
                        <a href="index.php?component=pdvs&orderBy=siren">
                            Siren
                        </a>
                    </th>
                    <th scope="col">
                        <a href="index.php?component=pdvs&orderBy=rue">
                            Rue
                        </a>
                    </th>
                    <th scope="col">
                        <a href="index.php?component=pdvs&orderBy=code_postal">
                            Code_Postal
                        </a>
                    </th>
                    <th scope="col">
                        <a href="index.php?component=pdvs&orderBy=ville">
                            Ville
                        </a>
                    </th>
                    <th scope="col">
                        <a href="index.php?component=pdvs&orderBy=manager">
                            Manager
                        </a>
                    </th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($pdvs as $pdv): ?>
                    <tr>
                        <td><?php echo $pdv['id']; ?></td>
                        <td><?php echo $pdv['name']; ?></td>
                        <td><?php echo $pdv['id_group']; ?></td>
                        <td><?php echo $pdv['siren']; ?></td>
                        <td><?php echo $pdv['rue']; ?></td>
                        <td><?php echo $pdv['code_postal']; ?></td>
                        <td><?php echo $pdv['ville']; ?></td>
                        <td><?php echo $pdv['manager']; ?></td>
                        <td>
                            <a href="index.php?component=pdvs&action=delete&id=<?php echo htmlspecialchars($pdv['id'], ENT_QUOTES, 'UTF-8'); ?>"
                               onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                            <a href="index.php?component=pdv&action=edit&id=<?php echo $pdv['id']; ?>">
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
                            <a class="page-link" href="index.php?component=pdvs&page=<?= $i ?>">
                                <?= $i ?>
                            </a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
        </div>
    </div>
</div>