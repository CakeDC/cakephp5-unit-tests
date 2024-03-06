<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * GamesFixture
 */
class GamesFixture extends TestFixture
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
                'created' => '2024-03-06 12:13:21',
                'modified' => '2024-03-06 12:13:22',
                'best_of' => 3,
                'user_id' => 1,
                'is_player_winner' => true,
                'tournament_id' => null,
            ],
            [
                'id' => 2,
                'created' => '2024-03-06 12:13:25',
                'modified' => '2024-03-06 12:13:28',
                'best_of' => 2,
                'user_id' => 1,
                'is_player_winner' => true,
                'tournament_id' => null,
            ],
        ];
        parent::init();
    }
}
