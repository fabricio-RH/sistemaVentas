<?= view('plantilla/header') ?>

<div class="row">
    <div class="col-md-12">
        <h2 class="mb-3">💰 Nueva Venta</h2>
        
        <?php if(session()->getFlashdata('mensaje')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('mensaje') ?></div>
        <?php endif; ?>

        <form action="<?= base_url('/ventas/guardar') ?>" method="POST">
            <div class="card shadow mb-4">
                <div class="card-header bg-primary text-white">Datos de la Venta</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Cliente</label>
                            <select name="id_cliente" class="form-select" required>
                                <option value="">Seleccione un cliente...</option>
                                <?php foreach($clientes as $cli): ?>
                                    <option value="<?= $cli['id'] ?>">
                                        <?= $cli['nombre'] ?> (DNI: <?= $cli['dni_ruc'] ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <div class="col-md-6 mb-3 text-end">
                            <label class="form-label fs-4">Total a Pagar:</label>
                            <input type="text" name="total_venta" id="total_venta" class="form-control form-control-lg text-end fw-bold text-success" value="0.00" readonly>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header bg-secondary text-white">Agregar Productos</div>
                <div class="card-body">
                    <div class="row align-items-end">
                        <div class="col-md-5">
                            <label>Producto</label>
                            <select id="producto_select" class="form-select" onchange="actualizarPrecio()">
                                <option value="">Seleccione un producto...</option>
                                <?php foreach($productos as $prod): ?>
                                    <option value="<?= $prod['id'] ?>" 
                                            data-nombre="<?= $prod['nombre'] ?>"
                                            data-precio="<?= $prod['precio_venta'] ?>"
                                            data-stock="<?= $prod['stock'] ?>">
                                        <?= $prod['codigo'] ?> - <?= $prod['nombre'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label>Stock</label>
                            <input type="text" id="stock_display" class="form-control" readonly>
                        </div>
                        <div class="col-md-2">
                            <label>Precio</label>
                            <input type="text" id="precio_display" class="form-control" readonly>
                        </div>
                        <div class="col-md-2">
                            <label>Cantidad</label>
                            <input type="number" id="cantidad_input" class="form-control" min="1" value="1">
                        </div>
                        <div class="col-md-1">
                            <button type="button" class="btn btn-success w-100" onclick="agregarProducto()">
                                <i class="bi bi-plus-lg"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="tabla_ventas">
                    <thead class="table-dark">
                        <tr>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Importe</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        </tbody>
                </table>
            </div>

            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="bi bi-save"></i> Guardar Venta
                </button>
            </div>
        </form>
    </div>
</div>

<?= view('plantilla/footer') ?>

<script>
    let totalGeneral = 0;

    function actualizarPrecio() {
        // Obtenemos la opción seleccionada
        let select = document.getElementById("producto_select");
        let opcion = select.options[select.selectedIndex];

        // Llenamos los inputs de solo lectura con la data del producto
        document.getElementById("precio_display").value = opcion.dataset.precio || '';
        document.getElementById("stock_display").value = opcion.dataset.stock || '';
    }

    function agregarProducto() {
        let select = document.getElementById("producto_select");
        let opcion = select.options[select.selectedIndex];

        // Validaciones simples
        if (select.value === "") {
            alert("Seleccione un producto");
            return;
        }

        let id = select.value;
        let nombre = opcion.dataset.nombre;
        let precio = parseFloat(opcion.dataset.precio);
        let stock = parseInt(opcion.dataset.stock);
        let cantidad = parseInt(document.getElementById("cantidad_input").value);

        if (cantidad > stock) {
            alert("No hay suficiente stock. Disponibles: " + stock);
            return;
        }

        let importe = precio * cantidad;

        // Crear la fila HTML
        let fila = `
            <tr>
                <td>
                    <input type="hidden" name="id_producto[]" value="${id}">
                    ${nombre}
                </td>
                <td>
                    <input type="hidden" name="precio[]" value="${precio}">
                    ${precio.toFixed(2)}
                </td>
                <td>
                    <input type="hidden" name="cantidad[]" value="${cantidad}">
                    ${cantidad}
                </td>
                <td>
                    <input type="hidden" name="importe[]" value="${importe}">
                    ${importe.toFixed(2)}
                </td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm" onclick="eliminarFila(this, ${importe})">X</button>
                </td>
            </tr>
        `;

        // Agregar fila a la tabla
        $("#tabla_ventas tbody").append(fila);

        // Actualizar Total
        actualizarTotal(importe);

        // Limpiar campos
        select.value = "";
        document.getElementById("precio_display").value = "";
        document.getElementById("stock_display").value = "";
        document.getElementById("cantidad_input").value = "1";
    }

    function actualizarTotal(monto) {
        totalGeneral += monto;
        document.getElementById("total_venta").value = totalGeneral.toFixed(2);
    }

    function eliminarFila(boton, importe) {
        // Restar del total
        actualizarTotal(-importe);
        // Borrar la fila HTML (el padre del padre del botón)
        $(boton).closest("tr").remove();
    }
</script>