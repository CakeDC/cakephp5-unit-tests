<?php
declare(strict_types=1);

namespace App\Test\TestCase\Integration;

use App\Strategy\RockStrategy;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

class PlayTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.Users',
        'app.Games',
        'app.Moves',
    ];

    public function testWinGame()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        Configure::write('ComputerMoveBehavior.StrategyClass', RockStrategy::class);
        // user login happy
        $data = [
            'email' => 'a@example.com',
            'password' => 'password',
        ];
        $this->post('/users/login', $data);
        $this->assertResponseSuccess();
        $this->assertSession('a', 'Auth.first_name');
        $this->assertRedirect('/');
        $this->session($_SESSION);
        // user logged in at this point
        $this->get('/games/play');
        $this->assertResponseContains('Pick Rock');
        // play Spock 1
        $data = [
            'game_id' => 10,
            'player_move' => 'K',
        ];
        $movesTable = TableRegistry::getTableLocator()->get('Moves');
        $movesCount = $movesTable->find()->count();
        $this->post('/moves/player-move', $data);
        $this->assertCount(++$movesCount, $movesTable->find());
        $gamesTable = TableRegistry::getTableLocator()->get('Games');
        $game = $gamesTable->get(10);
        $this->assertNull($game['is_player_winner']);
        // play Spock 2 and win
        $this->post('/moves/player-move', $data);
        $this->assertCount(++$movesCount, $movesTable->find());
        $game = $gamesTable->get(10);
        $this->assertTrue($game['is_player_winner']);
        //read flash from _flashMessages when the view is rendered, if there is a redirect, the flash is not rendered and you get it from the requestSession instead
        $this->assertFlashMessage('You Won the game');
    }
}
