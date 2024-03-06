<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Game Entity
 *
 * @property int $id
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 * @property int $best_of
 * @property int $user_id
 * @property bool|null $is_player_winner
 * @property int|null $tournament_id
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Tournament $tournament
 * @property \App\Model\Entity\Move[] $moves
 */
class Game extends Entity
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
        'created' => true,
        'modified' => true,
        'best_of' => true,
        'user_id' => true,
        'is_player_winner' => true,
        'tournament_id' => true,
        'user' => true,
        'tournament' => true,
        'moves' => true,
    ];
}
