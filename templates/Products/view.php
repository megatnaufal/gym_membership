<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Product'), ['action' => 'edit', $product->ProductID], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Product'), ['action' => 'delete', $product->ProductID], ['confirm' => __('Are you sure you want to delete # {0}?', $product->ProductID), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Products'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Product'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="products view content">
            <h3><?= h($product->ProductName) ?></h3>
            <table>
                <tr>
                    <th><?= __('ProductName') ?></th>
                    <td><?= h($product->ProductName) ?></td>
                </tr>
                <tr>
                    <th><?= __('Category') ?></th>
                    <td><?= h($product->Category) ?></td>
                </tr>
                <tr>
                    <th><?= __('Description') ?></th>
                    <td><?= h($product->Description) ?></td>
                </tr>
                <tr>
                    <th><?= __('ProductID') ?></th>
                    <td><?= $this->Number->format($product->ProductID) ?></td>
                </tr>
                <tr>
                    <th><?= __('Price') ?></th>
                    <td><?= $this->Number->format($product->Price) ?></td>
                </tr>
                <tr>
                    <th><?= __('StockLevel') ?></th>
                    <td><?= $this->Number->format($product->StockLevel) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>