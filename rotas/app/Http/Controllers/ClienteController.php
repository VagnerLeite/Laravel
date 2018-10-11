<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        return "Lista dos Clientes - Raiz";
    }
    
    public function create()
    {
        return "Formulario para cadastro de Cliente";
        
        ## Eu poderia dar um return view w o nome da view.
        //return view('formCadastroCliente');
    }

    public function store(Request $request) #É atraves do request que capto os dados de um formulario enviado
    {
        $s = "Armazenar: ";
        $s .= "Nome: ".$request->input('nome'). " e ";
        $s .= "Idade: ".$request->input('idade');
        return response($s, 201);
    }

    public function show($id)
    {
        $v = ["Vagner", "Roberto", "Heitor", "Gabriel"];
        if($id >=0 && $id < count($v)){
            return $v[$id];
        }
        return "Nao Enontrado";
    }

    public function edit($id)
    {
        return "Formulario de Edição de Cliente - Edit Cliente Id: ".$id;
    }

    public function update(Request $request, $id)
    {
        #### Aqui la no postman eu coloco o método POST, e crio um input a mais com o nome de _method e value PUT. ==> Que significa que recebi os valores via POST, e estou enviando-os via PUT para efetuar o Update. (pode ser um input hidden de preferencia)
        $s = "Atualizar Cliente Id: $id: ";
        $s .= "Nome: ".$request->input('nome'). " e ";
        $s .= "Idade: ".$request->input('idade');
        return response($s, 200);
    }

    public function destroy($id)
    {
        return response("Apagado o Cliente Id: $id", 200);
    }
    
    public function requisitar(Request $request){
        echo "Nome: ".$request->input('nome');
    }
}
