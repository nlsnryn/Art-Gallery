<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Query;
use App\Models\Artwork;
use App\Notifications\QueryStatusNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use App\Notifications\InquirerQueryStatusNotification;

class QueryStatusJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public Query $query, public Artwork $artwork)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // $user = User::where('email', $this->artwork->artist->user->email)->firstOrFail(); 
        $user = $this->artwork->artist->user;
        $inquirer = $this->query;

        $inquirer->notify(new InquirerQueryStatusNotification($this->query));
        $user->notify(new QueryStatusNotification($this->query));
    }
}
