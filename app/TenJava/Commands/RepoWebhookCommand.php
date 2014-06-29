<?php
namespace TenJava\Commands;

use Config;
use Github\Api\Repository\Hooks;
use Illuminate\Console\Command;
use TenJava\Models\Application;

class RepoWebhookCommand extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'tenjava:repohooks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Adds webhooks to repos.';

    /**
     * Create a new command instance.
     *
     * @return \TenJava\Commands\RepoWebhookCommand
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
        $list = Application::with('timeEntry')->has("timeEntry", ">", "0")->where('judge', false)->get();
        $this->comment("List has " . $list->count() . " items");
        $hooks = $this->getApiClient()->hooks();
        foreach ($list as $entry) {
            /** @var \TenJava\Models\Application $entry */
            $this->handleEntry($entry, $hooks);

        }
    }

    private function handleEntry(Application $app, Hooks $hooks) {
        $times = $app->timeEntry;
        $possibleValues = ['t1','t2','t3'];
        foreach ($possibleValues as $toCheck) {
            $this->comment("Checking " . $toCheck . " for " . $app->gh_username);
            if ($times->$toCheck) {
                $this->info("Hit! " . $toCheck);
                $repoName = $app->gh_username . "-" . $toCheck;
                $this->info("Creating webhook for " . $repoName . " with data " . json_encode($this->getHookData()));
                $hooks->create("tenjava", $repoName, $this->getHookData());
            }
        }
    }

    private function getHookData() {
        $dataArray = ['name' => 'web',
                      'events' => [
                          'push',
                          'pull_request'],
                      'active' => true];
        $dataArray['config'] = [
            'url' => url('/webhook/fire'),
            'content_type' => 'json',
            'secret' => Config::get("webhooks.secret")
        ];
        return $dataArray;
    }

    /**
     * @return \Github\Api\Repo
     */
    private function getApiClient() {
        $client = new \Github\Client();
        $client->authenticate("tenjava", Config::get("gh-data.pass"), \Github\Client::AUTH_HTTP_PASSWORD);
        return $client->api('repo');
    }

}