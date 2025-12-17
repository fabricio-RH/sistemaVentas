<?php 
namespace App\Controllers;
use App\Models\UsuariosModel;

class Auth extends BaseController {

    public function index() {
        // Muestra el formulario de login
        return view('login');
    }

    public function login() {
        // Recibimos datos del formulario
        $usuario = $this->request->getPost('usuario');
        $password = $this->request->getPost('password');

        $UsuarioModel = new UsuariosModel();
        $datosUsuario = $UsuarioModel->obtenerUsuario($usuario);

        // Verificamos contraseña (simple, tal como la guardamos en la BD)
        if ($datosUsuario && $datosUsuario['password'] == $password) {
            
            // Guardamos datos en la sesión del navegador
            $data = [
                "usuario" => $datosUsuario['usuario'],
                "rol"     => $datosUsuario['rol'],
                "is_logged" => true
            ];

            session()->set($data);
            return redirect()->to(base_url('/inicio'));

        } else {
            return redirect()->to(base_url('/'))->with('mensaje', 'Usuario o contraseña incorrecta');
        }
    }

    public function logout() {
        session()->destroy();
        return redirect()->to(base_url('/'));
    }
}