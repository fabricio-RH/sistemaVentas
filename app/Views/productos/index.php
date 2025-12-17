<?= view('plantilla/header') ?>

<div class="row">
    <div class="col-md-12">
        <h2 class="mb-3">📦 Gestión de Productos</h2>
        
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalProducto" onclick="limpiarModal()">
            <i class="bi bi-plus-lg"></i> Nuevo Producto
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
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($productos as $prod): ?>
                        <tr>
                            <td><?= $prod['codigo'] ?></td>
                            <td><?= $prod['nombre'] ?></td>
                            <td>$ <?= number_format($prod['precio_venta'], 2) ?></td>
                            <td>
                                <span class="badge <?= $prod['stock'] < 10 ? 'bg-danger' : 'bg-success' ?>">
                                    <?= $prod['stock'] ?>
                                </span>
                            </td>
                            <td>
                                <button class="btn btn-warning btn-sm" onclick="editarProducto(<?= htmlspecialchars(json_encode($prod)) ?>)">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                
                                <a href="<?= base_url('/productos/eliminar/'.$prod['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar este producto?');">
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

<div class="modal fade" id="modalProducto" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="tituloModal">Nuevo Producto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form action="<?= base_url('/productos/guardar') ?>" method="POST">
          <div class="modal-body">
            <input type="hidden" name="id" id="id">

            <div class="mb-3">
                <label>Código</label>
                <input type="text" name="codigo" id="codigo" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Nombre del Producto</label>
                <input type="text" name="nombre" id="nombre" class="form-control" required>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Precio Venta</label>
                    <input type="number" step="0.01" name="precio" id="precio" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Stock</label>
                    <input type="number" name="stock" id="stock" class="form-control" required>
                </div>
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
        document.getElementById('codigo').value = '';
        document.getElementById('nombre').value = '';
        document.getElementById('precio').value = '';
        document.getElementById('stock').value = '';
        document.getElementById('tituloModal').innerText = 'Nuevo Producto';
    }

    function editarProducto(datos) {
        // Llenamos los campos del modal con los datos del producto
        document.getElementById('id').value = datos.id;
        document.getElementById('codigo').value = datos.codigo;
        document.getElementById('nombre').value = datos.nombre;
        document.getElementById('precio').value = datos.precio_venta;
        document.getElementById('stock').value = datos.stock;
        
        // Cambiamos el título y abrimos el modal
        document.getElementById('tituloModal').innerText = 'Editar Producto';
        var myModal = new bootstrap.Modal(document.getElementById('modalProducto'));
        myModal.show();
    }
</script>