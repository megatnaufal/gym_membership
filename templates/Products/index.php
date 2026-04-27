<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Product> $products
 */
?>
<div class="products index content">
    <?= $this->Html->link(__('New Product'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Products') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('ProductID') ?></th>
                    <th><?= $this->Paginator->sort('ProductName') ?></th>
                    <th><?= $this->Paginator->sort('Category') ?></th>
                    <th><?= $this->Paginator->sort('Price') ?></th>
                    <th><?= $this->Paginator->sort('StockLevel') ?></th>
                    <th><?= $this->Paginator->sort('Description') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= $this->Number->format($product->ProductID) ?></td>
                    <td><?= h($product->ProductName) ?></td>
                    <td><?= h($product->Category) ?></td>
                    <td><?= $this->Number->format($product->Price) ?></td>
                    <td><?= $this->Number->format($product->StockLevel) ?></td>
                    <td><?= h($product->Description) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $product->ProductID]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $product->ProductID]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $product->ProductID],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $product->ProductID),
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