<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PrivateLessonsFixture
 */
class PrivateLessonsFixture extends TestFixture
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
                'LessonID' => 1,
                'MemberUserID' => 1,
                'TrainerUserID' => 1,
                'LessonDateTime' => '2026-07-21 16:02:58',
                'Status' => 'Lorem ipsum dolor ',
                'CreatedAt' => 1784649778,
            ],
        ];
        parent::init();
    }
}
