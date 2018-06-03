<?php

/**
 * PhalconSlayer\Framework.
 * Clarity\Providers\Auth copied
 */

namespace Components\Providers;

use Components\Library\Volt\VoltAdapter;

class View extends ServiceProvider
{	
	/**
     * {@inheridoc}.
     */
    protected $alias = 'view';

	public function register()
    {
       di()->get('view')->registerEngines([
            // '.phtml'     => Php::class,
            '.volt'      => VoltAdapter::class,
            // '.blade.php' => BladeAdapter::class,
        ]);
    }
}