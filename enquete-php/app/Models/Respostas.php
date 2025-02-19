<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Respostas extends Model
{
    public function enquete(){
        return $this->belongsTo(Enquete::class);
    }
    public function qtdvotos(){
        return $this->hasMany(Votos::class);
    }
}
