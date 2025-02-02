<?php
/**
 * @var $pdv
 */
?>
<div class="container">
    <div class="row">
        <form method="post" enctype="multipart/form-data" id="formStep">
            <div class="mb-3">
                <label for="name" class="form-label">Identifiant</label>
                <input type="text" name="name" id="name" class="form-control" value="<?php echo $pdv['name']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="id_group" class="form-label">ID_group</label>
                <input type="text" name="id_group" id="id_group" class="form-control" value="<?php echo $pdv['id_group']; ?>">
            </div>
            <div class="mb-3">
                <label for="siren" class="form-label">Siren</label>
                <input type="text" name="siren" id="siren" class="form-control" value="<?php echo $pdv['siren']; ?>" required>
            </div>
            <div class="row">
                <div class="col-11">
                    <div class="mb-3">
                        <input
                                type="text"
                                class="form-control"
                                id="search-address"
                                placeholder="Veuillez saisir une adresse pour lancer la recherche"
                        />
                    </div>
                </div>
                <div class="col-1">
                    <div class="mb-3">
                        <button
                                class="btn btn-info"
                                id="search-address-btn"
                                type="button"
                        >
                            OK
                        </button>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="rue" class="form-label">Rue</label>
                <input type="text" name="rue" id="rue" class="form-control" value="<?php echo $pdv['rue']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="code_postal" class="form-label">Code postal</label>
                <input type="text" name="code_postal" id="code_postal" class="form-control" value="<?php echo $pdv['code_postal']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="ville" class="form-label">Ville</label>
                <input type="text" name="ville" id="ville" class="form-control" value="<?php echo $pdv['ville']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="x_pos" class="form-label">X_Pos</label>
                <input type="text" name="x_pos" id="x_pos" class="form-control" value="<?php echo $pdv['x_pos']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="y_pos" class="form-label">Y_Pos</label>
                <input type="text" name="y_pos" id="y_pos" class="form-control" value="<?php echo $pdv['y_pos']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="manager" class="form-label">Manager</label>
                <input type="text" name="manager" id="manager" class="form-control" value="<?php echo $pdv['manager']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="id_hourly" class="form-label">ID_hourly</label>
                <input type="text" name="id_hourly" id="id_hourly" class="form-control" value="<?php echo $pdv['id_hourly']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Sélectionner une image</label>
                <input class="form-control" type="file" id="image" name="image">
            </div>

            <div class="mb-3 d-flex justify-content-end">
                <button
                        type="submit"
                        class="btn <?php echo isset($_GET['id']) ? 'btn-success' : 'btn-primary'; ?>"
                        name="<?php echo isset($_GET['id']) ? 'edit_button' : 'valid_button'; ?>"
                >
                    <?php echo isset($_GET['id']) ? 'Enregistrer' : 'Créer'; ?>
                </button>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Liste des adresses trouvées</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="list-group" id="address-list"></ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', () => {
        const formStep = document.querySelector('#formStep');
        const searchAddressBtn = document.querySelector('#search-address-btn');
        const searchAddressInput = document.querySelector('#search-address');
        const modalElement = document.querySelector('#modal');
        const addressList = document.querySelector('#address-list');
        const modal = new bootstrap.Modal(modalElement, { backdrop: 'static' });

        searchAddressBtn.addEventListener('click', async () => {
            const query = searchAddressInput.value.trim();

            const response = await fetch(`https://api-adresse.data.gouv.fr/search/?q=${encodeURIComponent(query)}`);
            const data = await response.json();

            addressList.innerHTML = '';
            data.features.forEach((feature) => {
                const { label, name, postcode, city, x, y } = feature.properties;
                const li = document.createElement('li');
                li.className = 'list-group-item';
                li.innerHTML = `
                <a href="#"
                   class="address-link"
                   data-name="${name}"
                   data-postcode="${postcode}"
                   data-city="${city}"
                   data-x="${feature.geometry.coordinates[1]}"
                   data-y="${feature.geometry.coordinates[0]}"
                >
                    ${label}
                </a>
            `;
                addressList.appendChild(li);
            });

            document.querySelectorAll('.address-link').forEach((link) => {
                link.addEventListener('click', (e) => {
                    e.preventDefault();

                    const { name, postcode, city, x, y } = e.target.dataset;
                    formStep.elements['rue'].value = name;
                    formStep.elements['code_postal'].value = postcode;
                    formStep.elements['ville'].value = city;
                    formStep.elements['x_pos'].value = x;
                    formStep.elements['y_pos'].value = y;
                    modal.hide();
                });
            });
            modal.show();
        });
    });

</script>