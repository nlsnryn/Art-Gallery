<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Artist;
use App\Enums\UserLevel;
use App\Http\Requests\Artist\ArtistUpdateRequest;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Authentication\RegisterRequest;

class ArtistController extends Controller
{
    /**
     * Showing all Artist
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $artists = Artist::latest()->filter(request(['search']))->get();
        return view('artist.index', ['artists' => $artists]);
    }

    /**
     * Display create form for Creating Artist account
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('artist.create');
    }

    /**
     * Store an artist record
     *
     * @param  mixed $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(RegisterRequest $request)
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

            // Store an image
            if ($request->file('image')) {
                $this->store_artist_image($request, $artist);
            }

            return redirect(route('artist.index'));
            // return response()->json('Saved successfully');
        } catch (\Exception $e) {
            // $errorMessage = $e->getMessage();
            // return back()->withErrors(['error' => $errorMessage]);
            return response()->json(['errors' => $e->getMessage()], 422);
        }
    }

    /**
     * Display Edit form for Artist
     *
     * @param  mixed $artist
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Artist $artist)
    {
        return view('artist.edit', ['artist' => $artist]);
    }

    /**
     * Show specific Artist details
     *
     * @param  mixed $artist
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Artist $artist)
    {
        // dd($artist);
        $totalSold = null;

        foreach ($artist->artworks as $artwork) {
            if ($artwork->sold) {
                $totalSold += 1;
            }
        }

        return view('artist.show', ['artist' => $artist, 'sold' => $totalSold]);
    }

    /**
     * Update an artwork data from Edit form and update into artworks table
     *
     * @param  mixed $request
     * @param  mixed $artist
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function update(ArtistUpdateRequest $request, Artist $artist)
    {
        try {
            $artist->user->update([
                'name' => $request->name,
                'password' => $request->password
            ]);
    
            $artist->update([
                'location' => $request->location,
            ]);
    
            // Check if the current artist has image if there's then unlink the current image to storage
            if ($request->file('image')) {
                if (!empty($artist->image)) {
                    Storage::disk('public')->delete($artist->image);
                }
    
                $this->store_artist_image($request, $artist);
            }
    
            // return redirect(route('artist.index'));
            return response()->json('Successfully Artist updated.');
        } catch(\Exception $e) {
            return response()->json(['errors' => $e->getMessage()], 422);
        }
        
    }

    /**
     * Delete specific artist
     *
     * @param  mixed $artist
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function destroy(Artist $artist)
    {
        if ($artist->artworks->count()) 
        {
            foreach ($artist->artworks as $artwork)
            {
                $artwork->delete();
            }
        }
        
        $artist->user->delete();
        $artist->delete();
        // return redirect(route('artist.index'));
        return response()->json('Delete Artist Successfully');
    }

    /**
     * Store image method
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

    /**
     * Search for Artist Record for Authenticated User
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function search_artists()
    {
        $artists = Artist::latest()->filter(request(['search']))->get();

        $renderedArtists = '';
        foreach ($artists as $artist) {
            $renderedArtists .= view('components.artist-card', ['artist' => $artist])->render();
        }

        return response()->json(['artists' => $renderedArtists]);
    }
    
    /**
     * Display all restorable artist deleted
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function restore_index()
    {
        $restorableArtists = Artist::with(['user' => function ($query) {
            $query->onlyTrashed();
        }])->onlyTrashed()->get();

        // dd($restorableArtists);
        return view('artist.restore', ['artists' => $restorableArtists]);
    }

    /**
     * Restore the artist
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($artist)
    {
        $artist = Artist::with(['user' => function ($query) {
            $query->onlyTrashed();
        }])->onlyTrashed()->find($artist);

        $artist->user->restore();
        $artist->restore();
        return redirect(route('artist.restore.index'));
    }
}
