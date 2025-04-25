<?php ob_start(); ?>

<div class="container mt-5">
  <h2>👥 Gerenciamento de Usuários</h2>
  <table class="table table-striped mt-4">
    <thead>
      <tr>
        <th>#ID</th>
        <th>Nome</th>
        <th>Email</th>
        <th>Grupo</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($users as $user): ?>
        <tr>
          <td><?= htmlspecialchars($user['id']) ?></td>
          <td><?= htmlspecialchars($user['username']) ?></td>
          <td><?= htmlspecialchars($user['email']) ?></td>
          <td><?= htmlspecialchars($user['group']) ?></td>
          <td>
            <a href="/admin/users/edit?id=<?= $user['id'] ?>" class="btn btn-sm btn-primary">✏️ Editar</a>
            <form action="/admin/users/delete" method="POST" style="display:inline;">
              <input type="hidden" name="id" value="<?= $user['id'] ?>">
              <button type="submit" class="btn btn-sm btn-danger">🗑️ Excluir</button>
            </form>
          </td>
        </tr>
      <?php endforeach ?>
    </tbody>
  </table>
</div>

<?php
$content = ob_get_clean();
require __DIR__ . '/layout.php';
?>