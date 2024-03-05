<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TournamentMembershipsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TournamentMembershipsTable Test Case
 */
class TournamentMembershipsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TournamentMembershipsTable
     */
    protected $TournamentMemberships;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.TournamentMemberships',
        'app.Tournaments',
        'app.Users',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('TournamentMemberships') ? [] : ['className' => TournamentMembershipsTable::class];
        $this->TournamentMemberships = $this->getTableLocator()->get('TournamentMemberships', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->TournamentMemberships);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\TournamentMembershipsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\TournamentMembershipsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
