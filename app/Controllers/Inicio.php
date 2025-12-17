<?php 
namespace App\Controllers;
use App\Models\ProductosModel;
use App\Models\VentasModel;
use App\Models\ClientesModel;

class Inicio extends BaseController {

    public function index() {
        if (!session()->get('is_logged')) { return redirect()->to(base_url('/')); }

        $productosModel = new ProductosModel();
        $ventasModel    = new VentasModel();
        $clientesModel  = new ClientesModel();

        // 1. Contadores para las tarjetas
        $data['total_productos'] = $productosModel->countAll();
        $data['total_clientes']  = $clientesModel->countAll();
        $data['total_ventas']    = $ventasModel->countAll();

        // 2. Datos para el Gráfico (Últimas ventas por fecha)
        // Esto es una consulta SQL simple para agrupar ventas por día
        $db = \Config\Database::connect();
        $query = $db->query("SELECT DATE(fecha) as fecha, SUM(total) as total FROM ventas GROUP BY DATE(fecha) ORDER BY fecha DESC LIMIT 7");
        $resultados = $query->getResultArray();

        $data['fechas'] = [];
        $data['totales'] = [];

        foreach($resultados as $row) {
            array_unshift($data['fechas'], $row['fecha']); // Guardamos fecha
            array_unshift($data['totales'], $row['total']); // Guardamos total
        }

        return view('inicio', $data);
    }
}