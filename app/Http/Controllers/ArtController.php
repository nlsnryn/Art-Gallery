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
      if(auth()->user()->user_level == 'artist')
      {  
         $user = auth()->user();
         $artworks = Artwork::where('artist_id', $user->artist->id)->latest()->filter(request(['category', 'search']))->get();
         return view('artwork.index', ['artworks' => $artworks]);
      } else {
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
    * @return \Illuminate\Http\RedirectResponse
    */
   public function store(ArtworkStoreRequest $request)
   {
      try {
         $artistId = '';

         // Check which artistId will store to variable auth id or query
         if(auth()->user()->user_level == 'artist') 
         {
            $artistId = auth()->user()->artist->id;
         } 
         else 
         {
            $artistId = $request->query('artist_id');
         }

         $artwork = Artwork::create([
            'artist_id' => $artistId,
            'title' => $request->title,
            'price' => $request->price,
            'category' => $request->category,
            'description' => $request->description,
         ]);

         // Store an image
         if($request->file('image')) 
         {
            $this->store_image($request, $artwork);
         }

         if(auth()->user()->user_level == 'artist') 
         {
            return redirect(route('artwork.index'));
         } 
         else 
         {
            return redirect(route('artwork.index', ['artist' => $artistId]));
         }
      } catch(\Exception $e) {
         $errorMessage = $e->getMessage();
         return back()->withErrors(['error' => $errorMessage]);
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
    * @return \Illuminate\Http\RedirectResponse
    */
   public function update(ArtworkUpdateRequest $request, Artwork $artwork)
   {
      try {
         $artwork->update($request->except('image'));

         // Updating image if there's an image request 
         if($request->file('image')) 
         {
            // Check if the current artwork has image if there's then unlink the current image to storage
            if (!empty($artwork->image)) 
            {
               Storage::disk('public')->delete($artwork->image);
            }

            $this->store_image($request, $artwork);
         }

         return redirect(route('artwork.show', $artwork->id));
      } catch(\Exception $e) {
         $errorMessage = $e->getMessage();
         return back()->withErrors(['error' => $errorMessage]);
      }
   }
   
   /**
    * Delete artwork
    *
    * @param  mixed $artwork
    * @return \Illuminate\Http\RedirectResponse
    */
   public function destroy(Artwork $artwork)
   {  
      $artwork->delete();
      return redirect(route('artwork.index'));
   }
   
   /**
    * Method that will called if there's an update in image
    *
    * @param  mixed $request
    * @param  mixed $artwork
    * @return void
    */
   protected function store_image($request, $artwork)
   {
      $ext = $request->file('image')->extension();
      $contents = file_get_contents($request->file('image'));
      $filename = Str::random(25);
      $path = "artwork/$filename.$ext";
      Storage::disk('public')->put($path, $contents);
      $artwork->update(['image' => $path]);
   }
}
