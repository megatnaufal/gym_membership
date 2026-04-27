<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * OrderItemsFixture
 */
class OrderItemsFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'OrderItemID' => 1,
                'OrderID' => 1,
                'ProductID' => 1,
                'Quantity' => 1,
                'Subtotal' => 1.5,
            ],
        ];
        parent::init();
    }
}
