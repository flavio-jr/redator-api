<?php

namespace App\Containers;

use Slim\Container;
use App\Controllers\LoginController;
use App\Controllers\UsersController;
use App\Controllers\ApplicationsController;
use App\Controllers\PublicationsController;
use App\Controllers\CategoriesController;

class ControllersContainer
{
    public function register(Container $container, array $config)
    {
        $container['App\Controllers\LoginController'] = function ($c) {
            return new LoginController($c->get('UserRepository'), $c->get('UserSession'));
        };

        $container['App\Controllers\UsersController'] = function ($c) {
            $userRepository = $c->get('UserRepository');
            $templateEngine = $c->get('TwigEngine');
            $mailer = $c->get('HTMLMailer');
 
            return new UsersController($userRepository, $templateEngine, $mailer);
        };

        $container['App\Controllers\ApplicationsController'] = function ($c) {
            return new ApplicationsController($c->get('ApplicationRepository'));
        };

        $container['App\Controllers\PublicationsController'] = function ($c) {
            return new PublicationsController($c->get('PublicationRepository'), $c->get('App\Filters\PublicationFilter'));
        };

        $container['App\Controllers\CategoriesController'] = function ($c) {
            return new CategoriesController($c->get('CategoryRepository'));
        };
    }
}