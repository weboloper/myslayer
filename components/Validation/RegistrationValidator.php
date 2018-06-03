<?php

namespace Components\Validation;

use Phalcon\Version;
use Components\Model\Users;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Uniqueness;
use Phalcon\Validation\Validator\Confirmation;

class RegistrationValidator extends Validation
{
    public function initialize()
    {
        $this->add('email', new PresenceOf([
            'message' => 'Email is required',
        ]));

        $this->add('email', new Email([
            'message' => 'Email is not valid',
        ]));

        $this->add('email', new Uniqueness([
            'model' => (int) Version::getId() <= 2001341 ? Users::class : new Users,
            'message' => 'Email already exist',
        ]));

        $this->add('password', new PresenceOf([
            'message' => 'Password is required',
        ]));

        $this->add('password', new Confirmation([
            'with' => 'repassword',
            'message' => 'Password and Repeat Password must match',
        ]));

        $this->add('repassword', new PresenceOf([
            'message' => 'Repeat Password is required',
        ]));
    }
}
