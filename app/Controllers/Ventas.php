<?php 
namespace App\Controllers;
use App\Models\VentasModel;
use App\Models\DetalleVentaModel;
use App\Models\ProductosModel;
use App\Models\ClientesModel;
use App\Models\UsuariosModel;

class Ventas extends BaseController {

    public function index() {
        if (!session()->get('is_logged')) { return redirect()->to(base_url('/')); }

        // Cargamos clientes y productos para mostrarlos en los select
        $clientesModel = new ClientesModel();
        $productosModel = new ProductosModel();

        $data['clientes'] = $clientesModel->findAll();
        // Solo mostramos productos con stock mayor a 0
        $data['productos'] = $productosModel->where('stock >', 0)->findAll();
        
        return view('ventas/crear', $data);
    }

    public function guardar() {
        $ventasModel = new VentasModel();
        $detalleModel = new DetalleVentaModel();
        $productosModel = new ProductosModel();

        // 1. Guardar la Cabecera de la Venta
        $datosVenta = [
            'id_cliente' => $this->request->getPost('id_cliente'),
            'id_usuario' => 1, // Por ahora fijo, luego usaremos session()->get('id_usuario')
            'total'      => $this->request->getPost('total_venta')
        ];

        $ventasModel->insert($datosVenta);
        $idVenta = $ventasModel->getInsertID(); // Obtenemos el ID de la venta creada

        // 2. Guardar los Detalles (Productos)
        // Recibimos arrays desde el formulario
        $productos = $this->request->getPost('id_producto');
        $cantidades = $this->request->getPost('cantidad');
        $precios = $this->request->getPost('precio');
        $importes = $this->request->getPost('importe');

        if ($productos) {
            for ($i = 0; $i < count($productos); $i++) {
                $datosDetalle = [
                    'id_venta'    => $idVenta,
                    'id_producto' => $productos[$i],
                    'cantidad'    => $cantidades[$i],
                    'precio'      => $precios[$i],
                    'importe'     => $importes[$i]
                ];
                $detalleModel->insert($datosDetalle);

                // Opcional: Descontar Stock
                $productoActual = $productosModel->find($productos[$i]);
                $nuevoStock = $productoActual['stock'] - $cantidades[$i];
                $productosModel->update($productos[$i], ['stock' => $nuevoStock]);
            }
        }

        return redirect()->to(base_url('/ventas'))->with('mensaje', 'Venta registrada correctamente');
    }
}