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
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $package->PackageID],
                ['confirm' => __('Are you sure you want to delete # {0}?', $package->PackageID), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Packages'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="packages form content">
            <?= $this->Form->create($package) ?>
            <fieldset>
                <legend><?= __('Edit Package') ?></legend>
                <?php
                    echo $this->Form->control('PackageName');
                    echo $this->Form->control('Price');
                    echo $this->Form->control('BillingCycle');
                    echo $this->Form->control('AccessLevel');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
