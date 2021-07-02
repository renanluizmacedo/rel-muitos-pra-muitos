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
Route::get('/projetos_desenvolvedor', function () {

    $projetos = Projeto::with('desenvolvedores')->get();
    
    foreach($projetos as $p){
        echo "<p> Nome do Projeto: ". $p->nome ."</p>";
        echo "<p> Horas do projeto: " .$p->estimativa_horas ."</p>";

        if(count($p->desenvolvedores) > 0){
            echo "Desenvolvedores: <br>";
            echo "<ul>";
            foreach($p->desenvolvedores as $d){
                echo "<li>";
                echo "Nome: " .$d->nome . " | ";
                echo "Cargo: " .$d->cargo . " | ";
                echo "Horas trabalhadas: " .$d->pivot->horas_semanais;
                echo "</li>";
            }
            echo "</ul>";
        }
        echo "<hr>";
    }
    
    //return $desenvolvedores->toJson();
});
Route::get('/alocar',function(){
    $proj = Projeto::find(4);

    if(isset($proj)){
        $proj->desenvolvedores()->attach([
                1 => ['horas_semanais' => 20],
                2 => ['horas_semanais' => 40],
                3 => ['horas_semanais' => 60],
            ]);

    }
});
Route::get('/desalocar',function(){
    $proj = Projeto::find(4);

    if(isset($proj)){
        $proj->desenvolvedores()->detach([1,2,3]);
    }
});
Route::get('/projetos_desenvolvedor_toJson', function () {

    $projetos = Projeto::with('desenvolvedores')->get();
    
    return $projetos->toJson();
});
Route::get('/desenvolvedor_projetos_toJson', function () {

    $desenvolvedores = Desenvolvedor::with('projetos')->get();
    
    return $desenvolvedores->toJson();
});