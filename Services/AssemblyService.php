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



/**
 * Einrichtungshaus Ostermann GmbH & Co. KG - Article Assembly Surcharge
 */

class AssemblyService
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
     * @param ConfigurationService      $configurationService
     */

    public function __construct( ConfigurationService $configurationService )
    {
        // set params
        $this->configurationService  = $configurationService;
    }



    /**
     * ...
     *
     * @param array   $attributes
     *
     * @return boolean
     */

    public function hasAssembly( array $attributes )
    {
        // return by configuration
        return ( (integer) $attributes[$this->configurationService->get( "attributeTag" )] == 2 );
    }



    /**
     * ...
     *
     * @param array $attributes
     *
     * @return float
     */

    public function getSurcharge( array $attributes )
    {
        // return by configuration
        return (float) $attributes[$this->configurationService->get( "attributeSurcharge" )];
    }

}
