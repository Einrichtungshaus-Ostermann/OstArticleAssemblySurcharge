<?php

class ArticleAssemblySurchargeTest extends Enlight_Components_Test_Controller_TestCase
{
    /**
     * @var \Doctrine\DBAL\Connection
     */
    private $connection;

    public function setUp()
    {
        parent::setUp();

        $this->connection = Shopware()->Container()->get('dbal_connection');
        $this->dispatch('/');
    }

    public function testAssembly() {
        self::assertTrue(true); //Demo Test
    }
}
