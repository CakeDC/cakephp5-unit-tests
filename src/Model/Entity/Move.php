<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Move Entity
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $game_id
 * @property string|null $player_move
 * @property string|null $computer_move
 * @property bool|null $is_player_winner
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Game $game
 */
class Move extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'user_id' => true,
        'game_id' => true,
        'player_move' => true,
        'computer_move' => true,
        'is_player_winner' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'game' => true,
    ];

    protected function _getWinner()
    {
        if ($this['is_player_winner'] === null) {
            return __('Tie');
        }

        return $this['is_player_winner'] ? __('Player') : __('Computer');
    }
}
