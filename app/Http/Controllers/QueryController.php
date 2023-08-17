<?php

namespace App\Http\Controllers;

use App\Models\Query;
use App\Models\Artwork;
use Illuminate\Http\Request;
use App\Http\Requests\Query\QueryStoreRequest;
use App\Jobs\QueryStatusJob;

class QueryController extends Controller
{    
    /**
     * Store Query from Guest
     *
     * @param  mixed $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(QueryStoreRequest $request)
    {
        $query = $request->all();
        $query['artwork_id'] = $request->route('artwork');
        Query::create($query);
  
        return redirect()->route('query.success', ['artwork' => $request->route('artwork')]);
    }
        
    /**
     * Show specific query to update status
     *
     * @param  mixed $artwork
     * @param  mixed $query
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Artwork $artwork, Query $query)
    {
        return view('query.show', ['artwork' => $artwork, 'query' => $query]);
    }
    
    /**
     * Update Query status, who's user changed it and changed status date and time
     *
     * @param  mixed $request
     * @param  mixed $artwork
     * @param  mixed $query
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Artwork $artwork, Query $query)
    {
        $query->update([
            'status' => $request->status,
            'status_changed_by_id' => auth()->user()->id,
            'status_changed_at' => now()->format('Y-m-d H:i:s')
        ]);
        
        QueryStatusJob::dispatch($query, $artwork);
        $query->delete();
        // $trash = Query::withTrashed()->get();
        // dd($trash);
        return redirect()->route('artwork.show', $artwork->id);
    }
    
    /**
     * For Guest Confirmation that they query is sent
     *
     * @param  mixed $request
     * @return \Illuminate\Contracts\View\View
     */
    public function success(Request $request)
    {
        return view('query.success', ['artwork' => $request->route('artwork')]);
    }
    
    /**
     * history
     *
     * @param  mixed $artwork
     * @return \Illuminate\Contracts\View\View
     */
    public function history(Artwork $artwork)
    {  
        $trashed_queries = Query::onlyTrashed()
                        ->where('artwork_id', $artwork->id)
                        ->get();
        // dd($trashed_queries);
        return view('query.history', ['queries' => $trashed_queries, 'artwork' => $artwork]);
    }
}
