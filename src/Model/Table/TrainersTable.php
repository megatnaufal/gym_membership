<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Trainers Model
 *
 * @method \App\Model\Entity\Trainer newEmptyEntity()
 * @method \App\Model\Entity\Trainer newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Trainer> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Trainer get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Trainer findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Trainer patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Trainer> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Trainer|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Trainer saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Trainer>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Trainer>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Trainer>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Trainer> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Trainer>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Trainer>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Trainer>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Trainer> deleteManyOrFail(iterable $entities, array $options = [])
 */
class TrainersTable extends Table
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

        $this->setTable('trainers');
        $this->setDisplayField('Specialty');
        $this->setPrimaryKey('UserID');
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
            ->scalar('Specialty')
            ->maxLength('Specialty', 100)
            ->requirePresence('Specialty', 'create')
            ->notEmptyString('Specialty');

        $validator
            ->decimal('Rating')
            ->allowEmptyString('Rating');

        return $validator;
    }
}
