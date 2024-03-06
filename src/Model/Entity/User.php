<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property string $email
 * @property string|null $password
 * @property bool|null $is_active
 * @property string|null $first_name
 * @property string|null $last_name
 * @property bool|null $is_superuser
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 * @property int $games_count
 *
 * @property \App\Model\Entity\Game[] $games
 * @property \App\Model\Entity\Move[] $moves
 * @property \App\Model\Entity\TournamentMembership[] $tournament_memberships
 */
class User extends Entity
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
        'email' => true,
        'password' => true,
        'is_active' => true,
        'first_name' => true,
        'last_name' => true,
        'is_superuser' => true,
        'created' => true,
        'modified' => true,
        'games_count' => true,
        'games' => true,
        'moves' => true,
        'tournament_memberships' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array<string>
     */
    protected array $_hidden = [
        'password',
    ];

    protected function _setPassword($password)
    {
        if (strlen($password) > 0) {
            return (new DefaultPasswordHasher())->hash($password);
        }
    }
}
