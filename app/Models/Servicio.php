<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;
    protected $table = 'servicios';
    protected $fillable = [
        'tipo',
        'nombre',
        'detalles',
        'id_biologico',
        'id_muestra',
    ];

    public function biologico()
    {
        return $this->belongsTo(Biologico::class, 'id_biologico');
    }

    public function muestra()
    {
        return $this->belongsTo(Muestra::class, 'id_muestra');
    }
}
