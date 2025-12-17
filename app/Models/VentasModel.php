<?php 
namespace App\Models;
use CodeIgniter\Model;

class VentasModel extends Model {
    protected $table      = 'ventas';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_cliente', 'id_usuario', 'total'];
    protected $useTimestamps = false; // La fecha se pone sola con DEFAULT CURRENT_TIMESTAMP en BD
}