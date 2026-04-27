<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OrderItem $orderItem
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Order Item'), ['action' => 'edit', $orderItem->OrderItemID], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Order Item'), ['action' => 'delete', $orderItem->OrderItemID], ['confirm' => __('Are you sure you want to delete # {0}?', $orderItem->OrderItemID), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Order Items'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Order Item'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="orderItems view content">
            <h3><?= h($orderItem->OrderItemID) ?></h3>
            <table>
                <tr>
                    <th><?= __('OrderItemID') ?></th>
                    <td><?= $this->Number->format($orderItem->OrderItemID) ?></td>
                </tr>
                <tr>
                    <th><?= __('OrderID') ?></th>
                    <td><?= $this->Number->format($orderItem->OrderID) ?></td>
                </tr>
                <tr>
                    <th><?= __('ProductID') ?></th>
                    <td><?= $this->Number->format($orderItem->ProductID) ?></td>
                </tr>
                <tr>
                    <th><?= __('Quantity') ?></th>
                    <td><?= $this->Number->format($orderItem->Quantity) ?></td>
                </tr>
                <tr>
                    <th><?= __('Subtotal') ?></th>
                    <td><?= $this->Number->format($orderItem->Subtotal) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>