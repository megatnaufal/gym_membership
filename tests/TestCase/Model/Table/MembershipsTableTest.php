<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MembershipsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MembershipsTable Test Case
 */
class MembershipsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\MembershipsTable
     */
    protected $Memberships;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.Memberships',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Memberships') ? [] : ['className' => MembershipsTable::class];
        $this->Memberships = $this->getTableLocator()->get('Memberships', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Memberships);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\MembershipsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
