<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cidade extends Model
{
    protected $primaryKey = 'codigo';
    protected $fillable = [
        'cidade'
    ];

    public function cliente()
    {
       return $this->hasOne(Cliente::class, 'codigoCidade','codigo');
    }
}
