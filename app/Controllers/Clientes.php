<?php 
namespace App\Controllers;
use App\Models\ClientesModel;

class Clientes extends BaseController {

    public function index() {
        if (!session()->get('is_logged')) { return redirect()->to(base_url('/')); }

        $clienteModel = new ClientesModel();
        $data['clientes'] = $clienteModel->findAll();
        
        return view('clientes/index', $data);
    }

    public function guardar() {
        $clienteModel = new ClientesModel();
        
        $id = $this->request->getPost('id');
        
        $datos = [
            'nombre'    => $this->request->getPost('nombre'),
            'dni_ruc'   => $this->request->getPost('dni_ruc'),
            'telefono'  => $this->request->getPost('telefono'),
            'direccion' => $this->request->getPost('direccion')
        ];

        if ($id) {
            $clienteModel->update($id, $datos);
            session()->setFlashdata('mensaje', 'Cliente actualizado correctamente');
        } else {
            $clienteModel->insert($datos);
            session()->setFlashdata('mensaje', 'Cliente registrado correctamente');
        }

        return redirect()->to(base_url('/clientes'));
    }

    public function eliminar($id) {
        $clienteModel = new ClientesModel();
        $clienteModel->delete($id);
        session()->setFlashdata('mensaje', 'Cliente eliminado');
        return redirect()->to(base_url('/clientes'));
    }
}