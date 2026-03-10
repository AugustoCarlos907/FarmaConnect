<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientHomePageController;
use App\Http\Controllers\CompanhiaController;
use App\Http\Controllers\ComprovativoPagamentoController;
use App\Http\Controllers\DashboardEntregadorController;
use App\Http\Controllers\DashboardFarmaciaController;
use App\Http\Controllers\EntregaController;
use App\Http\Controllers\FarmaciaController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;
use Twilio\Rest\Client;

    

// Route::middleware(['guest'])->group(function(){

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
// });

    //companhia
    Route::post('companhia/register', [CompanhiaController::class, 'register']);
    Route::get('companhia/farmacia/create',function(){ 
        Auth::loginUsingId(3);
        return view('farmacias.auth.cadastro'); 
    })->name('companhia.farmacia.create');

    Route::post('companhia/register/farmacia', [CompanhiaController::class, 'registerFarmacia'])->name('companhia.farmacia.register');

    // Route::post('companhia/register/farmacia', [CompanhiaController::class, 'registerFarmacia']);

    //farmacias
    Route::get('farmacia/dashboard', [DashboardFarmaciaController::class , 'dashboard'])->name('index.farmacias');
    Route::get('/alert/stock/items', []);
    Route::post('/relatorios/gerar', [ReportController::class, 'gerarRelatorio']);
    Route::post('/logout/{id}' , [AuthController::class, 'logout'])->name('logout');
    
    
    //Entregadores
    Route::get('entregador/dashboard', [DashboardEntregadorController::class, 'dashboard'])->name('index.entregadores');
    Route::get('entregas/concluidas/{entregadorId}', [EntregaController::class, 'concluidasPorEntregador']);
    Route::get('entregas/em-transito/{entregadorId}', [EntregaController::class, 'emTransitoPorEntregador']);
    Route::get('entregas/canceladas/{entregadorId}', [EntregaController::class, 'canceladasPorEntregador']);

    Route::get('entregas/hoje/{entregadorId}', [EntregaController::class, 'deHojePorEntregador']);


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
    Route::get('/home', function(){ 
        Auth::loginUsingId(3);
        return view('clientes.dashboard.index'); 
    
    })->name('index.clientes');
    Route::get('/perfil' , [ClientHomePageController::class, 'perfil'])->name('perfil.clientes');
    Route::get('/farmacias', [ClientHomePageController::class, 'farmacias'])->name('farmacias.list');
    Route::get('/produtos' , [ClientHomePageController::class, 'produtos'])->name('produtos.clientes');
    Route::get('/carrinho', function(){ return view('clientes.dashboard.carrinho'); })->name('carrinho.clientes');

    Route::post('/pedidos', [PedidoController::class, 'store']);
    Route::get('/pedidos', [ClientHomePageController::class, 'pedidos'])->name('pedidos.clientes');
    Route::post('/pedidos/{id}/cancelar', [PedidoController::class, 'cancelar']);

    Route::get('/categorias', [ClientHomePageController::class, 'searchCategorias'])->name('categorias');
    Route::get('categorias/produtos/{id}', [ClientHomePageController::class, 'produtosPorCategoria'])->name('produtos.categoria');

    Route::post('/upload/comprovativo/{id}', [ComprovativoPagamentoController::class, 'uploadComprovativo']);