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
            <?= $this->Html->link(__('Edit Trainer'), ['action' => 'edit', $trainer->UserID], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Trainer'), ['action' => 'delete', $trainer->UserID], ['confirm' => __('Are you sure you want to delete # {0}?', $trainer->UserID), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Trainers'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Trainer'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="trainers view content">
            <h3><?= h($trainer->Specialty) ?></h3>
            <table>
                <tr>
                    <th><?= __('Specialty') ?></th>
                    <td><?= h($trainer->Specialty) ?></td>
                </tr>
                <tr>
                    <th><?= __('UserID') ?></th>
                    <td><?= $this->Number->format($trainer->UserID) ?></td>
                </tr>
                <tr>
                    <th><?= __('Rating') ?></th>
                    <td><?= $trainer->Rating === null ? '' : $this->Number->format($trainer->Rating) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>