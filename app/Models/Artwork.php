<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Artwork extends Model
{
    use HasFactory, SoftDeletes;
    
    /**
     * guarded
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * dates
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Define a many-to-one relationship with the Artist model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function artist()
    {
        return $this->belongsTo(Artist::class, 'artist_id', 'id');
    }

    /**
     * Define a one-to-many relationship with the Query model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function queries()
    {
        return $this->hasMany(Query::class, 'artwork_id', 'id');
    }
    
    /**
     * Scope a query to filter results based on provided filters.
     *
     * @param  mixed $query
     * @param  mixed $filters
     * @return void
     */
    public function scopeFilter($query, array $filters)
    {
        if($filters['category'] ?? false)
        {
            $query->where('category', 'like', '%' . request('category') . '%');
        }

        if($filters['search'] ?? false)
        {
            $query->where('title', 'like', '%' . request('search') . '%')
                ->orwhere('description', 'like', '%' . request('search') . '%')
                ->orwhere('category', 'like', '%' . request('search') . '%');
        }
    }
}
