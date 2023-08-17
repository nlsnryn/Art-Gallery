<?php

namespace App\Console\Commands;

use App\Models\Artwork;
use App\Models\Query;
use Illuminate\Console\Command;

class UpdateArtworkSold extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-artwork-sold';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the sold count for artworks';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //Get Query sold for today
        $queries_sold_today = Query::whereDate('status_changed_at', now()->toDateString())
            ->where('status', 'approved')
            ->get();

        // Update the sold count for each artwork
        foreach ($queries_sold_today as $query)
        {
            $query->artwork->sold += 1;
            $query->artwork->save();
        }
    }
}
