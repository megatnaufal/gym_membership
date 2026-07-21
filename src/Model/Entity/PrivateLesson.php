<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PrivateLesson Entity
 *
 * @property int $LessonID
 * @property int $MemberUserID
 * @property int $TrainerUserID
 * @property \Cake\I18n\DateTime $LessonDateTime
 * @property string $Status
 * @property \Cake\I18n\DateTime|null $CreatedAt
 */
class PrivateLesson extends Entity
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
        'MemberUserID' => true,
        'TrainerUserID' => true,
        'LessonDateTime' => true,
        'Status' => true,
        'CreatedAt' => true,
    ];
}
