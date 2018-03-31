<?php

use App\Middlewares\LoggedUser;
use App\RequestValidators\Login;
use App\RequestValidators\UserRegistration;

$app->group('/app', function () {
    $this->post('/login', 'App\Controllers\LoginController:login')->add(new Login());

    $this->group('', function () {
        $this->get('', function ($request, $response) {
            return $response->write('You opened the gate');
        });

        $this->group('/users', function () {
            $this->post('', 'App\Controllers\UsersController:store')->add(new UserRegistration());
            $this->put('/{user_id}', 'App\Controllers\UsersController:update');
            $this->get('/username-availaibility/{username}', 'App\Controllers\UsersController:usernameAvailaibility');
        });

        $this->group('/applications', function () {
            $this->get('/user', 'App\Controllers\ApplicationsController:userApps');
            $this->post('', 'App\Controllers\ApplicationsController:store');
            $this->put('/{app_id}', 'App\Controllers\ApplicationsController:update');
            $this->delete('/{app_id}', 'App\Controllers\ApplicationsController:destroy');
        });

        $this->group('/publications', function () {
            $this->post('', 'App\Controllers\PublicationsController:store');
            $this->put('/{publication_id}', 'App\Controllers\PublicationsController:update');
            $this->delete('/{publication_id}', 'App\Controllers\PublicationsController:destroy');
        });
        
    })->add(new LoggedUser($this->getContainer()->get('UserSession'), $this->getContainer()->get('Player')));
});