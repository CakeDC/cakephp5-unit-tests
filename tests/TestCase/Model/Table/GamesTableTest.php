<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Entity\Game;
use App\Model\Table\GamesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\GamesTable Test Case
 */
class GamesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\GamesTable
     */
    protected $GamesTable;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.Games',
        'app.Users',
        'app.Moves',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Games') ? [] : ['className' => GamesTable::class];
        $this->GamesTable = $this->getTableLocator()->get('Games', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->GamesTable);

        parent::tearDown();
    }

    /**
     * Test current method
     *
     * @return void
     * @uses \App\Model\Table\GamesTable::current()
     */
    public function testCurrentShouldReturnAGame(): void
    {
        $game = $this->GamesTable->current(1);
        $this->assertInstanceOf(Game::class, $game);
        $this->assertSame(10, $game->id);
        $this->assertCount(0, $game->moves);
    }

    public function testCurrentShouldReturnNull(): void
    {
        $game = $this->GamesTable->current(2);
        $this->assertNull($game);
    }
}
