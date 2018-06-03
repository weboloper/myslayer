<?php

namespace App\Blog\Controllers;

use Clarity\Support\Phalcon\Mvc\Controller as BaseController;

class Controller extends BaseController
{

	public function onConstruct()
    {
        $this->view->setVars([
            'auth'          => auth()->user() 
        ]);
    }


}
