<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * OrderItems Model
 *
 * @method \App\Model\Entity\OrderItem newEmptyEntity()
 * @method \App\Model\Entity\OrderItem newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\OrderItem> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\OrderItem get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\OrderItem findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\OrderItem patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\OrderItem> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\OrderItem|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\OrderItem saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\OrderItem>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\OrderItem>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\OrderItem>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\OrderItem> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\OrderItem>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\OrderItem>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\OrderItem>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\OrderItem> deleteManyOrFail(iterable $entities, array $options = [])
 */
class OrderItemsTable extends Table
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

        $this->setTable('order_items');
        $this->setDisplayField('OrderItemID');
        $this->setPrimaryKey('OrderItemID');
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
            ->integer('OrderID')
            ->requirePresence('OrderID', 'create')
            ->notEmptyString('OrderID');

        $validator
            ->integer('ProductID')
            ->requirePresence('ProductID', 'create')
            ->notEmptyString('ProductID');

        $validator
            ->integer('Quantity')
            ->requirePresence('Quantity', 'create')
            ->notEmptyString('Quantity');

        $validator
            ->decimal('Subtotal')
            ->requirePresence('Subtotal', 'create')
            ->notEmptyString('Subtotal');

        return $validator;
    }
}
