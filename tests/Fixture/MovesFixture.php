<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * MovesFixture
 */
class MovesFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'user_id' => 1,
                'game_id' => 1,
                'player_move' => 'P',
                'computer_move' => 'K',
                'is_player_winner' => true,
                'created' => '2024-03-06 12:13:22',
                'modified' => '2024-03-06 12:13:22',
            ],
            [
                'id' => 2,
                'user_id' => 1,
                'game_id' => 1,
                'player_move' => 'S',
                'computer_move' => 'L',
                'is_player_winner' => true,
                'created' => '2024-03-06 12:13:22',
                'modified' => '2024-03-06 12:13:22',
            ],
            [
                'id' => 3,
                'user_id' => 1,
                'game_id' => 2,
                'player_move' => 'R',
                'computer_move' => 'R',
                'is_player_winner' => null,
                'created' => '2024-03-06 12:13:26',
                'modified' => '2024-03-06 12:13:26',
            ],
            [
                'id' => 4,
                'user_id' => 1,
                'game_id' => 2,
                'player_move' => 'P',
                'computer_move' => 'K',
                'is_player_winner' => true,
                'created' => '2024-03-06 12:13:27',
                'modified' => '2024-03-06 12:13:27',
            ],
            [
                'id' => 5,
                'user_id' => 1,
                'game_id' => 2,
                'player_move' => 'S',
                'computer_move' => 'P',
                'is_player_winner' => true,
                'created' => '2024-03-06 12:13:28',
                'modified' => '2024-03-06 12:13:28',
            ],
        ];
        parent::init();
    }
}
