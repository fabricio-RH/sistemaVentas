<?php 
namespace App\Models;
use CodeIgniter\Model;

class UsuariosModel extends Model {
    protected $table      = 'usuarios';
    protected $primaryKey = 'id';
    protected $allowedFields = ['usuario', 'password', 'nombre', 'rol'];
    
    
    public function obtenerUsuario($usuario) {
        return $this->where('usuario', $usuario)->first();
    }
}