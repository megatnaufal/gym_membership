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
            <?= $this->Html->link(__('Edit Membership'), ['action' => 'edit', $membership->MembershipID], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Membership'), ['action' => 'delete', $membership->MembershipID], ['confirm' => __('Are you sure you want to delete # {0}?', $membership->MembershipID), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Memberships'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Membership'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="memberships view content">
            <h3><?= h($membership->MembershipID) ?></h3>
            <table>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= h($membership->Status) ?></td>
                </tr>
                <tr>
                    <th><?= __('MembershipID') ?></th>
                    <td><?= $this->Number->format($membership->MembershipID) ?></td>
                </tr>
                <tr>
                    <th><?= __('UserID') ?></th>
                    <td><?= $this->Number->format($membership->UserID) ?></td>
                </tr>
                <tr>
                    <th><?= __('PackageID') ?></th>
                    <td><?= $this->Number->format($membership->PackageID) ?></td>
                </tr>
                <tr>
                    <th><?= __('StartDate') ?></th>
                    <td><?= h($membership->StartDate) ?></td>
                </tr>
                <tr>
                    <th><?= __('EndDate') ?></th>
                    <td><?= h($membership->EndDate) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>