<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\NewsAggregatorService; // Ensure this matches your Service namespace

class FetchNews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'news:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch latest news from external APIs';

    /**
     * Execute the console command.
     */
    public function handle(NewsAggregatorService $aggregator)
    {
        $this->info('Starting news aggregation...');
        
        try {
            $aggregator->run();
            $this->info('News aggregation completed successfully.');
        } catch (\Exception $e) {
            $this->error('An error occurred: ' . $e->getMessage());
            // It's good practice to log the full trace for debugging
            \Log::error($e); 
        }
    }
}