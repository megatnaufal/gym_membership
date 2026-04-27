<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * OrderItem Entity
 *
 * @property int $OrderItemID
 * @property int $OrderID
 * @property int $ProductID
 * @property int $Quantity
 * @property string $Subtotal
 */
class OrderItem extends Entity
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
        'OrderID' => true,
        'ProductID' => true,
        'Quantity' => true,
        'Subtotal' => true,
    ];
}
