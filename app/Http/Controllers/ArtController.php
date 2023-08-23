<?php

namespace App\Http\Controllers;

use App\Models\Artwork;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Artwork\ArtworkStoreRequest;
use App\Http\Requests\Artwork\ArtworkUpdateRequest;

class ArtController extends Controller
{
   /**
    * Display Artist's Artwork if the Artist is Authenticated
    * Display all Artist if the authenticated user is admin or super admin
    *
    * @param  mixed $request
    * @return  \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
    */
   public function index(Request $request)
   {
      if (auth()->user()->user_level == 'artist') 
      {
         $user = auth()->user();
         $artworks = Artwork::where('artist_id', $user->artist->id)->latest()->filter(request(['category', 'search']))->get();
         return view('artwork.index', ['artworks' => $artworks]);
      } 
      else 
      {
         return redirect()->route('artist.show', ['artist' => $request->query('artist')]);
      }
   }

   /**
    * Display create form for Artwork
    *
    * @return \Illuminate\Contracts\View\View
    */
   public function create()
   {
      return view('artwork.create');
   }

   /**
    * Store artwork data from create from into artworks table
    *
    * @param  mixed $request
    * @return \Illuminate\Http\RedirectResponse||\Illuminate\Http\JsonResponse
    */
   public function store(ArtworkStoreRequest $request)
   {
      try {
         $artist_id = '';

         // Check which artist_id will store to variable auth id or query
         if (auth()->user()->user_level == 'artist') 
         {
            $artist_id = auth()->user()->artist->id;
         } 
         else 
         {
            $artist_id = $request->query('artist_id');
         }

         $artwork = Artwork::create([
            'artist_id' => $artist_id,
            'title' => $request->title,
            'price' => $request->price,
            'category' => $request->category,
            'description' => $request->description,
         ]);

         // Store an image
         if ($request->file('image')) {
            $this->store_image($request, $artwork);
         }

         return response()->json(['message' => 'Artwork saved.']);
         // if (auth()->user()->user_level == 'artist') {
         //    return redirect(route('artwork.index'));
         // } else {
         //    return redirect(route('artwork.index', ['artist' => $artist_id]));
         // }
      } catch (\Exception $e) {
         $error_message = $e->getMessage();
         return back()->withErrors(['error' => $error_message]);
      }
   }

   /**
    * Showing specific Artwork that request from the user
    *
    * @param  mixed $artwork
    * @return \Illuminate\Contracts\View\View
    */
   public function show(Artwork $artwork)
   {
      return view('artwork.show', ['artwork' => $artwork]);
   }

   /**
    * Display edit form to update Artwork
    *
    * @param  mixed $artwork
    * @return \Illuminate\Contracts\View\View
    */
   public function edit(Artwork $artwork)
   {
      return view('artwork.edit', ['artwork' => $artwork]);
   }

   /**
    * Update artwork data from edit form and save into artworks table
    *
    * @param  mixed $request
    * @param  mixed $artwork
    * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
    */
   public function update(ArtworkUpdateRequest $request, Artwork $artwork)
   {
      try {
         $artwork->update($request->except('image'));

         // Updating image if there's an image request 
         if ($request->file('image')) 
         {
            // Check if the current artwork has image if there's then unlink the current image to storage
            if (!empty($artwork->image)) {
               Storage::disk('public')->delete($artwork->image);
            }

            $this->store_image($request, $artwork);
         }

         return response()->json(['message' => 'Update Successfully']);
         // return redirect(route('artwork.show', $artwork->id));
      } catch (\Exception $e) {
         $error_message = $e->getMessage();
         return back()->withErrors(['error' => $error_message]);
      }
   }

   /**
    * Delete artwork
    *
    * @param  mixed $artwork
    * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
    */
   public function destroy(Artwork $artwork)
   {
      $artwork->delete();
      return response()->json(['message' => 'Artwork Deleted']);
      // $artistId = $artwork->artist->id;
      // if (auth()->user()->user_level == 'artist')
      // {
      //    return redirect(route('artwork.index'));
      // }
      // else
      // {
      //    return redirect(route('artwork.index', ['artist' => $artistId]));
      // }
   }

   /**
    * Method that will called if there's an update in image
    *
    * @param  mixed $request
    * @param  mixed $artwork
    * @return void
    */
   public function store_image($request, $artwork)
   {
      $ext = $request->file('image')->extension();
      $contents = file_get_contents($request->file('image'));
      $filename = Str::random(25);
      $path = "artwork/$filename.$ext";
      Storage::disk('public')->put($path, $contents);
      $artwork->update(['image' => $path]);
   }


   /**
    * Search for Artwork Record for Authenticated User
    *
    * @return \Illuminate\Http\JsonResponse
    */
   protected function search_artworks()
   {
      $artworks = Artwork::where('artist_id', auth()->user()->artist->id)->with('artist.user')->withCount('queries')->latest()->filter(request(['category', 'search']))->get();

      $rendered_artworks = '';
      foreach ($artworks as $artwork) {
         $rendered_artworks .= view('components.art-card', ['artwork' => $artwork])->render();
      }

      return response()->json(['artworks' => $rendered_artworks]);
   }
}
