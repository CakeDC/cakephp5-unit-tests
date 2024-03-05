<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Tournaments Model
 *
 * @property \App\Model\Table\GamesTable&\Cake\ORM\Association\HasMany $Games
 * @property \App\Model\Table\TournamentMembershipsTable&\Cake\ORM\Association\HasMany $TournamentMemberships
 * @method \App\Model\Entity\Tournament newEmptyEntity()
 * @method \App\Model\Entity\Tournament newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Tournament> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Tournament get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Tournament findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Tournament patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Tournament> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Tournament|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Tournament saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Tournament>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Tournament>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Tournament>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Tournament> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Tournament>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Tournament>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Tournament>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Tournament> deleteManyOrFail(iterable $entities, array $options = [])
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TournamentsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('tournaments');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Games', [
            'foreignKey' => 'tournament_id',
        ]);
        $this->hasMany('TournamentMemberships', [
            'foreignKey' => 'tournament_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->dateTime('expiration_date')
            ->allowEmptyDateTime('expiration_date');

        $validator
            ->scalar('slug')
            ->maxLength('slug', 255)
            ->requirePresence('slug', 'create')
            ->notEmptyString('slug');

        return $validator;
    }
}
