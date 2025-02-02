<div class="container">
    <div class="row">
        <form method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Identifiant</label>
                <input type="text" name="name" id="name" class="form-control" value="<?php  echo (isset($user['name'])) ? $user['name'] : ''; ?>"required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" name="password" id="password" class="form-control" <?php echo isset($_GET['id']) ? null : ''; ?>required>
            </div>
            <div class="mb-3">
                <label for="confirmation" class="form-label">Confirmation du mot de passe</label>
                <input type="password" name="confirmation" id="confirmation" class="form-control" <?php echo isset($_GET['id']) ? null : ''; ?>required>
            </div>
            <div class="mb-3 d-flex justify-content-end">
                <button
                    type="submit"
                    class="btn <?php echo isset($_GET['id']) ? 'btn-success' : 'btn-primary'; ?>"
                    name="<?php echo isset($_GET['id']) ? 'edit_button' : 'valid_button'; ?>"
                >
                    <?php  echo isset($_GET['id']) ? 'Enregistrer' : 'Créer'; ?>
                </button>
            </div>
        </form>
    </div>
</div>