<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resultado extends Model
{
    use HasFactory;
    protected $table = 'resultados';
    protected $fillable = [
        'id_paciente',
        'id_muestra',
        'resultado',
        'fecha_resultado',
        'interpretacion',
    ];

    public function pacientes()
    {
        return $this->belongsTo(Paciente::class, 'id_paciente');
    }

    public function muestras()
    {
        return $this->belongsTo(Muestra::class, 'id_muestra');
    }
}
