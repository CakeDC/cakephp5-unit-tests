<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Tournament Entity
 *
 * @property int $id
 * @property string $name
 * @property \Cake\I18n\DateTime|null $expiration_date
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 * @property string $slug
 *
 * @property \App\Model\Entity\Game[] $games
 * @property \App\Model\Entity\TournamentMembership[] $tournament_memberships
 */
class Tournament extends Entity
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
        'name' => true,
        'expiration_date' => true,
        'created' => true,
        'modified' => true,
        'slug' => true,
        'games' => true,
        'tournament_memberships' => true,
    ];

    protected function _setName($name)
    {
        $this['slug'] = Text::slug(strtolower($name));

        return $name;
    }
}
