<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TournamentMembershipsFixture
 */
class TournamentMembershipsFixture extends TestFixture
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
                'tournament_id' => 1,
                'user_id' => 1,
                'nick' => 'Lorem ipsum dolor sit amet',
                'created' => '2024-03-05 15:52:24',
                'modified' => '2024-03-05 15:52:24',
            ],
        ];
        parent::init();
    }
}
