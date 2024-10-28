<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Muestra extends Model
{
    use HasFactory;
      // Especifica los campos que se pueden asignar masivamente
    
    protected $fillable = [
        'id_paciente',
        'aseguradora',
        'tipo_muestra',
        'fecha_resultado',
        'id_profesional',
    ];
    protected $dates = [
        'fecha_resultado', // Esto convierte automáticamente el campo a un objeto Carbon
    ];
    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'id_paciente', 'id_paciente'); // Ajusta según tu clave foránea
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_profesional', 'id'); // Ajusta según tu clave foránea
    }
    public function facturas()
    {
        return $this->hasMany(Factura::class); // Relación con el modelo Factura
    }
    public function resultados()
    {
        return $this->hasMany(Resultado::class, 'id_muestra');
    }
    public function servicios()
    {
        return $this->hasMany(Servicio::class);
    }
}
