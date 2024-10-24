<?php

namespace App\Console\Commands;

use App\Http\Controllers\NewsController;
use Illuminate\Console\Command;

class FetchAndSaveNews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-and-save-news';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch the news data from API and save it to the database';

    /**
     * Execute the console command.
     */
    public function handle(NewsController $newsController): void
    {
        $newsData = $newsController->fetchData();
        foreach ($newsData as $data) {
            $newsController->saveData($data);
        }
    }
}
