<?php

namespace App\Http\Controllers;

use App\Exceptions\ErrorHandler;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Throwable;

class AuthController extends Controller
{
    public $errorHandler;

    public function __construct(ErrorHandler $errorHandler) {
        $this->errorHandler = $errorHandler;
    }

    public function login()
    {
        try {
            return view('pages.auth.login');
        } catch (Throwable $e) {
            return $this->errorHandler->render($e);
        }
    }
    
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'username' => 'Kredensial anda tidak cocok.',
        ])->onlyInput('username');
    }
    
    public function register()
    {
        try{
            return view('pages.auth.register');
        } catch (Throwable $e) {
            return $this->errorHandler->render($e);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50|unique:users,username',
            'username' => 'required|string|max:20|min:6',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required|string|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => $request->password,
            'password_confirmation' => $request->password_confirmation,
        ]);

        return redirect()->route('login');
    }

    public function logout(Request $request){
        Auth::logout();
 
        $request->session()->invalidate();
     
        $request->session()->regenerateToken();
     
        return redirect('/login');
    }
}
