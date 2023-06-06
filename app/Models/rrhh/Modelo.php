<?php

namespace App\Models\rrhh;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Modelo extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'modelos';
    protected $fillable = ['nombre_modelo'];

    public function autos()
    {
        return $this->hasMany(Auto::class);
    }
}
