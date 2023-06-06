<?php

namespace App\Models\rrhh;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\rrhh\Modelo;
use App\Models\rrhh\Persona;

class Auto extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'autos';
    protected $fillable = ['nombre_carro','año','persona_id','modelo_id'];
    
    public function modelo()
    {
        return $this->belongsTo(Modelo::class);
    }  

    public function personas()
    {
        return $this->belongsToMany(Persona::class, 'persona_auto', 'auto_id', 'persona_id');
    }
}
