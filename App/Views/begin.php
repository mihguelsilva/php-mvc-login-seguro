<?php ob_start(); ?>

<div class="container py-5">
    <div class="text-center mb-5">
      <h1 class="display-4 fw-bold text-primary">🚀 Sistema de Gerenciamento</h1>
      <p class="lead text-muted">Aplicação construída em PHP com arquitetura MVC e autenticação segura.</p>
      <a href="/login" class="btn btn-primary btn-lg mt-3">🔐 Acessar Sistema</a>
    </div>

    <!-- Carrossel de Destaques -->
    <div id="featuresCarousel" class="carousel slide mb-5" data-bs-ride="carousel">
      <div class="carousel-inner rounded-4 shadow">
        <div class="carousel-item active bg-white p-5 text-center">
          <i class="bi bi-person-check fs-1 text-primary"></i>
          <h3 class="mt-3">Login Seguro</h3>
          <p>Autenticação com controle de sessões e permissões de acesso (admin/user).</p>
        </div>
        <div class="carousel-item bg-white p-5 text-center">
          <i class="bi bi-gear-wide-connected fs-1 text-success"></i>
          <h3 class="mt-3">Arquitetura MVC</h3>
          <p>Separação clara entre Model, View e Controller para facilitar manutenção e escalabilidade.</p>
        </div>
        <div class="carousel-item bg-white p-5 text-center">
          <i class="bi bi-database-check fs-1 text-danger"></i>
          <h3 class="mt-3">CRUD Completo</h3>
          <p>Gerencie usuários de forma eficiente com criação, leitura, atualização e remoção de dados.</p>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#featuresCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon bg-dark rounded-circle p-2" aria-hidden="true"></span>
        <span class="visually-hidden">Anterior</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#featuresCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon bg-dark rounded-circle p-2" aria-hidden="true"></span>
        <span class="visually-hidden">Próximo</span>
      </button>
    </div>

    <!-- Tecnologias -->
    <div class="text-center">
      <h4 class="fw-bold mb-3">🧰 Tecnologias Utilizadas</h4>
      <div class="d-flex flex-wrap justify-content-center gap-4">
        <span class="badge bg-primary fs-6">PHP 8+</span>
        <span class="badge bg-success fs-6">MySQL/MariaDB</span>
        <span class="badge bg-secondary fs-6">Bootstrap 5</span>
        <span class="badge bg-info text-dark fs-6">MVC</span>
        <span class="badge bg-dark fs-6">Composer / PSR-4</span>
        <span class="badge bg-danger fs-6">Autenticação com Sessions</span>
      </div>
    </div>

<?php
$content = ob_get_clean();
include __DIR__ . DS . 'layout.php';
?>