<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanhiaController;
use App\Http\Controllers\ComprovativoPagamentoController;
use App\Http\Controllers\EntregaController;
use App\Http\Controllers\FarmaciaController;
use App\Http\Controllers\PedidoController;
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

    Route::post('companhia/register/farmacia', [CompanhiaController::class, 'registerFarmacia']);

    //farmacias

    Route::get('/dashboard', [FarmaciaController::class , 'dashboard'])->name('index.farmacias');
    Route::get('/alert/stock/items', []);
    Route::post('/relatorios/gerar', [ReportController::class, 'gerarRelatorio']);
    //entregadores
    Route::get('entregas', [EntregaController::class , 'getAllEntregasByEntregador']);

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
    Route::post('/pedidos', [PedidoController::class, 'store']);
    Route::get('/pedidos', [PedidoController::class, 'index']);
    Route::post('/pedidos/{id}/cancelar', [PedidoController::class, 'cancelar']);

    Route::post('/upload/comprovativo/{id}', [ComprovativoPagamentoController::class, 'uploadComprovativo']);