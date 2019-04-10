<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jogadas extends Model
{
    protected $fillable = [
        'user_id',
        'nome',
        'tipo',
        'posicao'
    ];

    public function jogada($user_id, $nome, $player, $posicao){
        Jogadas::create(['user_id' => $user_id, 'nome' => $nome, 'tipo' => $player, 'posicao' => $posicao]);
    }
}
