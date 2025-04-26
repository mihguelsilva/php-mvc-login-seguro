<?php ob_start(); ?>
<div class="row justify-content-center">
    <div class="col-md-6">
       <?=App\Helpers\Flash::display()?>
        <div class="card shadow rounded">
            <div class="card-body">
                <h3 class="card-title mb-4 text-center">Atualizar</h3>
                <form action="/user/edit" method="POST">
                    <?=\App\Helpers\Csrf::getTokenInput();?>
                    <div class="mb-3">
                        <label for="username" class="form-label">Nome de usuário</label>
                        <input type="text" id="username" name="username" class="form-control" value="<?= htmlspecialchars($user['username']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-control" value="<?= htmlspecialchars($user['email']); ?>" required>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3 w-100">Atualizar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
require dirname(__DIR__) . DS . 'layout.php';
?>