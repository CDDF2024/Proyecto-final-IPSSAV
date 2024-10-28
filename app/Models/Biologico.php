<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biologico extends Model
{
    use HasFactory;
    protected $table = 'biologicos';
    protected $primaryKey = 'id_biologico';
    protected $fillable = [
        'nombre',
        'cantidad',
        'precio',
        'presentacion',
        'marca',
        'laboratorio',
        'fecha_registro',
        'lote',
    ];
    public function facturas()
    {
        return $this->hasMany(Factura::class); // Relación con el modelo Factura
    }
    public function esquemas()
    {
        return $this->hasMany(Esquema::class, 'id_paciente');
    }
    public function servicios()
    {
        return $this->hasMany(Servicio::class);
    }
    public function inventarios()
    {
        return $this->hasMany(Inventario::class, 'id_biologico');
    }
}
