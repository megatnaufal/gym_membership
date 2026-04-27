<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Package $package
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Package'), ['action' => 'edit', $package->PackageID], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Package'), ['action' => 'delete', $package->PackageID], ['confirm' => __('Are you sure you want to delete # {0}?', $package->PackageID), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Packages'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Package'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="packages view content">
            <h3><?= h($package->PackageName) ?></h3>
            <table>
                <tr>
                    <th><?= __('PackageName') ?></th>
                    <td><?= h($package->PackageName) ?></td>
                </tr>
                <tr>
                    <th><?= __('BillingCycle') ?></th>
                    <td><?= h($package->BillingCycle) ?></td>
                </tr>
                <tr>
                    <th><?= __('AccessLevel') ?></th>
                    <td><?= h($package->AccessLevel) ?></td>
                </tr>
                <tr>
                    <th><?= __('PackageID') ?></th>
                    <td><?= $this->Number->format($package->PackageID) ?></td>
                </tr>
                <tr>
                    <th><?= __('Price') ?></th>
                    <td><?= $this->Number->format($package->Price) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>