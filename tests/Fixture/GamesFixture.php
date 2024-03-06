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
                'created' => '2024-03-05 15:52:24',
                'modified' => '2024-03-05 15:52:24',
                'best_of' => 1,
                'user_id' => 1,
                'is_player_winner' => 1,
                'tournament_id' => 1,
            ],
        ];
        parent::init();
    }
}
