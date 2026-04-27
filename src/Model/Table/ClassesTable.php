<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Classes Model
 *
 * @method \App\Model\Entity\Class newEmptyEntity()
 * @method \App\Model\Entity\Class newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Class> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Class get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Class findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Class patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Class> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Class|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Class saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Class>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Class>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Class>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Class> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Class>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Class>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Class>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Class> deleteManyOrFail(iterable $entities, array $options = [])
 */
class ClassesTable extends Table
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

        $this->setTable('classes');
        $this->setDisplayField('ClassName');
        $this->setPrimaryKey('ClassID');
        $this->setEntityClass('GymClass');

        $this->belongsTo('Users', [
            'foreignKey' => 'TrainerUserID',
            'joinType' => 'INNER',
            'propertyName' => 'trainer'
        ]);
        $this->hasMany('Bookings', [
            'foreignKey' => 'ClassID'
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
            ->integer('TrainerUserID')
            ->requirePresence('TrainerUserID', 'create')
            ->notEmptyString('TrainerUserID');

        $validator
            ->scalar('ClassName')
            ->maxLength('ClassName', 100)
            ->requirePresence('ClassName', 'create')
            ->notEmptyString('ClassName');

        $validator
            ->dateTime('StartTime')
            ->requirePresence('StartTime', 'create')
            ->notEmptyDateTime('StartTime');

        $validator
            ->dateTime('EndTime')
            ->requirePresence('EndTime', 'create')
            ->notEmptyDateTime('EndTime');

        $validator
            ->integer('Capacity')
            ->requirePresence('Capacity', 'create')
            ->notEmptyString('Capacity');

        return $validator;
    }
}
