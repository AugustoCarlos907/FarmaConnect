<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AvaliacaoController;
use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClientHomePageController;
use App\Http\Controllers\CompanhiaController;
use App\Http\Controllers\ComprovativoPagamentoController;
use App\Http\Controllers\DashboardEntregadorController;
use App\Http\Controllers\DashboardFarmaciaController;
use App\Http\Controllers\EntregaController;
use App\Http\Controllers\FarmaciaController;
use App\Http\Controllers\MedicamentoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;
use Twilio\Rest\Client;

    

    Route::middleware(['guest'])->group(function(){
        Route::get('/', function(){
            return view('index');
        })->name('index');


        Route::get('client/register', [AuthController::class, 'create'])->name('register');
        Route::post('/register', [AuthController::class, 'store']);

        Route::get('/email/verify', function () {
            return view('auth.verify-email');
        })->middleware('auth')->name('verification.notice');

        Route::get('/email/verify/{id}/{hash}', function () {
            return view('auth.verify-email');
        })->middleware(['auth', 'signed'])->name('verification.verify');
        
        Route::get('/login', [AuthController::class, 'login'])->name('login');
        Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
    });


    //companhia
    Route::post('companhia/register', [CompanhiaController::class, 'register']);
    Route::get('companhia/farmacia/create',function(){ 
        Auth::loginUsingId(3);
        return view('farmacias.auth.cadastro'); 
    })->name('companhia.farmacia.create');

    Route::post('companhia/register/farmacia', [CompanhiaController::class, 'registerFarmacia'])->name('companhia.farmacia.register');
    // Route::post('companhia/register/farmacia', [CompanhiaController::class, 'registerFarmacia']);

    //farmacias
    Route::middleware(['auth', 'farma'])->group(function(){ 
        Route::get('farmacia/dashboard', [DashboardFarmaciaController::class , 'dashboard'])->name('index.farmacias');
        Route::get('/farmacia/medicamentos', [FarmaciaController::class, 'listMedicamentos'])->name('medicamentos.farmacias');
        Route::post('/farmacia/create-medicamento' , [MedicamentoController::class , 'create'])->name('medicamentos.store');
        Route::get('farmacia/pedidos', [FarmaciaController::class, 'pedidos'])->name('pedidos.farmacias');
        Route::get('farmacia/entregadores', [FarmaciaController::class, 'entregadores'])->name('entregadores.farmacias');
        Route::get('/farmacia/clientes' , [FarmaciaController::class, 'clientes'])->name('clientes.farmacias');
        Route::get('/farmacia/avaliacoes' , [AvaliacaoController::class, 'index'])->name('avaliacoes.farmacias');
        Route::get('/farmacia/documentos' , [FarmaciaController::class, 'documentos'])->name('documentos.farmacias');

        Route::get('/alert/stock/items', []);
        Route::post('/relatorios/gerar', [ReportController::class, 'gerarRelatorio']);
        
        });
    
    //Entregadores
    Route::middleware(['auth', 'entregador'])->group(function(){

        Route::get('entregador/dashboard', [DashboardEntregadorController::class, 'dashboard'])->name('index.entregadores');
        Route::get('entregas/concluidas/{entregadorId}', [EntregaController::class, 'concluidasPorEntregador']);
        Route::get('entregas/em-transito/{entregadorId}', [EntregaController::class, 'emTransitoPorEntregador']);
        Route::get('entregas/canceladas/{entregadorId}', [EntregaController::class, 'canceladasPorEntregador']);
        Route::get('entregas/hoje/{entregadorId}', [EntregaController::class, 'deHojePorEntregador']);

        // Route::post('/logout/{id}' , [AuthController::class, 'logout'])->name('logout');
    });


    Route::get('/sms', function () {

    $sid = config('services.twilio.sid');
    $token = config('services.twilio.token');
    $from = config('services.twilio.from');

    $client = new Client($sid, $token);

    try {
        $message = $client->messages->create(
            '+244959361115', 
            [
                'from' => $from,
                'body' => 'FarmaConnect Testando Agora - Augusto Carlos',
            ]
        );

        return "SMS enviado com sucesso! SID: " . $message->sid;

    } catch (\Exception $e) {
        return "Erro ao enviar SMS: " . $e->getMessage();
    }

});

    //clientes
    Route::middleware(['auth' , 'user'])->group(function(){
        Route::get('/home', function(){ 
            // Auth::loginUsingId(3);
            return view('clientes.dashboard.index'); 
        
        })->name('index.clientes');
        Route::get('/perfil' , [PerfilController::class, 'UserProfile'])->name('perfil.clientes');
        Route::get('/farmacias', [ClientHomePageController::class, 'farmacias'])->name('farmacias.list');
        Route::get('/produtos' , [ClientHomePageController::class, 'produtos'])->name('produtos.clientes');
        Route::get('/carrinho', function(){ return view('clientes.dashboard.carrinho'); })->name('carrinho.clientes');

        Route::post('/pedidos', [PedidoController::class, 'store'])->name('pedidos.store');
        Route::get('/pedidos', [PedidoController::class, 'pedidos'])->name('pedidos.clientes');
        Route::post('/pedidos/{id}/cancelar', [PedidoController::class, 'cancelar']);

        Route::post('/enderecos-create' ,[])->name('enderecos.store');
        Route::get('/categorias', [ClientHomePageController::class, 'searchCategorias'])->name('categorias');
        Route::get('categorias/produtos/{id}', [ClientHomePageController::class, 'produtosPorCategoria'])->name('produtos.categoria');

        Route::prefix('carrinho')->name('carrinho.')->group(function () {
            Route::get('/',                        [CarrinhoController::class, 'index'])     ->name('clientes');
            Route::post('/adicionar',              [CarrinhoController::class, 'adicionar']) ->name('adicionar');
            Route::patch('/{carrinho}',            [CarrinhoController::class, 'actualizar'])->name('actualizar');
            Route::delete('/remover/{carrinho}',   [CarrinhoController::class, 'remover'])   ->name('remover');
            Route::delete('/limpar',               [CarrinhoController::class, 'limpar'])    ->name('limpar');
        });
        
        Route::get('/search-medicamentos'  , [MedicamentoController::class , 'index'])->name('medicamentos.search');
        Route::get('/search-farmacias'  , [FarmaciaController::class , 'search'])->name('farmacias.search');
        Route::get('/search-categorias'  , [CategoriaController::class , 'search'])->name('categorias.search');

        Route::post('/upload/comprovativo/{id}', [ComprovativoPagamentoController::class, 'uploadComprovativo']);

        // Route::post('/logout/{id}' , [AuthController::class, 'logout'])->name('logout');
    });
        
    Route::post('/logout/{id}' , [AuthController::class, 'logout'])->name('logout');

