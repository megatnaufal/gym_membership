<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * BookingsFixture
 */
class BookingsFixture extends TestFixture
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
                'BookingID' => 1,
                'UserID' => 1,
                'ClassID' => 1,
                'BookingDate' => '2026-04-27',
                'AttendanceStatus' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
