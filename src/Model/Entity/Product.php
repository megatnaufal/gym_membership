<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Product Entity
 *
 * @property int $ProductID
 * @property string $ProductName
 * @property string $Category
 * @property string $Price
 * @property int $StockLevel
 * @property string|null $Description
 */
class Product extends Entity
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
        'ProductName' => true,
        'Category' => true,
        'Price' => true,
        'StockLevel' => true,
        'Description' => true,
    ];
}
