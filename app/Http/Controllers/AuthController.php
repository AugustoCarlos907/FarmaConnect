<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function create()
    {
        return view('clientes.auth.cadastro');
    }

    public function store(Request $request)
    {
       $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'nullable|string|max:20',
            'data_nascimento' => 'nullable|date |before_or_equal_today',
            'genero' => 'nullable|string',
            'last_name'=> 'required|string|max:255',
            'endereco' => 'nullable|string|max:500',
            'latitude' => 'nullable|string',
            'longitude' => 'nullable|string',

        ]);


        if($data ){

            $user = User::create($data);

            
            // Event::dispatch(new Registered($user));

            Auth::user()->login($user);

            return redirect()->route('index.clientes');
            // return redirect()->route('verification.notice');
        }

        return back()->withErrors(['msg' => 'Registration failed. Please try again.']);
    }

    
    public function login()
    {
        return view('clientes.auth.login');
    }

   public function authenticate(Request $request){   
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);



        if ($credentials && Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if(Auth::user()->role == 'cliente'){

                return redirect()->route('index.clientes');
            }


            if(Auth::user()->role == 'gestor_farmacia'){

                return redirect()->route('index.farmacias');
            }


            if(Auth::user()->role == 'entregador'){

                return redirect()->route('index.entregadores');
            }            
            
            if(Auth::user()->role == 'admin'){

                return redirect()->route('index.admin');
            }
        }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ]);
    }

    public function logout($id)
    {
        $user = User::find($id);
        if ($user && Auth::id() === $user->id) {
            Auth::logout();
            return redirect()->route('index');
        }
    }

}
