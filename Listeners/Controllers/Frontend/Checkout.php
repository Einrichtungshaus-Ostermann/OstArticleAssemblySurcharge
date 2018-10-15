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
use Shopware_Controllers_Frontend_Checkout as Controller;
use OstArticleAssemblySurcharge\Services\ConfigurationService;
use OstArticleAssemblySurcharge\Services\SessionService;



/**
 * Einrichtungshaus Ostermann GmbH & Co. KG - Article Assembly Surcharge
 */

class Checkout
{

    /**
     * ...
     *
     * @var SessionService
     */

    private $sessionService;



    /**
     * ...
     *
     * @var ConfigurationService
     */

    private $configurationService;



    /**
     * ...
     *
     * @var string
     */

    private $viewDir;



    /**
     * ...
     *
     * @param SessionService         $sessionService
     * @param ConfigurationService   $configurationService
     * @param string                 $viewDir
     */

    public function __construct( SessionService $sessionService, ConfigurationService $configurationService, $viewDir )
    {
        // set params
        $this->sessionService       = $sessionService;
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
        $view->assign( "ostArticleAssemblySurchargeAction", $controller->Request()->getActionName() );

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

    public function addArticle( EventArgs $arguments )
    {
        // get the controller
        /* @var $controller Controller */
        $controller = $arguments->get( "subject" );

        // get parameters
        $request = $controller->Request();

        // do we want to add a option?
        if ( $request->has( "ost-article-assembly-surcharge" ) )
            // we dont
            $this->sessionService->add( $request->getParam( "sAdd" ) );
        else
            // add it
            $this->sessionService->remove( $request->getParam( "sAdd" ) );
    }



    /**
     * ...
     *
     * @param EventArgs   $arguments
     *
     * @return void
     */

    public function changeQuantity( EventArgs $arguments )
    {
        // get the controller
        /* @var $controller Controller */
        $controller = $arguments->get( "subject" );

        // get parameters
        $request = $controller->Request();

        // do we want to change an assembly?
        if ( !$request->has( "ost-article-assembly-surcharge" ) )
            // stop
            return;

        // do we want to add a option?
        if ( $request->has( "ost-article-assembly-surcharge--checkbox" ) )
            // add it
            $this->sessionService->add( $request->getParam( "article-number" ) );
        else
            // unchecked -> remove it
            $this->sessionService->remove( $request->getParam( "article-number" ) );
    }

}
