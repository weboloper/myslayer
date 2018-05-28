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
        parent::__construct();
        $this->userService = new User;
    }

     
     /**
     * Checking user is have permission admin
     *
     * @return boolean
     */
    public function isAdmin()
    {
        if (!$this->isAuthorizedVisitor()) {
            return false;
        }
        return $this->userService->isAdmin();
    }

    /**
     * @return bool
     */
    public function isModerator()
    {
        if (!$this->isAuthorizedVisitor()) {
            return false;
        }
        return $this->userService->isModerator();
    }

    /**
     * Check whether the user is authorized.
     *
     * @return bool
     */
    public function isAuthorizedVisitor()
    {
        return $this->check();
    }

     /**
      * Checking user is have permission admin
      *
      * @return boolean
      */
    public function isTrustModeration()
    {
        return $this->isAdmin() || $this->isModerator();
    }


    /**
     * Returns the current user id
     *
     * @return int|null
     */
    public function getUserId()
    {
        if (!$this->isAuthorizedVisitor()) {
            return null;
        }

        return (int)$this->user()->id;
 
    }



}   
