<?php

namespace App\Http\Controllers;

use App\Services\EntregaService;
use Illuminate\Http\Request;

class EntregaController extends Controller
{
    public function __construct(public EntregaService $service){}

    
}
