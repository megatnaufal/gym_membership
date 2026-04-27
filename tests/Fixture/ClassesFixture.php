<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ClassesFixture
 */
class ClassesFixture extends TestFixture
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
                'ClassID' => 1,
                'TrainerUserID' => 1,
                'ClassName' => 'Lorem ipsum dolor sit amet',
                'StartTime' => '2026-04-27 17:38:29',
                'EndTime' => '2026-04-27 17:38:29',
                'Capacity' => 1,
            ],
        ];
        parent::init();
    }
}
