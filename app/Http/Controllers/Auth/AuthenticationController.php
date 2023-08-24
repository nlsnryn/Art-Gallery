<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Authentication\LoginRequest;

use function Laravel\Prompts\error;

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
     * @return \Illuminate\Http\RedirectResponse||\Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        try {
            $credentials = $request->only('email', 'password');
            
            if(Auth::attempt($credentials))
            {
                $request->session()->regenerate();
                $user = User::where('email', $request->email)->firstOrFail();

                return response()->json(['user' => $user]);
                // $redirect_route = ($user->user_level == 'super admin') ? 'admin.index' : ($user->user_level == 'admin' ? 'artist.index' : 'artwork.index');
                // return redirect(route($redirect_route));
            } 
            else 
            {
                // return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
                return response()->json(['message' => 'Invalid Credentials'],400);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Invalid Credentials'],400);
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
