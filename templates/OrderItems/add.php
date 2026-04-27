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
            <?= $this->Html->link(__('List Order Items'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="orderItems form content">
            <?= $this->Form->create($orderItem) ?>
            <fieldset>
                <legend><?= __('Add Order Item') ?></legend>
                <?php
                    echo $this->Form->control('OrderID');
                    echo $this->Form->control('ProductID');
                    echo $this->Form->control('Quantity');
                    echo $this->Form->control('Subtotal');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
