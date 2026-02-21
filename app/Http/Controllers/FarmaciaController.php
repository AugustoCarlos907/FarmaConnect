<?php

namespace App\Http\Controllers;

use App\Models\Companhia;
use App\Models\User;
use Illuminate\Http\Request;

class FarmaciaController extends Controller
{
    //list all pharmacies next to me with all detaills (avaluations and etc)
    //by long and lat



    
    public function dashboard(){
        return view('farmacias.dashboard.index');
    }

}