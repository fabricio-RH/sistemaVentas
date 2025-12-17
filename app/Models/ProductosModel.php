<?php 
namespace App\Models;
use CodeIgniter\Model;

class ProductosModel extends Model {
    protected $table      = 'productos';
    protected $primaryKey = 'id';
    protected $allowedFields = ['codigo', 'nombre', 'precio_venta', 'stock'];
}