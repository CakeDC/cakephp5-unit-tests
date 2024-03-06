<?php
declare(strict_types=1);

namespace App\Model\Table;

use App\Model\Entity\Game;
use App\Model\Entity\Move;
use Cake\Cache\Cache;
use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Games Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\TournamentsTable&\Cake\ORM\Association\BelongsTo $Tournaments
 * @property \App\Model\Table\MovesTable&\Cake\ORM\Association\HasMany $Moves
 * @method \App\Model\Entity\Game newEmptyEntity()
 * @method \App\Model\Entity\Game newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Game> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Game get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Game findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Game patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Game> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Game|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Game saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Game>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Game>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Game>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Game> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Game>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Game>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Game>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Game> deleteManyOrFail(iterable $entities, array $options = [])
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class GamesTable extends Table
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

        $this->setTable('games');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Tournaments', [
            'foreignKey' => 'tournament_id',
        ]);
        $this->hasMany('Moves', [
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
            ->integer('best_of')
            ->requirePresence('best_of', 'create')
            ->greaterThan('best_of', 0, __('Best of must be > 0'));

        $validator
            ->boolean('is_player_winner')
            ->allowEmptyString('is_player_winner');

        $validator
            ->integer('tournament_id')
            ->allowEmptyString('tournament_id');

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
        $rules->add($rules->existsIn(['tournament_id'], 'Tournaments'), ['errorField' => 'tournament_id']);

        return $rules;
    }

    public function current(int $userId): ?Game
    {
        return $this->find('owner', userId: $userId)
            ->where(['is_player_winner IS' => null])
            ->contain('Moves')
            ->first();
    }

    public function findOwner(SelectQuery $query, int $userId): SelectQuery
    {
        return $query
            ->where(['user_id' => $userId]);
    }

    public function checkFinished($gameId)
    {
        $game = $this->get(
            $gameId,
            contain: ['Moves'],
        );
        if ($game['is_player_winner'] !== null) {
            return null;
        }
        $isPlayerWinner = $this->_isPlayerWinner($game);
        if ($isPlayerWinner !== null) {
            $game['is_player_winner'] = $isPlayerWinner;

            return $this->save($game);
        }
    }

    protected function _isPlayerWinner(Game $game)
    {
        [$playerWins, $computerWins] = $this->_countWins($game);
        if ($game['best_of'] === 1) {
            return $playerWins === 1;
        } else {
            $threshold = (int)($game['best_of'] / 2) + 1;
            if ($playerWins >= $threshold) {
                return true;
            }
            if ($computerWins >= $threshold) {
                return false;
            }
        }
    }

    protected function _countWins(Game $game)
    {
        $wins = collection($game->get('moves'))
            ->countBy(function (Move $move) {
                if ($move['is_player_winner'] === true) {
                    return 'player';
                }
                if ($move['is_player_winner'] === false) {
                    return 'computer';
                }
            })->toArray();
        if (empty($wins)) {
            //only ties
            return null;
        }

        return [$wins['player'] ?? 0, $wins['computer'] ?? 0];
    }

    public function findWon(SelectQuery $query, array $options): SelectQuery
    {
        return $query
            ->where(['is_player_winner' => true]);
    }

    public function findLost(SelectQuery $query, array $options): SelectQuery
    {
        return $query
            ->where(['is_player_winner' => false]);
    }

    public function afterSave(\Cake\Event\EventInterface $event, Game $game, $options)
    {
        if ($game->isDirty('is_player_winner')) {
            Cache::delete('totals_' . $game->get('user_id'));
        }
    }

    public function findPlayed(SelectQuery $query, array $options): SelectQuery
    {
        return $query
            ->where(['is_player_winner IS NOT null']);
    }
}
