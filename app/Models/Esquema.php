<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Esquema extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_paciente',
        'id_biologico',
        'dosis_administrada',
        'fecha_administracion',
        'edad_paciente',
        'lugar_aplicacion',
        'id_usuario',
        'efectos_secundarios',
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'id_paciente');
    }

    public function biologico()
    {
        return $this->belongsTo(Biologico::class, 'id_biologico');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }
}
