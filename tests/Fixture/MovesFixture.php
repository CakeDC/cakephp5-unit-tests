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
                'player_move' => '',
                'computer_move' => '',
                'is_player_winner' => 1,
                'created' => '2024-03-05 15:52:24',
                'modified' => '2024-03-05 15:52:24',
            ],
        ];
        parent::init();
    }
}
