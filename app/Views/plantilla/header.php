<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Ventas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?= base_url('/inicio') ?>">🛒 Sistema Ventas</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url('/inicio') ?>">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url('/productos') ?>">Productos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url('/ventas') ?>">Registrar Venta</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url('/reportes') ?>">Reportes</a>
        </li>
      </ul>
      <span class="navbar-text text-white me-3">
        Hola, <?= session('usuario') ?>
      </span>
      <a href="<?= base_url('/logout') ?>" class="btn btn-outline-danger btn-sm">Salir</a>
    </div>
  </div>
</nav>

<div class="container mt-4">