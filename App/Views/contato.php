<?php ob_start(); ?>

<?=App\Helpers\Flash::display()?>

<h2>Contato</h2>
<form action="/contato/enviar" method="post">
    <div class="form-group">
        <label class="form-label" for="nome">Nome:
        <input type="text" name="nome" id="nome" class="form-control" required>
        </label>
    </div>

    <div class="form-group">
    <label class="form-label" for="email">Email:
    <input type="email" name="email" id="email" class="form-control" required>
    </label>
    </div>

    <div class="form-group">
    <label for="assunto" class="form-label">Assunto:
    <input type="text" name="assunto" id="assunto" class="form-control" required>
    </label>
    </div>

    <div class="form-group">
    <label for="mensagem" class="form-label">Mensagem:
    <textarea name="mensagem" rows="5" id="mensagem" class="form-control" required></textarea>
    </label>
    </div>

    <button class="btn btn-primary" type="submit">Enviar</button>
</form>

<?php
$content = ob_get_clean();
require_once __DIR__ . DS . 'layout.php';
?>