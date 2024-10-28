<?php

namespace App\Models;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    
    protected $table = 'usuarios'; // Nombre de la tabla
    protected $fillable = [
        'nombre',
        'apellido',
        'tipo_doc',
        'num_doc',
        'email',
        'password',
        'id_rol',
        'foto',
    ];
    public function rol()
    {
        return $this->belongsTo(Rol::class, 'id_rol', 'id_rol'); // Relación con la tabla roles
    }
    public function muestras()
    {
        return $this->hasMany(Muestra::class, 'id');
    }
    public function esquemas()
    {
        return $this->hasMany(Esquema::class, 'id_paciente');
    }
    public function facturas()
    {
        return $this->hasMany(Factura::class, 'id_usuario', 'id');
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
}
