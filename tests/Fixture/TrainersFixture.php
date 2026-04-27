<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TrainersFixture
 */
class TrainersFixture extends TestFixture
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
                'UserID' => 1,
                'Specialty' => 'Lorem ipsum dolor sit amet',
                'Rating' => 1.5,
            ],
        ];
        parent::init();
    }
}
