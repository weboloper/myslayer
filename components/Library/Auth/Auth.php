<?php

/**
 * PhalconSlayer\Framework.
 *
 * @copyright 2015-2016 Daison Carino <daison12006013@gmail.com>
 * @license   http://www.opensource.org/licenses/mit-license.php MIT
 * @link      http://docs.phalconslayer.com
 */

namespace Components\Library\Auth;

use Clarity\Support\Auth\Auth as BaseAuth;

use InvalidArgumentException;
use Phalcon\DiInterface;
use Phalcon\Di\InjectionAwareInterface;
use Components\Model\Services\Service\User;
/**
 * Authentication handler.
 */
class Auth extends BaseAuth
{
    /**
     * @var \Phalcon\DiInterface
     */
    protected $_di;


    public function __construct()
    {   
        // parent::__construct();
        $this->userService = new User;
    }

     
    public function isAuthorizedVisitor()
    {
        return $this->check();
    }
    
    public function getUserId()
    {
        if (!$this->isAuthorizedVisitor()) {
            return null;
        }

        return (int)$this->user()->id;
 
    }


}   
