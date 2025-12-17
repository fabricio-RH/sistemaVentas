<?= view('plantilla/header') ?>

<div class="row">
    <div class="col-md-12">
        <h1 class="display-5">📊 Panel de Control</h1>
        <hr>
    </div>
</div>

<div class="row mt-3">
    <div class="col-md-4">
        <div class="card text-white bg-primary mb-3 shadow">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title">Productos</h5>
                        <h2 class="fw-bold"><?= $total_productos ?></h2>
                    </div>
                    <i class="bi bi-box-seam fs-1"></i>
                </div>
                <a href="<?= base_url('/productos') ?>" class="text-white text-decoration-none small">Ver detalles &rarr;</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-success mb-3 shadow">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title">Ventas Realizadas</h5>
                        <h2 class="fw-bold"><?= $total_ventas ?></h2>
                    </div>
                    <i class="bi bi-cash-coin fs-1"></i>
                </div>
                <a href="<?= base_url('/ventas') ?>" class="text-white text-decoration-none small">Nueva venta &rarr;</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-warning mb-3 shadow">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title">Clientes</h5>
                        <h2 class="fw-bold"><?= $total_clientes ?></h2>
                    </div>
                    <i class="bi bi-people fs-1"></i>
                </div>
                <a href="<?= base_url('/clientes') ?>" class="text-white text-decoration-none small">Ver clientes &rarr;</a>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header bg-white fw-bold">
                <i class="bi bi-graph-up"></i> Ventas de los Últimos 7 Días
            </div>
            <div class="card-body">
                <canvas id="graficoVentas" height="100"></canvas>
            </div>
        </div>
    </div>
</div>

<?= view('plantilla/footer') ?>

<script>
    const ctx = document.getElementById('graficoVentas').getContext('2d');
    

    const fechas = <?= json_encode($fechas) ?>;
    const totales = <?= json_encode($totales) ?>;

    new Chart(ctx, {
        type: 'bar', 
        data: {
            labels: fechas,
            datasets: [{
                label: 'Total Vendido ($)',
                data: totales,
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script> 