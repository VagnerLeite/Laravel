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

#### Redirecionamento de rotas
#### Parametros: DE, PARA, Protocolo HTTP
#### Tudo que chegar no '/aqui' vai redirecionar pro '/ola'
Route::redirect('/aqui', '/ola', 301);

#### Redirecionar diretamente para view
Route::get('/hello', function () {
    return view('hello');
});

#### De outra forma:
Route::view('/helloo', 'hello');


#### Agora passando parametros:
#### O primeiro parametro é a rota, o segundo é o nome da view (que antecede o .blade) e o terceiro é o array de valore (array associativo)
Route::view('/viewname'
            , 'helloname'
            , ['nome' => 'Vagner' , 'sobrenome' => 'Leite']
           );

#### E aqui dessa, forma eu defino uma rota que retorna uma view e envia os parametros de variaveis recebidas 
Route::get('/helloname/{nome}/{sobrenome}', function($nome, $sn){
    $arrNome = ['nome' => $nome, 'sobrenome' => $sn]; # possofazer assim, ou simplesmente jogar direto o array ali embaixo, achei assim mais limpo de entender;
    return view('helloname'
                , $arrNome
               );
});


#### A partir daqui Faços os testes de HTTP requests

Route::get('/rest/hello', function(){
    return "Hello (GET)";
});

Route::post('/rest/hello', function(){
    return "Hello (POST)";
});

Route::delete('/rest/hello', function(){
    return "Hello (DELETE)";
});

Route::put('/rest/hello', function(){
    return "Hello (PUT)";
});

Route::patch('/rest/hello', function(){
    return "Hello (PATCH)";
});

Route::options('/rest/hello', function(){
    return "Hello (OPTIONS)";
});

