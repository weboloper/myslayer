<?php

namespace App\Blog\Routes;

class NewsfeedRoutes extends RouteGroup
{
    public function initialize()
    {
        $this->setPaths([
            'controller' => 'Newsfeed',
        ]);

        $this->setPrefix('/newsfeed');

        $this->addGet('', [
            'action' => 'index',
        ]);
    }
}
