<?php ob_start(); ?>
<?=$display?>
<div class="container mt-5">
    <h2>✏️ Editar Usuário</h2>
    <form action="/admin/users/update" method="POST">
        <?=$csrf?>
        <input type="hidden" name="id" value="<?= htmlspecialchars($user['id']) ?>">

        <div class="mb-3">
            <label for="name" class="form-label">Nome:</label>
            <input type="text" name="username" id="name" class="form-control" value="<?= htmlspecialchars($user['username']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">E-mail:</label>
            <input type="email" name="email" id="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="group" class="form-label">Grupo:</label>
            <select name="group" id="group" class="form-select">
                <option value="user" <?= $user['group'] === 'user' ? 'selected' : '' ?>>Usuário</option>
                <option value="admin" <?= $user['group'] === 'admin' ? 'selected' : '' ?>>Administrador</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">💾 Salvar Alterações</button>
        <a href="/admin/users" class="btn btn-secondary">↩️ Voltar</a>
    </form>
</div>
<?php
$content = ob_get_clean();
include dirname(__DIR__) . DS . 'layout.php';
?>