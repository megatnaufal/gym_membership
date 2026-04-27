<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Membership $membership
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $membership->MembershipID],
                ['confirm' => __('Are you sure you want to delete # {0}?', $membership->MembershipID), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Memberships'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="memberships form content">
            <?= $this->Form->create($membership) ?>
            <fieldset>
                <legend><?= __('Edit Membership') ?></legend>
                <?php
                    echo $this->Form->control('UserID');
                    echo $this->Form->control('PackageID');
                    echo $this->Form->control('StartDate');
                    echo $this->Form->control('EndDate');
                    echo $this->Form->control('Status');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
