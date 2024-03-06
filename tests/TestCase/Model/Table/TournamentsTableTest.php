<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TournamentsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TournamentsTable Test Case
 */
class TournamentsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TournamentsTable
     */
    protected $Tournaments;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.Tournaments',
        'app.Games',
        'app.TournamentMemberships',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Tournaments') ? [] : ['className' => TournamentsTable::class];
        $this->Tournaments = $this->getTableLocator()->get('Tournaments', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Tournaments);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\TournamentsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
