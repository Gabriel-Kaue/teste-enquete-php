<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Votos extends Model
{
    public function respostas(){
        return $this->belongsTo(Respostas::class);
    }
}
