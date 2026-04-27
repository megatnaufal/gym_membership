<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Booking $booking
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Booking'), ['action' => 'edit', $booking->BookingID], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Booking'), ['action' => 'delete', $booking->BookingID], ['confirm' => __('Are you sure you want to delete # {0}?', $booking->BookingID), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Bookings'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Booking'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="bookings view content">
            <h3><?= h($booking->BookingID) ?></h3>
            <table>
                <tr>
                    <th><?= __('AttendanceStatus') ?></th>
                    <td><?= h($booking->AttendanceStatus) ?></td>
                </tr>
                <tr>
                    <th><?= __('BookingID') ?></th>
                    <td><?= $this->Number->format($booking->BookingID) ?></td>
                </tr>
                <tr>
                    <th><?= __('UserID') ?></th>
                    <td><?= $this->Number->format($booking->UserID) ?></td>
                </tr>
                <tr>
                    <th><?= __('ClassID') ?></th>
                    <td><?= $this->Number->format($booking->ClassID) ?></td>
                </tr>
                <tr>
                    <th><?= __('BookingDate') ?></th>
                    <td><?= h($booking->BookingDate) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>