<?php
namespace TenJava\ServiceProvider;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Factory as ViewFactory;
use TenJava\Exceptions\FailedOauthException;
use TenJava\Exceptions\UnauthorizedException;

class TenJava extends ServiceProvider {

    protected $view;

    public function __construct(ViewFactory $view) {
        $this->view = $view;
    }

    /**
     * Register the TenJava IoC bindings.
     *
     * @return void
     */
    public function register() {
        $app = $this->app;
        $app->bind("AuthProviderInterface", "GitHubAuthProvider");
        $app->bind("EmailOptOutInterface", "GitHubEmailOptOut");
        $app->bind("TenJava\\Security\\HmacVerificationInterface", "TenJava\\Security\\HmacVerification");

        $app->singleton('GlobalComposer', 'TenJava\Composers\GlobalComposer');

        $app->missing(function ($exception) use ($app) {
            return $app->make("ErrorController")->missing();
        });

        $app->error(function (UnauthorizedException $exception) use ($app) {
            return $app->make('ErrorController')->unauthorized();
        });

        $app->error(function (FailedOauthException $exception) use ($app) {
            return $app->make('ErrorController')->oauth();
        });

        $app->down(function () {
            return Response::make("Be right back!", 503);
        });

        $this->view->composer('*', 'GlobalComposer');
    }
}