<?php

namespace App\Console\Commands;

use App\Frontpage;
use App\NewsSource;
use Illuminate\Console\Command;
use Monolog\Logger;

class UpdateFrontpages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'frontpage:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates frontpage images';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Updating frontpages');

        $newsSources = NewsSource::all();

        $bar = $this->output->createProgressBar(count($newsSources));

        foreach ($newsSources as $newsSource) {
            // check if the image has been updated in the last hour
            if (!$newsSource->wasUpdatedInTheLastHour()) {
                $this->updateImage($newsSource);
            }

            $bar->advance();
        }

        $bar->finish();
    }

    private function updateImage(NewsSource $newsSource)
    {
        $frontpage = $newsSource->frontpage;

        $result = $frontpage->updateImage();
    }
}
