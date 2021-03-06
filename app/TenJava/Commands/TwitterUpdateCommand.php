<?php
namespace TenJava\Commands;

use Cache;
use Illuminate\Console\Command;
use Thujohn\Twitter\Twitter;

class TwitterUpdateCommand extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'tenjava:twitter';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Grabs the latest tweets from the tenjava twitter account!';

    /**
     * Create a new command instance.
     *
     * @return \TenJava\Commands\TwitterUpdateCommand
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire() {
        $twitter = new Twitter();
        $twitter = $twitter->getUserTimeline(array('screen_name' => 'tenjava', 'count' => 42, 'format' => 'array', 'exclude_replies' => true, 'include_rts' => false));
        Cache::forever("tweets", array_slice($twitter, 0, 5));
        $this->info("Successfully fetched tweets!");
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments() {
        return array();
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions() {
        return array();
    }

}
