<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    protected $table = 'clientes';
    protected $fillable = [
        'nombre',
        'num_doc',
        'apellido', 
        'razon_social', 
        'correo_electronico', 
        'telefono', 
        'direccion', 
        'ciudad', 
        'departamento'
    ];
    public function facturas()
    {
        return $this->hasMany(Factura::class, 'id_cliente'); // Definir la relación con Factura
    }
}
