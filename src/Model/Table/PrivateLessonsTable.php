<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PrivateLessons Model
 *
 * @method \App\Model\Entity\PrivateLesson newEmptyEntity()
 * @method \App\Model\Entity\PrivateLesson newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\PrivateLesson> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PrivateLesson get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\PrivateLesson findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\PrivateLesson patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\PrivateLesson> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\PrivateLesson|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\PrivateLesson saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\PrivateLesson>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\PrivateLesson>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\PrivateLesson>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\PrivateLesson> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\PrivateLesson>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\PrivateLesson>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\PrivateLesson>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\PrivateLesson> deleteManyOrFail(iterable $entities, array $options = [])
 */
class PrivateLessonsTable extends Table
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

        $this->setTable('private_lessons');
        $this->setDisplayField('Status');
        $this->setPrimaryKey('LessonID');

        $this->belongsTo('Users', [
            'foreignKey' => 'MemberUserID',
            'joinType' => 'INNER',
        ]);

        $this->belongsTo('Trainers', [
            'className' => 'Users',
            'foreignKey' => 'TrainerUserID',
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
            ->integer('MemberUserID')
            ->requirePresence('MemberUserID', 'create')
            ->notEmptyString('MemberUserID');

        $validator
            ->integer('TrainerUserID')
            ->requirePresence('TrainerUserID', 'create')
            ->notEmptyString('TrainerUserID');

        $validator
            ->dateTime('LessonDateTime')
            ->requirePresence('LessonDateTime', 'create')
            ->notEmptyDateTime('LessonDateTime');

        $validator
            ->scalar('Status')
            ->maxLength('Status', 20)
            ->notEmptyString('Status');

        $validator
            ->dateTime('CreatedAt')
            ->allowEmptyDateTime('CreatedAt');

        return $validator;
    }
}
