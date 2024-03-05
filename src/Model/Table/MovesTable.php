<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Moves Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\GamesTable&\Cake\ORM\Association\BelongsTo $Games
 * @method \App\Model\Entity\Move newEmptyEntity()
 * @method \App\Model\Entity\Move newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Move> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Move get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Move findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Move patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Move> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Move|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Move saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Move>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Move>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Move>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Move> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Move>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Move>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Move>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Move> deleteManyOrFail(iterable $entities, array $options = [])
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MovesTable extends Table
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

        $this->setTable('moves');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
        ]);
        $this->belongsTo('Games', [
            'foreignKey' => 'game_id',
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
            ->integer('user_id')
            ->allowEmptyString('user_id');

        $validator
            ->integer('game_id')
            ->allowEmptyString('game_id');

        $validator
            ->scalar('player_move')
            ->maxLength('player_move', 1)
            ->allowEmptyString('player_move');

        $validator
            ->scalar('computer_move')
            ->maxLength('computer_move', 1)
            ->allowEmptyString('computer_move');

        $validator
            ->boolean('is_player_winner')
            ->allowEmptyString('is_player_winner');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'), ['errorField' => 'user_id']);
        $rules->add($rules->existsIn(['game_id'], 'Games'), ['errorField' => 'game_id']);

        return $rules;
    }
}
