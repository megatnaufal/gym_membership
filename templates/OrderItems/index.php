<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\OrderItem> $orderItems
 */
?>
<div class="orderItems index content">
    <?= $this->Html->link(__('New Order Item'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Order Items') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('OrderItemID') ?></th>
                    <th><?= $this->Paginator->sort('OrderID') ?></th>
                    <th><?= $this->Paginator->sort('ProductID') ?></th>
                    <th><?= $this->Paginator->sort('Quantity') ?></th>
                    <th><?= $this->Paginator->sort('Subtotal') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orderItems as $orderItem): ?>
                <tr>
                    <td><?= $this->Number->format($orderItem->OrderItemID) ?></td>
                    <td><?= $this->Number->format($orderItem->OrderID) ?></td>
                    <td><?= $this->Number->format($orderItem->ProductID) ?></td>
                    <td><?= $this->Number->format($orderItem->Quantity) ?></td>
                    <td><?= $this->Number->format($orderItem->Subtotal) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $orderItem->OrderItemID]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $orderItem->OrderItemID]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $orderItem->OrderItemID],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $orderItem->OrderItemID),
                            ]
                        ) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>