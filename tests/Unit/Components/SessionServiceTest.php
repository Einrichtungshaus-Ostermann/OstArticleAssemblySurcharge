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

    /**
     * @before
     */
    public function setUpSessionService()
    {
        $this->sessionService = new SessionService(new Enlight_Components_Session_Namespace());
    }

    /**
     * @after
     */
    public function tearDownSessionService()
    {
        $this->sessionService = null;
    }

    public function testSetGet()
    {
        $this->sessionService->set(self::TEST_DATA);

        assertEquals(self::TEST_DATA, $this->sessionService->get());
    }

    public function testSetHas()
    {
        $this->sessionService->set(self::TEST_DATA);

        foreach (self::TEST_DATA as $value) {
            assertTrue($this->sessionService->has($value));
        }
    }

    public function testAddHas()
    {
        foreach (self::TEST_DATA as $value) {
            $this->sessionService->add($value);
        }

        foreach (self::TEST_DATA as $value) {
            assertTrue($this->sessionService->has($value));
        }
    }

    public function testSetRemove()
    {
        $this->sessionService->set(self::TEST_DATA);

        assertTrue($this->sessionService->has(self::TEST_DATA[0]));

        $this->sessionService->remove(self::TEST_DATA[0]);

        assertFalse($this->sessionService->has(self::TEST_DATA[0]));
    }
}
