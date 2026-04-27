<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PackagesFixture
 */
class PackagesFixture extends TestFixture
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
                'PackageID' => 1,
                'PackageName' => 'Lorem ipsum dolor sit amet',
                'Price' => 1.5,
                'BillingCycle' => 'Lorem ipsum dolor sit amet',
                'AccessLevel' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
