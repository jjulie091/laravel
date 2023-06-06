<?php

namespace App\Models\rrhh;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Persona extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable =['nombre','ap_paterno','ap_materno'];
    protected $table = 'personas';

    /*public function autos()
    {
        return $this->hasMany(Auto::class, 'persona_auto', 'persona_id', 'auto_id');
    }*/
    public function autos()
    {
        return $this->hasMany(Auto::class);
    }
}
