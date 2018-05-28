<?php

namespace App\Blog\Controllers;

use Components\Model\Users;

class WelcomeController extends Controller
{
    /**
     * GET | This shows the slayer's introduction.
     *
     * @return mixed
     */
    public function showSignature()
    {
        return view('welcome');
    }

    /**
     * GET | Redirect the user if the 'users' table is empty or not
     * then redirect it to either login or registration.
     *
     * @return mixed
     */
    public function trySampleForms()
    {
        if (Users::count()) {
            return redirect()
                ->to(
                    route('showLoginForm')
                )
                ->withInfo(
                    lang()->get('responses/login.pre_flash_message')
                );
        }

        return redirect()
            ->to(
                route('showRegistrationForm')
            )
            ->withInfo(
                lang()->get('responses/register.pre_flash_message')
            );
    }
}
