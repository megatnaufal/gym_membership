<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Booking> $bookings
 */
?>
<div class="bookings index content">
    <?= $this->Html->link(__('New Booking'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Bookings') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('BookingID') ?></th>
                    <th><?= $this->Paginator->sort('UserID') ?></th>
                    <th><?= $this->Paginator->sort('ClassID') ?></th>
                    <th><?= $this->Paginator->sort('BookingDate') ?></th>
                    <th><?= $this->Paginator->sort('AttendanceStatus') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bookings as $booking): ?>
                <tr>
                    <td><?= $this->Number->format($booking->BookingID) ?></td>
                    <td><?= $this->Number->format($booking->UserID) ?></td>
                    <td><?= $this->Number->format($booking->ClassID) ?></td>
                    <td><?= h($booking->BookingDate) ?></td>
                    <td><?= h($booking->AttendanceStatus) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $booking->BookingID]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $booking->BookingID]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $booking->BookingID],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $booking->BookingID),
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