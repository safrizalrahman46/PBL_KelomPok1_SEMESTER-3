<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session as FacadesSession;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        return redirect('/')->withErrors(['email' => 'Invalid credentials']);
    }

    public function index()
    {

        if (Auth::check()) {
            return Redirect('/dashboard');
        }

        return view('admin.login');
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function prosesLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $kredensil = $request->only('email', 'password');

        if (Auth::attempt($kredensil)) {
            $user = Auth::user();

            if ($user->role != 'admin' && $user->role != 'operator' && $user->status == 'Inactive') {
                FacadesSession::flush();
                Auth::logout();

                return redirect('/')
                    ->withInput()
                    ->withErrors(['error' => 'This management system is for administrator and operator only']);

            }

            // if ($user->status == 'Active') {
            //     return redirect()->intended('dashboard');
            // } elseif ($user->status == 'Inactive') {
            //     FacadesSession::flush();
            //     Auth::logout();

            //     return redirect('/')
            //         ->withInput()
            //         ->withErrors(['error' => 'The user is inactive, you should contact administrator']);

            // } else {
            //     FacadesSession::flush();
            //     Auth::logout();

            //     return redirect('/')
            //         ->withInput()
            //         ->withErrors(['error' => 'The user is already banned from the sistem']);

            // }
        }

        return redirect('/')
            ->withInput()
            ->withErrors(['error' => 'Username or password invalid.']);

    }

    public function signout()
    {
        FacadesSession::flush();
        Auth::logout();
        return Redirect('/');
    }

}
