<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PrivateLessonsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PrivateLessonsTable Test Case
 */
class PrivateLessonsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PrivateLessonsTable
     */
    protected $PrivateLessons;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.PrivateLessons',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('PrivateLessons') ? [] : ['className' => PrivateLessonsTable::class];
        $this->PrivateLessons = $this->getTableLocator()->get('PrivateLessons', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->PrivateLessons);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\PrivateLessonsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
