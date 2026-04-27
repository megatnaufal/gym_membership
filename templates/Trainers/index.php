<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Trainer> $trainers
 */
?>
<div class="trainers index content">
    <?= $this->Html->link(__('New Trainer'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Trainers') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('UserID') ?></th>
                    <th><?= $this->Paginator->sort('Specialty') ?></th>
                    <th><?= $this->Paginator->sort('Rating') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($trainers as $trainer): ?>
                <tr>
                    <td><?= $this->Number->format($trainer->UserID) ?></td>
                    <td><?= h($trainer->Specialty) ?></td>
                    <td><?= $trainer->Rating === null ? '' : $this->Number->format($trainer->Rating) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $trainer->UserID]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $trainer->UserID]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $trainer->UserID],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $trainer->UserID),
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