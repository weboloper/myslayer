<?php

/**
 * PhalconSlayer\Framework.
 *
 * @copyright 2015-2016 Daison Carino <daison12006013@gmail.com>
 * @license   http://www.opensource.org/licenses/mit-license.php MIT
 * @link      http://docs.phalconslayer.com
 */

namespace Components\Library\Volt;

use Clarity\View\Volt\VoltAdapter as BaseVoltAdapter;

use Phalcon\DiInterface;
use Phalcon\Mvc\View\Engine\Volt;
use Phalcon\Mvc\ViewBaseInterface;
 
class VoltAdapter extends BaseVoltAdapter
{

	public function __construct(
        ViewBaseInterface $view,
        DiInterface $di = null
    ) {
        parent::__construct($view, $di);

        parent::getCompiler()->addExtension(new VoltFunctions());
    }
}