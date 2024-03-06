<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsersFixture
 */
class UsersFixture extends TestFixture
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
                'email' => 'a@example.com',
                'password' => '$2y$10$bAklMaju0L01CA7IZZAbbO5k/olpIkmiXztk2Gmn0dEp31YTntQg6',
                'is_active' => true,
                'first_name' => 'a',
                'last_name' => 'a',
                'is_superuser' => false,
                'created' => '2024-03-06 12:13:05',
                'modified' => '2024-03-06 12:13:05',
                'games_count' => 0,
            ],
        ];
        parent::init();
    }
}
