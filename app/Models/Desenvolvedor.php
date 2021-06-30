<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desenvolvedor extends Model
{
    protected $table = 'desenvolvedores';

    function projetos(){
        return $this->belongsToMany("App\Models\Projeto","alocacoes")->withPivot('horas_semanais');
    }
    use HasFactory;
}
