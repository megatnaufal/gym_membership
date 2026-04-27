<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Package> $packages
 */
?>
<div class="packages index content">
    <?= $this->Html->link(__('New Package'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Packages') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('PackageID') ?></th>
                    <th><?= $this->Paginator->sort('PackageName') ?></th>
                    <th><?= $this->Paginator->sort('Price') ?></th>
                    <th><?= $this->Paginator->sort('BillingCycle') ?></th>
                    <th><?= $this->Paginator->sort('AccessLevel') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($packages as $package): ?>
                <tr>
                    <td><?= $this->Number->format($package->PackageID) ?></td>
                    <td><?= h($package->PackageName) ?></td>
                    <td><?= $this->Number->format($package->Price) ?></td>
                    <td><?= h($package->BillingCycle) ?></td>
                    <td><?= h($package->AccessLevel) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $package->PackageID]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $package->PackageID]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $package->PackageID],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $package->PackageID),
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