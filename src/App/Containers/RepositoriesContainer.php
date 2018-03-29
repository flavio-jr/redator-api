<?php

namespace App\Containers;

use Slim\Container;
use App\Repositories\UserRepository;
use App\Services\Persister;
use App\Repositories\ApplicationRepository;

class RepositoriesContainer
{
    public function register(Container $container, array $config)
    {
        $container['UserRepository'] = function ($c) use ($config) {
            $em = $c->get('doctrine')->getEntityManager();
            return new UserRepository($em, new Persister($em));
        };

        $container['ApplicationRepository'] = function ($c) use ($config) {
            $em = $c->get('doctrine')->getEntityManager();
            return new ApplicationRepository($em, new Persister($em));
        };
    }
}