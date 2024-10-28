<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    use HasFactory;

    protected $table = 'inventarios';

    protected $fillable = [
        'id_biologico',
        'cantidad_disponible',
        'fecha_vencimiento',
        'observaciones',
        'fecha_actualizacion',
    ];

    // Relación con el modelo Biologico
    public function biologico()
    {
        return $this->belongsTo(Biologico::class, 'id_biologico');
    }
}
