<?php

/**
 * Einrichtungshaus Ostermann GmbH & Co. KG - Article Assembly Surcharge
 *
 * @package   OstArticleAssemblySurcharge
 * @author    Eike Brandt-Warneke <e.brandt-warneke@ostermann.de>
 * @copyright 2018 Einrichtungshaus Ostermann GmbH & Co. KG
 * @license   proprietary
 */

use Shopware\Components\CSRFWhitelistAware;



/**
 * Einrichtungshaus Ostermann GmbH & Co. KG - Article Assembly Surcharge
 */

class Shopware_Controllers_Frontend_OstArticleAssemblySurcharge extends Enlight_Controller_Action implements CSRFWhitelistAware
{

    /**
     * ...
     *
     * @return array
     */

    public function getWhitelistedCSRFActions()
    {
        // return all actions
        return array_values( array_filter(
            array_map(
                function( $method ) { return ( substr( $method, -6 ) == "Action" ) ? substr( $method, 0, -6 ) : null; },
                get_class_methods( $this )
            ),
            function ( $method ) { return ( !in_array( (string) $method, array( "", "index", "load", "extends" ) ) ); }
        ));
    }



    /**
     * ...
     *
     * @return void
     */

    public function indexAction()
    {
        // ...
        die( "not implemented yet" );
    }

}
