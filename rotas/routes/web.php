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
use Illuminate\Http\Request;

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
#### quando eu redireciono, ele o faz aceitando todos os metodos Http
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

Route::post('/rest/imprimir', function(Request $req){
    $nome = $req->input('nome');
    $idade = $req->input('idade');
    $telefone = $req->input('telefone');
    
    return "Http POST: <br /> 
            Nome: ($nome, $idade) <br />
            Telefone: $telefone";
    
    #### Ou eu poderia retornar um Json se eu quisesse
    $arrUsuario = array('nome' => $nome, 'idade' => $idade, 'telefone' => $telefone);
    return json_encode($arrUsuario);
});

#### O primeiro parametro do match vai ser quais os metodos http que eu vou atender nessa requisição
#### O Segundo parâmetro é qual rota que eu vou atender nessa requisição;
#### O Terceiro Parametro é o que vamos fazer assimq ue chegar a requisição;
Route::match(['get', 'post'], '/rest/hello2', function(){
    return "Hello fucking World 2";
});

#### Aqui eu configuro para atender a qualquer metodo http que chega na minha requisição, não tem muito sentido usar dessa forma, mas é possivel fazê-lo se quiser
Route::any('/rest/hello3', function(){
    return "Hello fucking World 3. Any methods!";
});


Route::get('/produtos', function(){
    echo "<h1>Produtos</h1>"; 
    echo "<ol>";
        echo "<li>Notebook</li>";
        echo "<li>Desktop</li>";
        echo "<li>Monitor</li>";
        echo "<li>Mouse</li>";
    echo "</ol>";
})->name('meusprodutos');

#### Aqui eu passo o link da rota acima usando o nome dela, se meu sistema algum dia precisar mudar o nome da rota produtos para meusprodutos, eu posso fazer isso mudando/atribuindo o nome para a rota ao inves de mudar a rota e depois mudar todas as chamadas do meu sistema onde tem o '/produtos'

#### E se mesmo assim alguem foi la e precisou mudar o nome da rota para '/produtosssss' eunao preciso me preocupar, pois eu estou usando o nome da rota, isso pouca trabalho desnecessario
Route::get('/linkprodutos', function(){
    $url = route('meusprodutos');
    echo "<a href=\"$url\">Meus Produtos</a>";
});


Route::get('/redirecionarprodutos', function(){
    #### Aqui neste caso, eu poderia redirecionar direto para o '/produtos', mas não sao boas praticas, pois se alterar o nome da rota, fode todas as chamadas do sistema
    return redirect()->route('meusprodutos'); 
});






