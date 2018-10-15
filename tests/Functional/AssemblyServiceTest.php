<?php declare(strict_types=1);

use OstArticleAssemblySurcharge\Services\AssemblyService;
use OstArticleAssemblySurcharge\Services\ConfigurationServiceInterface;
use PHPUnit\Framework\TestCase;

class AssemblyServiceTest extends TestCase
{
    const TEST_DATA = [
        'attributeTag'       => 'foo',
        'attributeSurcharge' => 'bar'
    ];

    /**
     * @var \OstArticleAssemblySurcharge\Services\AssemblyServiceInterface
     */
    private $assemblyService;

    public function setUp()
    {
        parent::setUp();

        $this->assemblyService = new AssemblyService(new ConfigurationServiceMock());
    }

    public function testHasAssembly()
    {
        $attributes = [
            self::TEST_DATA['attributeTag'] => 2
        ];

        $this->assertTrue($this->assemblyService->hasAssembly($attributes));

        $attributes[self::TEST_DATA['attributeTag']] = 1;

        $this->assertFalse($this->assemblyService->hasAssembly($attributes));
    }

    public function testGetSurcharge()
    {
        /** @noinspection PhpUnhandledExceptionInspection */
        $attributes = [
            self::TEST_DATA['attributeSurcharge'] => random_int(1, 9999)
        ];

        $this->assertEquals($this->assemblyService->getSurcharge($attributes), $attributes[self::TEST_DATA['attributeSurcharge']]);

        $this->assertNotEquals($this->assemblyService->getSurcharge($attributes), $attributes[self::TEST_DATA['attributeSurcharge']] + 1);
    }
}

class ConfigurationServiceMock implements ConfigurationServiceInterface
{
    public function __construct()
    {
    }

    /**
     * ...
     *
     * @param string|null $key
     *
     * @return mixed
     */
    public function get($key = null)
    {
        return AssemblyServiceTest::TEST_DATA[$key];
    }
}
