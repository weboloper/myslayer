<?php

namespace Components\Validation;

use Phalcon\Version;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Confirmation;

class ChangepassValidator extends Validation
{
    public function initialize()
    {
    	$this->add('oldpassword', new PresenceOf([
            'message' => 'Password is required',
        ]));


        $this->add('password', new PresenceOf([
            'message' => 'New Password is required',
        ]));

        $this->add('password', new Confirmation([
            'with' => 'repassword',
            'message' => 'New Password and Repeat Password must match',
        ]));

        $this->add('repassword', new PresenceOf([
            'message' => 'Repeat New Password is required',
        ]));
    }
}