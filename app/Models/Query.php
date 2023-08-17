<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Query extends Model
{
    use HasFactory, Notifiable, SoftDeletes;
    
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
     * Get the email address where mail notifications should be sent.
     *
     * @return string
     */
    public function routeNotificationForMail()
    {
        return $this->client_email;
    }
    
    /**
     * Define a many-to-one relationship with the Artwork model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function artwork()
    {
        return $this->belongsTo(Artwork::class, 'artwork_id', 'id');
    }
    
    /**
     * user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'status_changed_by_id', 'id');
    }
}
