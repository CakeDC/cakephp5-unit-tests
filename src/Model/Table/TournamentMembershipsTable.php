<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TournamentMemberships Model
 *
 * @property \App\Model\Table\TournamentsTable&\Cake\ORM\Association\BelongsTo $Tournaments
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @method \App\Model\Entity\TournamentMembership newEmptyEntity()
 * @method \App\Model\Entity\TournamentMembership newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\TournamentMembership> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TournamentMembership get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\TournamentMembership findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\TournamentMembership patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\TournamentMembership> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\TournamentMembership|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\TournamentMembership saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\TournamentMembership>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\TournamentMembership>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\TournamentMembership>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\TournamentMembership> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\TournamentMembership>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\TournamentMembership>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\TournamentMembership>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\TournamentMembership> deleteManyOrFail(iterable $entities, array $options = [])
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TournamentMembershipsTable extends Table
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

        $this->setTable('tournament_memberships');
        $this->setDisplayField('nick');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Tournaments', [
            'foreignKey' => 'tournament_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
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
            ->integer('tournament_id')
            ->notEmptyString('tournament_id');

        $validator
            ->integer('user_id')
            ->notEmptyString('user_id');

        $validator
            ->scalar('nick')
            ->maxLength('nick', 255)
            ->requirePresence('nick', 'create')
            ->notEmptyString('nick');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['tournament_id'], 'Tournaments'), ['errorField' => 'tournament_id']);
        $rules->add($rules->existsIn(['user_id'], 'Users'), ['errorField' => 'user_id']);

        return $rules;
    }
}
