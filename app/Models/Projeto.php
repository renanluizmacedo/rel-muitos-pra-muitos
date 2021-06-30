<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projeto extends Model
{

    function desenvolvedores(){
        return $this->belongsToMany("App\Models\Desenvolvedor","alocacoes")->withPivot('horas_semanais');
        //return $this->belongsToMany("App\Models\Desenvolvedor","alocacoes");

    }
    use HasFactory;
}
