<?php
namespace TenJava\Commands;

use Illuminate\Console\Command;
use Illuminate\Mail\Message;
use Mail;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use TenJava\Models\Subscription;

class MailNewsCommand extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'tenjava:mailnews';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send the given email template to subscribed users.';

    /**
     * Create a new command instance.
     *
     * @return \TenJava\Commands\MailNewsCommand
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
        $template = $this->argument('template');
        $test = $this->option('test');
        $recipients = $test ? [Subscription::where('gh_username', 'jkcclemens')->first()] : Subscription::all();
        $subject = $this->option('subject') ? $this->option('subject') : 'ten.java Update';
        if (!$this->confirm('Send template ' . $template . ' (test: ' . ($test ? 'yes' : 'no') . ') to ' . count($recipients) . ' people with the subject "' . $subject . '"?', false)) {
            return;
        };
        foreach ($recipients as $recipient) {
            $this->info("Sending to " . $recipient->email . ".");
            $data = [
                'name' => $recipient->gh_username,
                'id' => $recipient->gh_id,
                'email' => $recipient->email
            ];
            Mail::send($template, $data, function (Message $message) use ($recipient, $subject) {
                $message->to($recipient->email, $recipient->gh_username)->subject($subject);
            });
        }
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments() {
        return array(
            ['template', InputArgument::REQUIRED, 'Template to send']
        );
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions() {
        return array(
            ['test', null, InputOption::VALUE_NONE, 'Send the email to jkcclemens instead'],
            ['subject', null, InputOption::VALUE_REQUIRED, 'Subject of the email']
        );
    }

}