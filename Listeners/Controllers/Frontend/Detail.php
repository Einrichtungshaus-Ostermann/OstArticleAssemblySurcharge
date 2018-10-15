<?php

/**
 * Einrichtungshaus Ostermann GmbH & Co. KG - Article Assembly Surcharge
 *
 * @package   OstArticleAssemblySurcharge
 * @author    Eike Brandt-Warneke <e.brandt-warneke@ostermann.de>
 * @copyright 2018 Einrichtungshaus Ostermann GmbH & Co. KG
 * @license   proprietary
 */

namespace OstArticleAssemblySurcharge\Listeners\Controllers\Frontend;

use Enlight_Event_EventArgs as EventArgs;
use OstArticleAssemblySurcharge\Services\ConfigurationService;
use OstArticleAssemblySurcharge\Services\AssemblyService;
use Shopware_Controllers_Frontend_Detail as Controller;
use Shopware\Bundle\StoreFrontBundle\Struct\Attribute;



/**
 * Einrichtungshaus Ostermann GmbH & Co. KG - Article Assembly Surcharge
 */

class Detail
{

    /**
     * ...
     *
     * @var ConfigurationService
     */

    private $configurationService;



    /**
     * ...
     *
     * @var AssemblyService
     */

    private $assemblyService;



    /**
     * ...
     *
     * @var string
     */

    private $viewDir;



    /**
	 * ...
	 *
     * @param AssemblyService        $assemblyService
     * @param ConfigurationService   $configurationService
     * @param string                 $viewDir
	 */

	public function __construct( AssemblyService $assemblyService, ConfigurationService $configurationService, $viewDir )
	{
		// set params
        $this->assemblyService      = $assemblyService;
        $this->configurationService = $configurationService;
        $this->viewDir              = $viewDir;
	}



    /**
     * ...
     *
     * @param EventArgs   $arguments
     *
     * @return void
     */

    public function onPreDispatch( EventArgs $arguments )
    {
        // get the controller
        /* @var $controller Controller */
        $controller = $arguments->get( "subject" );

        // get parameters
        $view = $controller->View();

        // add configuration
        $view->assign( "ostArticleAssemblySurchargeConfiguration", $this->configurationService->get() );

        // add template dir
        $view->addTemplateDir( $this->viewDir );
    }



    /**
     * ...
     *
     * @param EventArgs   $arguments
     *
     * @return void
     */

    public function onPostDispatch( EventArgs $arguments )
    {
        // get the controller
        /* @var $controller Controller */
        $controller = $arguments->get( "subject" );

        // get parameters
        $view = $controller->View();

        // are active for this shop?
        if ( $this->configurationService->get( "shopStatus" ) == false )
            // nothing to do
            return;

        // get the article
        $article = $view->getAssign( "sArticle" );

        // has to be valid
        if ( ( !is_array( $article ) ) or ( !isset( $article['attributes'] ) ) )
            // stop here
            return;

        /* @var Attribute $attributes */
        $attributes = $article['attributes']['core'];

        // set article data
        $view->assign( "ostArticleAssemblySurcharge", array(
            'status'    => $this->assemblyService->hasAssembly( $attributes->toArray() ),
            'surcharge' => $this->assemblyService->getSurcharge( $attributes->toArray() )
        ));
    }

}
