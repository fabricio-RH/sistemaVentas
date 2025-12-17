<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Sistema de Ventas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #e9ecef; display: flex; align-items: center; justify-content: center; height: 100vh; }
        .card { width: 100%; max-width: 400px; border: none; }
        .btn-primary { background-color: #0d6efd; }
    </style>
</head>
<body>
    <div class="card shadow-lg p-4">
        <div class="card-body">
            <h3 class="text-center mb-4 fw-bold text-primary">Sistema de Ventas</h3>
            <p class="text-center text-muted mb-4">Inicia sesión para continuar</p>
            
            <?php if(session()->getFlashdata('mensaje')): ?>
                <div class="alert alert-danger text-center"><?= session()->getFlashdata('mensaje') ?></div>
            <?php endif; ?>

            <form action="<?= base_url('/auth/login') ?>" method="POST">
                <div class="mb-3">
                    <label class="form-label">Usuario</label>
                    <input type="text" class="form-control" name="usuario" required autofocus>
                </div>
                <div class="mb-3">
                    <label class="form-label">Contraseña</label>
                    <input type="password" class="form-control" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100 py-2">Ingresar</button>
            </form>
        </div>
    </div>
</body>
</html>