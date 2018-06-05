<?php

namespace Tests\App\Integration\Controllers\ApplicationsController;

use Tests\TestCase;
use App\Dumps\ApplicationDump;
use App\Services\Player;
use App\Application;
use Tests\DatabaseRefreshTable;
use App\Dumps\UserDump;

class AppDeleteControllerTest extends TestCase
{
    use DatabaseRefreshTable;

    /**
     * @var ApplicationDump
     */
    private $applicationDump;

    /**
     * @var UserDump
     */
    private $userDump;

    public function setUp()
    {
        parent::setUp();

        $this->applicationDump = $this->container->get(ApplicationDump::class);
        $this->userDump = $this->container->get(UserDump::class);
    }

    public function testShouldReturnHttpOkForDeleteApp()
    {
        $application = $this->applicationDump->create();

        Player::setPlayer($application->getAppOwner());

        $response = $this->delete(Application::PREFIX . "/users/apps/{$application->getSlug()}");

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testShouldReturnHttpForbiddenForDeleteApp()
    {
        $application = $this->applicationDump->create();
        $user = $this->userDump->create();

        Player::setPlayer($user);

        $response = $this->delete(Application::PREFIX . "/users/apps/{$application->getSlug()}");

        $this->assertEquals(403, $response->getStatusCode());
    }
}