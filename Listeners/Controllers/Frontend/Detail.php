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

namespace OstArticleAssemblySurcharge\Listeners\Controllers\Frontend;

use Enlight_Event_EventArgs as EventArgs;
use OstArticleAssemblySurcharge\Services\AssemblyServiceInterface;
use OstArticleAssemblySurcharge\Services\ConfigurationServiceInterface;
use Shopware\Bundle\StoreFrontBundle\Struct\Attribute;
use Shopware_Controllers_Frontend_Detail as Controller;

class Detail
{
    /**
     * ...
     *
     * @var ConfigurationServiceInterface
     */
    private $configurationService;

    /**
     * ...
     *
     * @var AssemblyServiceInterface
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
     * @param AssemblyServiceInterface      $assemblyService
     * @param ConfigurationServiceInterface $configurationService
     * @param string                        $viewDir
     */
    public function __construct(AssemblyServiceInterface $assemblyService, ConfigurationServiceInterface $configurationService, $viewDir)
    {
        // set params
        $this->assemblyService = $assemblyService;
        $this->configurationService = $configurationService;
        $this->viewDir = $viewDir;
    }

    /**
     * ...
     *
     * @param EventArgs $arguments
     */
    public function onPreDispatch(EventArgs $arguments)
    {
        // get the controller
        /* @var $controller Controller */
        $controller = $arguments->get('subject');

        // get parameters
        $view = $controller->View();

        // add configuration
        $view->assign('ostArticleAssemblySurchargeConfiguration', $this->configurationService->get());

        // add template dir
        $view->addTemplateDir($this->viewDir);
    }

    /**
     * ...
     *
     * @param EventArgs $arguments
     */
    public function onPostDispatch(EventArgs $arguments)
    {
        // get the controller
        /* @var $controller Controller */
        $controller = $arguments->get('subject');

        // get parameters
        $view = $controller->View();

        // are active for this shop?
        if ($this->configurationService->get('shopStatus') === false) {
            // nothing to do
            return;
        }

        // get the article
        $article = $view->getAssign('sArticle');

        // has to be valid
        if ((!is_array($article)) || !isset($article['attributes'])) {
            // stop here
            return;
        }

        /* @var Attribute $attributes */
        $attributes = $article['attributes']['core'];

        // set article data
        $view->assign('ostArticleAssemblySurcharge', [
            'status'    => $this->assemblyService->hasAssembly($attributes->toArray()),
            'surcharge' => $this->assemblyService->getSurcharge($attributes->toArray())
        ]);
    }
}
