<?php ob_start(); ?>

<div class="row justify-content-center">
  <div class="col-md-6">
   <?=App\Helpers\Flash::display()?>
    <div class="card shadow rounded">

      <div class="card-body">
        <h3 class="card-title mb-4 text-center">📝 Criar conta</h3>

        <?php if (!empty($flash['error'])): ?>
          <div class="alert alert-danger"><?= $flash['error'] ?></div>
        <?php endif; ?>

        <?php if (!empty($flash['success'])): ?>
          <div class="alert alert-success"><?= $flash['success'] ?></div>
        <?php endif; ?>

        <form method="post" action="/register">
          <?=\App\Helpers\Csrf::getTokenInput();?>

          <div class="mb-3">
            <label for="username" class="form-label">Usuário</label>
            <input type="text" class="form-control" name="username" required>
          </div>

          <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" class="form-control" name="email" required>
          </div>

          <div class="mb-3">
            <label for="password" class="form-label">Senha</label>
            <input type="password" class="form-control" name="password" required>
          </div>

          <div class="mb-3">
            <label for="confirm_password" class="form-label">Confirme a senha</label>
            <input type="password" class="form-control" name="confirm_password" required>
          </div>

          <button type="submit" class="btn btn-success w-100">Cadastrar</button>
        </form>

        <div class="text-center mt-3">
          <a href="/login" class="text-decoration-none">Já tem conta? Faça login</a>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
$content = ob_get_clean();
require __DIR__ . '/layout.php';
?>