<?php

namespace Components\Model\Services\Service;

use DateTime;
use DateTimeZone;
use Components\Model\Users;

class User extends \Components\Model\Services\Service
{
	
     /**
     * @var Users
     */
    protected $viewer;

    /**
     * Gets role names for current viewer.
     *
     * @return string[]
     */
    public function getRoleNamesForCurrentViewer()
    {
        $entity = $this->getCurrentViewer();
        if ($entity->getId() == 0 || $entity->countRoles() == 0) {
            return [Role::GUEST_SYSTEM_ROLE];
        }
        return array_column($entity->getRoles(['columns' => ['name']])->toArray(), 'name');
    }

    /**
     * Gets current viewer.
     *
     * @return Users
     */
    public function getCurrentViewer()
    {
        if ($this->viewer) {
            return $this->viewer;
        }
         
        $entity = null;
        if ($this->auth->isAuthorizedVisitor()) {
            $entity = $this->findFirstById($this->auth->getUserId());
        }
        if (!$entity) {
            $entity = $this->createDefaultViewer();
        }
        $this->viewer = $entity;
        return $entity;
    }

    /**
     * Sets current viewer.
     *
     * @param Users $entity
     */
    public function setCurrentViewer(Users $entity)
    {
        $this->viewer = $entity;
    }

    protected function createDefaultViewer()
    {
        $entity = new Users(['id' => 0 ]);
        return $entity;
    }


	 /**
     * Checks whether the User is Admin.
     *
     * @return bool
     */
    public function isAdmin()
    {
        return in_array(Role::ADMIN_SYSTEM_ROLE, $this->getRoleNamesForCurrentViewer());
    }
    /**
     * Checks whether the User is moderator.
     *
     * @return bool
     */
    public function isModerator()
    {
        return in_array(Role::MODERATOR_SYSTEM_ROLE, $this->getRoleNamesForCurrentViewer());
    }




    /**
     * Finds User by ID.
     *
     * @param  int $id The User ID.
     * @return Users|null
     */
    public function findFirstById($id)
    {
        return Users::findFirstById($id) ?: null;
    }
    /**
     * Get User by ID.
     *
     * @param  int $id The User ID.
     * @return Users
     *
     * @throws Exceptions\EntityNotFoundException
     */
    public function getFirstById($id)
    {
        if (!$user = $this->findFirstById($id)) {
            throw new Exceptions\EntityNotFoundException($id);
        }
        return $user;
    }


}
