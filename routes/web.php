<?php

use Illuminate\Support\Facades\Route;

use App\Models\alocacao;
use App\Models\Projeto;
use App\Models\Desenvolvedor;

Route::get('/desenvolvedor_projetos', function () {

    $desenvolvedores = Desenvolvedor::with('projetos')->get();
    
    foreach($desenvolvedores as $d){
        echo "<p> Nome do Desenvolvedor: ". $d->nome ."</p>";
        echo "<p> Cargo ". $d->cargo ."</p>";
 
        if(count($d->projetos) > 0){
            echo "Projetos: <br>";
            echo "<ul>";
            foreach($d->projetos as $p){
                echo "<li>";
                echo "Nome:" .$p->nome . "|";
                echo "Horas do projeto: " .$p->estimativa_horas . "|";
                echo "Horas trabalhadas: " .$p->pivot->horas_semanais;

                echo "</li>";

            }
            echo "</ul>";
        }
        echo "<hr>";
    }
    
    //return $desenvolvedores->toJson();
});
Route::get('/desenvolvedor_projetos_toJson', function () {

    $desenvolvedores = Desenvolvedor::with('projetos')->get();
    
    return $desenvolvedores->toJson();
});