<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Artist extends Model
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
     * Define a one-to-one relationship with the User model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /**
     * Define a one-to-many relationship with the Artwork model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function artworks()
    {
        return $this->hasMany(Artwork::class, 'artist_id', 'id');
    }

    public function scopeFilter($query, array $filters)
    {
        if($filters['search'] ?? false)
        {
            $query->whereHas('user', function ($userQuery) {
                $userQuery->where('name', 'like', '%' . request('search') . '%');
            });
        }
    }

    public function scopeFilterTrashed($query, array $filters)
    {
        if ($filters['search'] ?? false) {
            $query->onlyTrashed()
            ->whereHas('user', function ($userQuery) {
                $userQuery->onlyTrashed()
                    ->where('name', 'like', '%' . request('search') . '%');
            });
        }
    }
}
