<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Order> $orders
 */
?>
<div class="orders index content">
    <?= $this->Html->link(__('New Order'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Orders') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('OrderID') ?></th>
                    <th><?= $this->Paginator->sort('UserID') ?></th>
                    <th><?= $this->Paginator->sort('OrderDate') ?></th>
                    <th><?= $this->Paginator->sort('TotalAmount') ?></th>
                    <th><?= $this->Paginator->sort('PaymentMethod') ?></th>
                    <th><?= $this->Paginator->sort('OrderStatus') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                <tr>
                    <td><?= $this->Number->format($order->OrderID) ?></td>
                    <td><?= $this->Number->format($order->UserID) ?></td>
                    <td><?= h($order->OrderDate) ?></td>
                    <td><?= $this->Number->format($order->TotalAmount) ?></td>
                    <td><?= h($order->PaymentMethod) ?></td>
                    <td><?= h($order->OrderStatus) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $order->OrderID]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $order->OrderID]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $order->OrderID],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $order->OrderID),
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