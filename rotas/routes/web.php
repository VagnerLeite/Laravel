<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/ola', function () {
    return '<h1>Seja bem vindo</h1>';
});

Route::get('/ola/sejabemvindo', function () {
    return '<h1>Ola visitante, seja bem vindo</h1>';
});

Route::get('/nome/{nome}/{sobrenome}',function($nome, $sobrenome){
   return "<h1>Ola, $nome $sobrenome!</h1>"; 
});


Route::get('/repetir/{nome}/{n}',function($nome, $n){
    if(is_integer($n)){
        for($i = 0; $i < $n; $i++){
            echo "<h1>Ola, $nome! ($i)</h1>";
        }
    } else 
        echo "Voce nao digitou um numero inteiro";
    
});

Route::get('/seunomecomregra/{nome}/{n}',function($nome, $n){
    for($i = 0; $i < $n; $i++){
        echo "<h1>Ola, $nome! ($i)</h1>";
    }
})->where('n','[0-9]+')->where('nome','[A-Za-z]+'); ## Aqui ele insere uma regra de where que é um ubjeto do get; ===>> Aqui eu posso inserir a expressao regular que eu quiser
# e usando uma expressao regular estou dizendo que o parametro "n" so pode ir de 0-9 e pode repetir (+); -- Tambem posso encadear varias regras seguidas sem problema algum


### Aqui o uso do ? no parametro nome define que ele nao precisa ser obrigatorio, porém é necessario eu colocar o if isset para executar somente se a variavel existir, também coloco um valor padrao como null para toda validação funcionar corretamente
Route::get('/seunomesemregra/{nome?}',function($nome=null){    
    if(isset($nome)){
        echo "<h1>Ola, $nome!</h1>";
    } else {
        echo "Você não passou nome algum, seu mané!";
    }
}); 

#### Essa forma de criar rotas é mais efetivo e fica mais legivel e organizado as rotas 
#### Deixando de uma forma mais facil de dar manutenção
Route::prefix('app')->group(function(){
    Route::get("/", function(){
       return "Pagina Principal do App";
    }); 
    Route::get("profile", function(){
       return "Pagina Profile";
    }); 
    Route::get("about", function(){
       return "Meu about";
    }); 
});