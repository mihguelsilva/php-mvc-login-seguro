<?php ob_start(); ?>

<div class="row justify-content-center">
    <div class="col">
        <div class="card shadow rounded">
            <div class="card-body">
                <h1>Bem-vindo à Home</h1>
                <p>Você está logado!</p>
                <p>Bem vindo, <?= htmlspecialchars($nome) ?> </p>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
require __DIR__ . '/layout.php';
?>