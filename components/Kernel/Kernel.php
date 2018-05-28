<?php

namespace Components\Kernel;

use Clarity\Kernel\Kernel as BaseKernel;
use Phalcon\Di\Service;


class Kernel extends BaseKernel
{


	public function loadExternalServices()
	{
		

		/** @noinspection PhpIncludeInspection */
        $services = require config_path('modelservices.php');

         if (is_array($services)) {
            $this->initializeServices($services);
        }
        return $this;

	}

	protected function initializeServices(array $services)
    {
        foreach ($services as $abstract => $concrete) {
            $service = new Service($abstract, $concrete, true);
            di()->setRaw($abstract, $service);

            $this->services[$abstract] = $service;
        }

        return $this;
    }

}