<?php

namespace App\Users\Routes;

class UsersRoutes extends RouteGroup
{
    public function initialize()
    {
        $this->setPaths([
            'controller' => 'Users',
        ]);

        $this->setPrefix('/users');

        $this->addGet('/login/:params', [
            'action' => 'showLoginForm',
            'params' => 1,
        ])->setName('showLoginForm');

        $this->addPost('/attempt', [
            'action' => 'attemptToLogin',
        ])->setName('attemptToLogin');

        $this->addGet('/logout', [
            'action' => 'logout',
        ])->setName('logout');

        $this->addGet('/register', [
            'action' => 'showRegistrationForm',
        ])->setName('showRegistrationForm');

        $this->addPost('/register/store', [
            'action' => 'storeRegistrationForm',
        ])->setName('storeRegistrationForm');

        $this->addGet('/activation/{token}', [
            'action' => 'activateUser',
        ])->setName('activateUser');

        $this->add('/forget-password', [
            'action' => 'showForgetPasswordForm',
        ])->setName('showForgetPasswordForm');

        $this->add('/reset-password/{token}', [
            'action' => 'showResetPasswordForm',
        ])->setName('showResetPasswordForm');

        $this->add('/change-password', [
            'action' => 'showChangePasswordForm',
        ])->setName('showChangePasswordForm');

        // facebook
        $this->add('/facebook/access_token', [
            'action'     => 'tokenFacebook'
        ]);

        $this->addGet('/login/facebook',   [
            'action'     => 'loginFacebook'
        ])
        ->setName('loginFacebook');

    }
}
