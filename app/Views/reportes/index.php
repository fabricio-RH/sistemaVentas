<?= view('plantilla/header') ?>

<div class="row">
    <div class="col-md-12 text-center">
        <h2 class="mb-4">📂 Exportar Reportes</h2>
        
        <div class="card shadow p-5">
            <p class="lead">Seleccione el formato en el que desea descargar el historial de ventas.</p>
            
            <div class="d-flex justify-content-center gap-4 mt-3">
                <a href="<?= base_url('/reportes/excel') ?>" class="btn btn-success btn-lg">
                    <i class="bi bi-file-earmark-excel"></i> Descargar Excel
                </a>

                <a href="<?= base_url('/reportes/pdf') ?>" class="btn btn-danger btn-lg">
                    <i class="bi bi-file-earmark-pdf"></i> Descargar PDF
                </a>
            </div>
        </div>
    </div>
</div>

<?= view('plantilla/footer') ?>