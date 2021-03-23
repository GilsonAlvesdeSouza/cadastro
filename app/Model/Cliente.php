<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $primaryKey = 'codigo';
    protected $fillable = [
        'nome',
        'codigoCidade'
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
