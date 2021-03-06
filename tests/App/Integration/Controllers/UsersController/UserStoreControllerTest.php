<?php

namespace Tests\App\Integration\Controllers\UsersController;

use Tests\TestCase;
use Tests\DatabaseRefreshTable;
use App\Dumps\UserDump;
use App\Application;

class UserStoreControllerTest extends TestCase
{
    use DatabaseRefreshTable;

    /**
     * @var UserDump
     */
    private $userDump;

    public function setUp()
    {
        parent::setUp();

        $this->userDump = $this->container->get(UserDump::class);
    }

    public function testMustReturnHttpOkForStoreUser()
    {
        $pass = 'buzz';

        $data = $this->userDump->make(['password' => $pass])->toArray();
        $data['password'] = $pass;

        $response = $this->post(Application::PREFIX . '/users', $data);

        $this->assertEquals(200, $response->getStatusCode());
    }
}