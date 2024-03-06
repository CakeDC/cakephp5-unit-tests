<?php
declare(strict_types=1);

namespace App\View\Cell;

use Cake\View\Cell;

/**
 * Stats cell
 */
class StatsCell extends Cell
{
    /**
     * List of valid options that can be passed into this
     * cell's constructor.
     *
     * @var array
     */
    protected array $_validCellOptions = [];

    /**
     * Default display method.
     *
     * @param $user
     * @return void
     */
    public function display($user)
    {
        $Games = $this->fetchTable('Games');
        $won = 0;
        $lost = 0;
        if ($user) {
            $won = $Games->find('owner', userId: $user['id'])
                ->find('won')
                ->count();
            $lost = $Games->find('owner', userId: $user['id'])
                ->find('lost')
                ->count();
        }
        $this->set(compact('won', 'lost', 'user'));
    }
}
