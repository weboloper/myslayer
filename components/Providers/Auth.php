<?php

/**
 * PhalconSlayer\Framework.
 * Clarity\Providers\Auth copied
 */

namespace Components\Providers;

use Components\Library\Auth\Auth as BaseAuth;

/**
 * This provider handles the general authentication.
 */
class Auth extends ServiceProvider
{
    /**
     * {@inheridoc}.
     */
    protected $alias = 'auth';

    /**
     * {@inheridoc}.
     */
    protected $shared = true;

    /**
     * {@inheridoc}.
     */
    public function register()
    {
        return new BaseAuth;
    }
}
