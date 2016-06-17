<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sintegra extends Model
{
    protected $table = 'sintegra';

    protected $primaryKey = 'id';

    protected $fillable = ['idusuario', 'cnpj', 'resultado_json'];

    public $timestamps = false;


    public function setResultadoJsonAttribute($value)
    {
        return $this->attributes['resultado_json'] = json_encode($value);
    }

}
