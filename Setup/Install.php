<?php declare(strict_types=1);

/**
 * Einrichtungshaus Ostermann GmbH & Co. KG - Article Assembly Surcharge
 *
 * @package   OstArticleAssemblySurcharge
 *
 * @author    Eike Brandt-Warneke <e.brandt-warneke@ostermann.de>
 * @copyright 2018 Einrichtungshaus Ostermann GmbH & Co. KG
 * @license   proprietary
 */

namespace OstArticleAssemblySurcharge\Setup;

use Shopware\Bundle\AttributeBundle\Service\CrudService;
use Shopware\Components\Model\ModelManager;
use Shopware\Components\Plugin;
use Shopware\Components\Plugin\Context\InstallContext;

class Install
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
     * @var ModelManager
     */
    protected $modelManager;

    /**
     * ...
     *
     * @var CrudService
     */
    protected $crudService;

    /**
     * ...
     *
     * @param Plugin         $plugin
     * @param InstallContext $context
     * @param ModelManager   $modelManager
     * @param CrudService    $crudService
     */
    public function __construct(Plugin $plugin, InstallContext $context, ModelManager $modelManager, CrudService $crudService)
    {
        // set params
        $this->plugin = $plugin;
        $this->context = $context;
        $this->modelManager = $modelManager;
        $this->crudService = $crudService;
    }

    /**
     * ...
     *
     * @throws \Exception
     */
    public function install()
    {
        // does this article have an assembly? this might be included or extra surcharge
        $this->crudService->update(
            's_order_details_attributes',
            'ost_article_assembly_surcharge_status',
            'boolean',
            [
                'translatable'     => false,
                'displayInBackend' => false,
                'custom'           => false
            ]
        );

        // if the article has a surcharge: what are the costs? this may be 0 if surcharge is included.
        // this will always be null if an assembly is not available or wasnt selected
        $this->crudService->update(
            's_order_details_attributes',
            'ost_article_assembly_surcharge_costs',
            'float',
            [
                'translatable'     => false,
                'displayInBackend' => false,
                'custom'           => false
            ]
        );

        // save our attributes
        $this->modelManager->generateAttributeModels(['s_order_details_attributes']);
    }
}
