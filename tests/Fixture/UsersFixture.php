<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsersFixture
 */
class UsersFixture extends TestFixture
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
                'Username' => 'Lorem ipsum dolor sit amet',
                'Password' => 'Lorem ipsum dolor sit amet',
                'FullName' => 'Lorem ipsum dolor sit amet',
                'Email' => 'Lorem ipsum dolor sit amet',
                'Phone' => 'Lorem ipsum dolor ',
                'Role' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
