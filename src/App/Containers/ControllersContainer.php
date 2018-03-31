<?php

namespace App\Containers;

use Slim\Container;
use App\Controllers\LoginController;
use App\Controllers\UsersController;
use App\Controllers\ApplicationsController;
use App\Controllers\PublicationsController;

class ControllersContainer
{
    public function register(Container $container, array $config)
    {
        $container['App\Controllers\LoginController'] = function ($c) {
            return new LoginController($c->get('UserRepository'), $c->get('UserSession'));
        };

        $container['App\Controllers\UsersController'] = function ($c) {
            return new UsersController($c->get('UserRepository'));
        };

        $container['App\Controllers\ApplicationsController'] = function ($c) {
            return new ApplicationsController($c->get('ApplicationRepository'));
        };

        $container['App\Controllers\PublicationsController'] = function ($c) {
            return new PublicationsController($c->get('PublicationRepository'));
        };
    }
}