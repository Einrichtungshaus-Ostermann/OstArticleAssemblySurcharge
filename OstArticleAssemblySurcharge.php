<?php declare(strict_types=1);

/**
 * Einrichtungshaus Ostermann GmbH & Co. KG - Article Assembly Surcharge
 *
 * Adds an optional assembly surcharge for articles which have an assembly price
 * set in the IWM. The surcharge is selectable in the article details and in
 * the checkout process and will be added to the shipping costs.
 *
 * 1.0.0
 * - initial release
 *
 * 1.0.1
 * - added priority to shipping costs calculation listener to add the surcharge
 *   after everything else was calculated
 *
 * 1.0.2
 * - fixed css
 *
 * 1.0.3
 * - added outer html container to checkbox in detail controller
 *
 * 1.0.4
 * - removed usage of let for grunt
 *
 * 1.0.5
 * - changed name and default value of attribute configuration
 *
 * @package   OstArticleAssemblySurcharge
 *
 * @author    Eike Brandt-Warneke <e.brandt-warneke@ostermann.de>
 * @copyright 2018 Einrichtungshaus Ostermann GmbH & Co. KG
 * @license   proprietary
 */

namespace OstArticleAssemblySurcharge;

use Shopware\Components\Plugin;
use Shopware\Components\Plugin\Context;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class OstArticleAssemblySurcharge extends Plugin
{
    /**
     * ...
     *
     * @param ContainerBuilder $container
     */
    public function build(ContainerBuilder $container)
    {
        // set plugin parameters
        $container->setParameter('ost_article_assembly_surcharge.plugin_dir', $this->getPath() . '/');
        $container->setParameter('ost_article_assembly_surcharge.view_dir', $this->getPath() . '/Resources/views/');

        // call parent builder
        parent::build($container);
    }

    /**
     * Activate the plugin.
     *
     * @param Context\ActivateContext $context
     */
    public function activate(Context\ActivateContext $context)
    {
        // clear complete cache after we activated the plugin
        $context->scheduleClearCache($context::CACHE_LIST_ALL);
    }

    /**
     * Install the plugin.
     *
     * @param Context\InstallContext $context
     *
     * @throws \Exception
     */
    public function install(Context\InstallContext $context)
    {
        // install the plugin
        $installer = new Setup\Install(
            $this,
            $context,
            $this->container->get('models'),
            $this->container->get('shopware_attribute.crud_service')
        );
        $installer->install();

        // update it to current version
        $updater = new Setup\Update(
            $this,
            $context
        );
        $updater->install();

        // call default installer
        parent::install($context);
    }

    /**
     * Update the plugin.
     *
     * @param Context\UpdateContext $context
     */
    public function update(Context\UpdateContext $context)
    {
        // update the plugin
        $updater = new Setup\Update(
            $this,
            $context
        );
        $updater->update($context->getCurrentVersion());

        // call default updater
        parent::update($context);
    }

    /**
     * Uninstall the plugin.
     *
     * @param Context\UninstallContext $context
     *
     * @throws \Exception
     */
    public function uninstall(Context\UninstallContext $context)
    {
        // uninstall the plugin
        $uninstaller = new Setup\Uninstall(
            $this,
            $context,
            $this->container->get('models'),
            $this->container->get('shopware_attribute.crud_service')
        );
        $uninstaller->uninstall();

        // clear complete cache
        $context->scheduleClearCache($context::CACHE_LIST_ALL);

        // call default uninstaller
        parent::uninstall($context);
    }
}
