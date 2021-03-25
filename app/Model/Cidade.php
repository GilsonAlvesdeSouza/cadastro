<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cidade extends Model
{
    use SoftDeletes;
    protected $primaryKey = 'codigo';
    protected $fillable = [
        'cidade'
    ];

    public function cliente()
    {
       return $this->hasOne(Cliente::class, 'codigoCidade','codigo');
    }
}
