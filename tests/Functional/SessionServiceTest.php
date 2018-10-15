<?php

use OstArticleAssemblySurcharge\Services\SessionService;
use PHPUnit\Framework\TestCase;

class SessionServiceTest extends TestCase
{
    const TEST_DATA = [
        'foo',
        'bar'
    ];

    /**
     * @var SessionService
     */
    private $sessionService;

    public function setUp()
    {
        parent::setUp();

        $this->sessionService = new SessionService(Shopware()->Session());
    }

    public function tearDown()
    {
        parent::tearDown();

        Shopware()->Session()->unsetAll();
    }

    public function testSetGet()
    {
        $this->sessionService->set(self::TEST_DATA);

        $this->assertEquals(self::TEST_DATA, $this->sessionService->get());
    }

    public function testSetHas()
    {
        $this->sessionService->set(self::TEST_DATA);

        foreach (self::TEST_DATA as $value) {
            $this->assertTrue($this->sessionService->has($value));
        }
    }

    public function testAddHas()
    {
        foreach (self::TEST_DATA as $value) {
            $this->sessionService->add($value);
        }

        foreach (self::TEST_DATA as $value) {
            $this->assertTrue($this->sessionService->has($value));
        }
    }

    public function testSetRemove()
    {
        $this->sessionService->set(self::TEST_DATA);

        $this->assertTrue($this->sessionService->has(self::TEST_DATA[0]));

        $this->sessionService->remove(self::TEST_DATA[0]);

        $this->assertFalse($this->sessionService->has(self::TEST_DATA[0]));
    }
}
