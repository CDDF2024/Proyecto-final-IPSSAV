<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Paciente extends Model
{
    use HasFactory;
    protected $table = 'pacientes';
    protected $primaryKey = 'id_paciente'; // Clave primaria
    protected $fillable = [
        'nombre',
        'apellido',
        'tipo_doc',
        'num_doc',
        'genero',
        'tipo_sangre',
        'fecha_nacimiento',
        'fecha_expedicion_doc',
        'telefono',
        'correo_electronico',
        'alergias',
    ];
    protected $dates = ['fecha_nacimiento', 'fecha_expedicion_doc'];
    public function muestras()
    {
        return $this->hasMany(Muestra::class, 'id_paciente');
    }
    public function esquemas()
    {
        return $this->hasMany(Esquema::class, 'id_paciente');
    }
    public function resultados()
    {
        return $this->hasMany(Resultado::class, 'id_muestra');
    }
    
}
