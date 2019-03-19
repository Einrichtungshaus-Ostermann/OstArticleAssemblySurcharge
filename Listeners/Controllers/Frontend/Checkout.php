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
use OstArticleAssemblySurcharge\Services\ConfigurationServiceInterface;
use OstArticleAssemblySurcharge\Services\SessionServiceInterface;
use Shopware_Controllers_Frontend_Checkout as Controller;

class Checkout
{
    /**
     * ...
     *
     * @var SessionServiceInterface
     */
    private $sessionService;

    /**
     * ...
     *
     * @var ConfigurationServiceInterface
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
     * @param SessionServiceInterface       $sessionService
     * @param ConfigurationServiceInterface $configurationService
     * @param string                        $viewDir
     */
    public function __construct(SessionServiceInterface $sessionService, ConfigurationServiceInterface $configurationService, $viewDir)
    {
        // set params
        $this->sessionService = $sessionService;
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
        $view->assign('ostArticleAssemblySurchargeAction', $controller->Request()->getActionName());
    }

    /**
     * ...
     *
     * @param EventArgs $arguments
     */
    public function addArticle(EventArgs $arguments)
    {
        // get the controller
        /* @var $controller Controller */
        $controller = $arguments->get('subject');

        // get parameters
        $request = $controller->Request();

        // do we want to add a option?
        if ($request->has('ost-article-assembly-surcharge')) {
            // we dont
            $this->sessionService->add($request->getParam('sAdd'));
        } else {
            // add it
            $this->sessionService->remove($request->getParam('sAdd'));
        }
    }

    /**
     * ...
     *
     * @param EventArgs $arguments
     */
    public function changeQuantity(EventArgs $arguments)
    {
        // get the controller
        /* @var $controller Controller */
        $controller = $arguments->get('subject');

        // get parameters
        $request = $controller->Request();

        // do we want to change an assembly?
        if (!$request->has('ost-article-assembly-surcharge')) {
            // stop
            return;
        }

        // do we want to add a option?
        if ($request->has('ost-article-assembly-surcharge--checkbox')) {
            // add it
            $this->sessionService->add($request->getParam('article-number'));
        } else {
            // unchecked -> remove it
            $this->sessionService->remove($request->getParam('article-number'));
        }
    }
}
