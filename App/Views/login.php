<?php ob_start(); ?>

<div class="row justify-content-center">
  <div class="col-md-6">
   <?=App\Helpers\Flash::display()?>
    <div class="card shadow rounded">
      <div class="card-body">
        <h3 class="card-title mb-4 text-center">🔐 Login</h3>

        <?php if (!empty($flash['error'])): ?>
          <div class="alert alert-danger"><?= $flash['error'] ?></div>
        <?php endif; ?>

        <form method="post" action="/login">
          <div class="mb-3">
            <label for="username" class="form-label">Usuário</label>
            <input type="text" class="form-control" name="username" required>
          </div>

          <div class="mb-3">
            <label for="password" class="form-label">Senha</label>
            <input type="password" class="form-control" name="password" required>
          </div>

          <button type="submit" class="btn btn-primary w-100">Entrar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php
$content = ob_get_clean();
require __DIR__ . DS . 'layout.php';
?>
