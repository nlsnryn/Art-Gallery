<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Artist;
use App\Enums\UserLevel;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Authentication\RegisterRequest;

class RegisterController extends Controller
{    
    /**
     * Display a form for Artist Registration
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('auth.register');
    }
    
    /**
     * Store/Creating user and artist
     *
     * @param  mixed $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(RegisterRequest $request)
    {
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'user_level' => UserLevel::ARTIST,
                'password' => $request->password
            ]);
    
            $artist = Artist::create([
                'user_id' => $user->id,
                'location' => $request->location,
            ]);

            if($request->file('image')) 
            {
                $this->store_artist_image($request, $artist);
            }
    
            auth()->login($user);
    
            return redirect(route('artwork.index'));
        } catch(\Exception $e) {

            $errorMessage = $e->getMessage();
            return back()->withErrors(['error' => $errorMessage]);
        }
    }
    
    /**
     * Storing Image protected function
     *
     * @param  mixed $request
     * @param  mixed $artwork
     * @return void
     */
    protected function store_artist_image($request, $artist)
    {
        $ext = $request->file('image')->extension();
        $contents = file_get_contents($request->file('image'));
        $filename = Str::random(25);
        $path = "artist/$filename.$ext";
        Storage::disk('public')->put($path, $contents);
        $artist->update(['image' => $path]);
    }
}
