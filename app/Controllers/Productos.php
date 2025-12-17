<?php 
namespace App\Controllers;
use App\Models\ProductosModel;

class Productos extends BaseController {

    public function index() {
        // Verificar sesión
        if (!session()->get('is_logged')) { return redirect()->to(base_url('/')); }

        $productoModel = new ProductosModel();
        $data['productos'] = $productoModel->findAll();
        
        return view('productos/index', $data);
    }

    public function guardar() {
        $productoModel = new ProductosModel();
        
        $id = $this->request->getPost('id');
        
        $datos = [
            'codigo'       => $this->request->getPost('codigo'),
            'nombre'       => $this->request->getPost('nombre'),
            'precio_venta' => $this->request->getPost('precio'),
            'stock'        => $this->request->getPost('stock')
        ];

        if ($id) {
            // Si hay ID, es una ACTUALIZACIÓN
            $productoModel->update($id, $datos);
            session()->setFlashdata('mensaje', 'Producto actualizado correctamente');
        } else {
            // Si no hay ID, es un REGISTRO NUEVO
            $productoModel->insert($datos);
            session()->setFlashdata('mensaje', 'Producto registrado correctamente');
        }

        return redirect()->to(base_url('/productos'));
    }

    public function eliminar($id) {
        $productoModel = new ProductosModel();
        $productoModel->delete($id);
        session()->setFlashdata('mensaje', 'Producto eliminado');
        return redirect()->to(base_url('/productos'));
    }
}