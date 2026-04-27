<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * MembershipsFixture
 */
class MembershipsFixture extends TestFixture
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
                'MembershipID' => 1,
                'UserID' => 1,
                'PackageID' => 1,
                'StartDate' => '2026-04-27',
                'EndDate' => '2026-04-27',
                'Status' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
