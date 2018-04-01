<?php

namespace Tests\App\Unit\Filters;

use Tests\TestCase;
use App\Filters\PublicationFilter;
use App\Dumps\DumpsFactories\DumpFactory;
use Tests\DatabaseRefreshTable;

class PublicationFilterTest extends TestCase
{
    use DatabaseRefreshTable;

    /**
     * The filters for publications
     * @var PublicationFilter
     */
    private $publicationFilter;

    /**
     * A set of stored publications
     * @var array
     */
    private $publications;

    public function setUp()
    {
        parent::setUp();

        $this->publicationFilter = $this->container->get('App\Filters\PublicationFilter');

        $publicationDump = $this->container->get('App\Dumps\PublicationDump');
        $dumpFactory = $this->container->get('DumpFactory');

        $this->publications = $dumpFactory->produce($publicationDump, 5);
    }

    public function testFilterByTitleShouldNotReturnEmptySet()
    {
        $someRandomTitle = $this->publications[rand(0, 4)]->getTitle();

        $filters = ['title' => $someRandomTitle];

        $results = $this->publicationFilter
            ->setFilters($filters)
            ->filterByTitle()
            ->get();

        $this->assertGreaterThan(0, count($results));
    }
}