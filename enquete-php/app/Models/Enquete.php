<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enquete extends Model
{
    protected $c = [
        'finish_at' => 'datetime',
    ];
    public function respostas(){
        return $this->hasMany(Respostas::class);
    }
}
