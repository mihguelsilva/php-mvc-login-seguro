<?php ob_start(); ?>

<?php if ($msg = App\Helpers\Flash::get('error')): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($msg) ?></div>
<?php endif; ?>

<form method="POST" action="/user/delete" onsubmit="return confirm('Tem certeza que deseja excluir sua conta? Esta ação é irreversível.');">
    <h2>Quer mesmo deletar sua conta?</h2>
    <a href="/home" class="btn btn-success mt-3">Voltar</a>
    <button type="submit" class="btn btn-danger mt-3">Excluir Conta</button>
</form>

<?php
$content = ob_get_clean();
include dirname(__DIR__) . DS . 'layout.php';
?>