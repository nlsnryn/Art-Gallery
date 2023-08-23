<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Artwork;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    /**
     * Show all Artworks and artist in Guest Dashboard
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $artworks = Artwork::latest()->filter(request(['category']))->get();
        $artists = Artist::with('artworks')->get();
        return view('dashboard', ['artworks' => $artworks, 'artists' => $artists]);
    }

    /**
     * Show specific Artwork for Guest viewing
     *
     * @param  mixed $artwork
     * @return \Illuminate\Contracts\View\View
     */
    public function show_art(Artwork $artwork)
    {
        return view('art-show', ['artwork' => $artwork]);
    }

    /**
     * Show specific Artist for Guest viewing
     *
     * @param  mixed $artist
     * @return \Illuminate\Contracts\View\View
     */
    public function show_artist(Artist $artist)
    {
        return view('artist-show', ['artist' => $artist]);
    }

    /**
     * Search for Artwork
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function search_artworks()
    {
        $artworks = Artwork::with('artist.user')->withCount('queries')->latest()->filter(request(['category', 'search']))->get();
        $rendered_artworks = '';
        foreach ($artworks as $artwork) {
            $rendered_artworks .= view('components.art-card', ['artwork' => $artwork])->render();
        }

        return response()->json(['artworks' => $rendered_artworks]);
    }
}
