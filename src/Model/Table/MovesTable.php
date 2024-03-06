<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\Core\Configure;
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
        $this->addBehavior('ComputerMove');

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
            ->integer('id')
            ->allowEmptyString('id', 'create');

        $validMoves = Configure::read('Moves.PlayerMoves');
        $validator
            ->allowEmptyString('player_move')
            ->inList('player_move', $validMoves);

        $validator
            ->allowEmptyString('computer_move')
            ->inList('computer_move', $validMoves);

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

    public function playerMove($userId, $gameId, $playerMove)
    {
        $game = $this->Games->get($gameId);
        if ($game['is_player_winner'] !== null) {
            return null;
        }

        $move = $this->newEntity([
            'game_id' => $game['id'],
            'player_move' => $playerMove,
        ]);
        $move['user_id'] = $userId;

        return $this->save($move);
    }
}
