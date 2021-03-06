<?php


use TenJava\Authentication\AuthProviderInterface;

class AuthenticationFilter {

    public function __construct(AuthProviderInterface $auth) {
        $this->auth = $auth;
    }

    public function filter() {
        if (!$this->auth->isLoggedIn()) {
            return Redirect::to("/oauth/confirm")->with("previous", Request::url());
        }
    }
} 