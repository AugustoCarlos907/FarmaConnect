<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
            'data_nascimento' => 'nullable|date ',
            'genero' => 'nullable|string',
            // 'last_name'=> 'required|string|max:255',
            'endereco' => 'nullable|string|max:500',
            'latitude' => 'nullable|string',
            'longitude' => 'nullable|string',

        ]);

        $data['password'] = Hash::make($data['password']);


         try {
        $user = User::create($data); 
        if ($user) {
            Auth::login($user);
            return redirect()->route('index.clientes');
        }
    } catch (\Exception $e) {
        return back()->withErrors(['msg' => 'Erro ao criar utilizador: ' . $e->getMessage()])->withInput();
    }

    return back()->withErrors(['msg' => 'Falha no registo. Tente novamente.'])->withInput();
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
