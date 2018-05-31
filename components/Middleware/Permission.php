<?php

namespace Components\Middleware;
use Phalcon\DispatcherInterface;
use Components\Library\Acl\Manager;


class Permission implements \League\Tactician\Middleware
{   
    public function execute($request, callable $next)
    {   
        
        $userService = di()->getShared(\Components\Model\Services\Service\User::class);
        $roles = $userService->getRoleNamesForCurrentViewer();

        if (Acl()->isAllowed($roles, Manager::ADMIN_AREA, 'access') === false) {
            flash()->session()->error('You don\'t have permission to access this page.');

            redirect(

                url(
                    'users/login'
                )
            );
        }

        return $next($request);
    }
}
