<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TournamentsFixture
 */
class TournamentsFixture extends TestFixture
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
                'name' => 'Lorem ipsum dolor sit amet',
                'expiration_date' => '2024-03-05 15:52:24',
                'created' => '2024-03-05 15:52:24',
                'modified' => '2024-03-05 15:52:24',
                'slug' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
