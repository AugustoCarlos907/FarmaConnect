<?php

namespace App\Http\Controllers;

use App\Services\AlertService;
use Illuminate\Http\Request;

class AlertController extends Controller
{
     public function __construct( public AlertService $service){}

     public function listAlerts($paginate = 10){
        $this->service->getAlerts($paginate);

        return response()->json(200);
     }

}
