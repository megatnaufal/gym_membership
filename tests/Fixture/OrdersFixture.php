<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * OrdersFixture
 */
class OrdersFixture extends TestFixture
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
                'OrderID' => 1,
                'UserID' => 1,
                'OrderDate' => '2026-04-27',
                'TotalAmount' => 1.5,
                'PaymentMethod' => 'Lorem ipsum dolor sit amet',
                'OrderStatus' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
