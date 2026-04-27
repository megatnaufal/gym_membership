<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TrainersTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TrainersTable Test Case
 */
class TrainersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TrainersTable
     */
    protected $Trainers;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.Trainers',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Trainers') ? [] : ['className' => TrainersTable::class];
        $this->Trainers = $this->getTableLocator()->get('Trainers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Trainers);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\TrainersTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
