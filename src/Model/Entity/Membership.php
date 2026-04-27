<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Membership Entity
 *
 * @property int $MembershipID
 * @property int $UserID
 * @property int $PackageID
 * @property \Cake\I18n\Date $StartDate
 * @property \Cake\I18n\Date $EndDate
 * @property string|null $Status
 */
class Membership extends Entity
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
        'PackageID' => true,
        'StartDate' => true,
        'EndDate' => true,
        'Status' => true,
    ];
}
