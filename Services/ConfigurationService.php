<?php

/**
 * Einrichtungshaus Ostermann GmbH & Co. KG - Article Assembly Surcharge
 *
 * @package   OstArticleAssemblySurcharge
 * @author    Eike Brandt-Warneke <e.brandt-warneke@ostermann.de>
 * @copyright 2018 Einrichtungshaus Ostermann GmbH & Co. KG
 * @license   proprietary
 */

namespace OstArticleAssemblySurcharge\Services;

use Shopware\Models\Shop\Shop;
use Shopware\Bundle\StoreFrontBundle\Service\ContextServiceInterface;
use Shopware\Components\Model\ModelManager;
use Shopware\Components\Plugin\CachedConfigReader;



/**
 * Einrichtungshaus Ostermann GmbH & Co. KG - Article Assembly Surcharge
 */

class ConfigurationService
{

    /**
     * ...
     *
     * @var array
     */

    protected $configuration;



    /**
	 * ...
	 *
	 * @param ModelManager              $modelManager
     * @param ContextServiceInterface   $contextService
     * @param CachedConfigReader        $cachedConfigReader
     * @param string                    $pluginName
	 */

	public function __construct( ModelManager $modelManager, ContextServiceInterface $contextService, CachedConfigReader $cachedConfigReader, $pluginName )
	{
		// set params
		$this->configuration = $cachedConfigReader->getByPluginName(
            $pluginName,
            $modelManager->find(
                Shop::class,
                $contextService->getShopContext()->getShop()->getId()
            )
        );
	}



    /**
     * ...
     *
     * @param string|null   $key
     *
     * @return mixed
     */

    public function get( $key = null )
    {
        // none given
        if ( $key === null )
            // return configuration
            return $this->configuration;

        // return by key
        return $this->configuration[$key];
    }
    
}
