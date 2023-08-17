<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Authentication\LoginRequest;

class AuthenticationController extends Controller
{    
    /**
     * Display a form for login
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('auth.login');
    }
        
    /**
     * Log in the user
     *
     * @param  mixed $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(LoginRequest $request)
    {
        if(auth()->attempt($request->only('email', 'password')))
        {
            $request->session()->regenerate();

            $user = User::where('email', $request->email)->firstOrFail();

            $redirect_route = ($user->user_level == 'super admin') ? 'admin.index' : ($user->user_level == 'admin' ? 'artist.index' : 'artwork.index');
            return redirect(route($redirect_route));
        } 
        else 
        {
            return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
        }
    }
    
    /**
     * Log out the user
     *
     * @param  mixed $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('login'));
    }
}
