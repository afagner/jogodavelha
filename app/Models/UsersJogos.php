<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsersJogos extends Model
{
    protected $fillable = [
        'nome'
    ];

    public function novojogador($nome){
       return UsersJogos::create(['nome' => $nome]);
    }

    public function getUser($id){
        return UsersJogos::where('id', $id)->first();

    }
}
