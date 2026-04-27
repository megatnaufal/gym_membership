<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Booking Entity
 *
 * @property int $BookingID
 * @property int $UserID
 * @property int $ClassID
 * @property \Cake\I18n\Date $BookingDate
 * @property string|null $AttendanceStatus
 */
class Booking extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'UserID' => true,
        'ClassID' => true,
        'BookingDate' => true,
        'AttendanceStatus' => true,
    ];
}
