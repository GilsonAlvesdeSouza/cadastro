<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use LaraDev\Support\Utils;

class Cliente extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'codigo';

    protected $fillable = [
        'nome',
        'codigoCidade',
        'created_at',
        'update_at'
    ];

    public function cidade()
    {
        return $this->belongsTo(Cidade::class, 'codigoCidade', 'codigo');
    }

    public function saveCidade($nome)
    {
        $cidade = Cidade::where('codigo', $this->cidade->codigo)->first();
        $cidade->cidade = $nome;
        $cidade->save();
    }

}
