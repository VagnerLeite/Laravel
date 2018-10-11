<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyController extends Controller
{
    #### a partir da Rota, aqui eu recebo a requisicao
    public function getNome(){
        return "Vagner Alves Leite";
    }
    
    public function getIdade(){
        return "33 anos";
    }
    
    public function multiplicar($n1, $n2){
        return $n1 * $n2;
    }    
    
    public function getNomeById($id){
        $v = ["Vagner", "Roberto", "Heitor", "Gabriel"];
        if($id >=0 && $id < count($v)){
            return $v[$id];
        }
        return "Nao Enontrado";
    }   
}
