<?php 
namespace App\Models;
use CodeIgniter\Model;

class ClientesModel extends Model {
    protected $table      = 'clientes';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nombre', 'dni_ruc', 'telefono', 'email', 'direccion', 'hobby'];
}