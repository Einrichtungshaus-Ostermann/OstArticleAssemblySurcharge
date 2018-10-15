<?php

/**
 * Einrichtungshaus Ostermann GmbH & Co. KG - Article Assembly Surcharge
 *
 * @package   OstArticleAssemblySurcharge
 * @author    Eike Brandt-Warneke <e.brandt-warneke@ostermann.de>
 * @copyright 2018 Einrichtungshaus Ostermann GmbH & Co. KG
 * @license   proprietary
 */

namespace OstArticleAssemblySurcharge\Setup;

use Shopware\Components\Plugin;
use Shopware\Components\Plugin\Context\InstallContext;



/**
 * Einrichtungshaus Ostermann GmbH & Co. KG - Article Assembly Surcharge
 */

class Update
{

    /**
     * Main bootstrap object.
     *
     * @var Plugin
     */

    protected $plugin;



    /**
     * ...
     *
     * @var InstallContext
     */

    protected $context;



    /**
     * ...
     *
     * @param Plugin           $plugin
     * @param InstallContext   $context
     */

    public function __construct( Plugin $plugin, InstallContext $context )
    {
        // set params
        $this->plugin  = $plugin;
        $this->context = $context;
    }



    /**
     * ...
     *
     * @return void
     */

    public function install()
    {
        // install updates
        $this->update( "0.0.0" );
    }



    /**
     * ...
     *
     * @param string   $version
     *
     * @return void
     */

    public function update( $version )
    {
        // check current installed version
        switch ( $version )
        {
        }
    }

}
