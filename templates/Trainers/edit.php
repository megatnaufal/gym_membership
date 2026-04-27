<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Trainer $trainer
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $trainer->UserID],
                ['confirm' => __('Are you sure you want to delete # {0}?', $trainer->UserID), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Trainers'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="trainers form content">
            <?= $this->Form->create($trainer) ?>
            <fieldset>
                <legend><?= __('Edit Trainer') ?></legend>
                <?php
                    echo $this->Form->control('Specialty');
                    echo $this->Form->control('Rating');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
