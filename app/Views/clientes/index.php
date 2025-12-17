<?= view('plantilla/header') ?>

<div class="row">
    <div class="col-md-12">
        <h2 class="mb-3">👥 Gestión de Clientes</h2>
        
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalCliente" onclick="limpiarModal()">
            <i class="bi bi-person-plus-fill"></i> Nuevo Cliente
        </button>

        <?php if(session()->getFlashdata('mensaje')): ?>
            <div class="alert alert-success alert-dismissible fade show">
                <?= session()->getFlashdata('mensaje') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <div class="card shadow">
            <div class="card-body">
                <table class="table table-striped table-hover datatable">
                    <thead class="table-dark">
                        <tr>
                            <th>Nombre</th>
                            <th>DNI / RUC</th>
                            <th>Teléfono</th>
                            <th>Dirección</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($clientes as $cli): ?>
                        <tr>
                            <td><?= $cli['nombre'] ?></td>
                            <td><?= $cli['dni_ruc'] ?></td>
                            <td><?= $cli['telefono'] ?></td>
                            <td><?= $cli['direccion'] ?></td>
                            <td>
                                <button class="btn btn-warning btn-sm" onclick="editarCliente(<?= htmlspecialchars(json_encode($cli)) ?>)">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <a href="<?= base_url('/clientes/eliminar/'.$cli['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar cliente?');">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalCliente" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="tituloModal">Nuevo Cliente</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form action="<?= base_url('/clientes/guardar') ?>" method="POST">
          <div class="modal-body">
            <input type="hidden" name="id" id="id">

            <div class="mb-3">
                <label>Nombre Completo / Razón Social</label>
                <input type="text" name="nombre" id="nombre" class="form-control" required>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>DNI / RUC</label>
                    <input type="text" name="dni_ruc" id="dni_ruc" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Teléfono</label>
                    <input type="text" name="telefono" id="telefono" class="form-control">
                </div>
            </div>
            <div class="mb-3">
                <label>Dirección</label>
                <input type="text" name="direccion" id="direccion" class="form-control">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
          </div>
      </form>
    </div>
  </div>
</div>

<?= view('plantilla/footer') ?>

<script>
    function limpiarModal() {
        document.getElementById('id').value = '';
        document.getElementById('nombre').value = '';
        document.getElementById('dni_ruc').value = '';
        document.getElementById('telefono').value = '';
        document.getElementById('direccion').value = '';
        document.getElementById('tituloModal').innerText = 'Nuevo Cliente';
    }

    function editarCliente(datos) {
        document.getElementById('id').value = datos.id;
        document.getElementById('nombre').value = datos.nombre;
        document.getElementById('dni_ruc').value = datos.dni_ruc;
        document.getElementById('telefono').value = datos.telefono;
        document.getElementById('direccion').value = datos.direccion;
        
        document.getElementById('tituloModal').innerText = 'Editar Cliente';
        var myModal = new bootstrap.Modal(document.getElementById('modalCliente'));
        myModal.show();
    }
</script>