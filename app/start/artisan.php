<?php

/*
|--------------------------------------------------------------------------
| Register The Artisan Commands
|--------------------------------------------------------------------------
|
| Each available Artisan command must be registered with the console so
| that it is available to be called. We'll register every command so
| the console gets access to each of the command object instances.
|
*/

use TenJava\Commands\MailReminderCommand;
use TenJava\Commands\MailTestCommand;
use TenJava\Commands\RepoCleanupCommand;
use TenJava\Commands\TwitterUpdateCommand;
use TenJava\Commands\UserDeleteCommand;
use TenJava\Commands\UserIdMigrateCommand;

Artisan::add(new MailTestCommand());
Artisan::add(new RepoCleanupCommand());
Artisan::add(new TwitterUpdateCommand());
Artisan::add(new UserIdMigrateCommand());
Artisan::add(new UserDeleteCommand());
Artisan::add(new MailReminderCommand());
