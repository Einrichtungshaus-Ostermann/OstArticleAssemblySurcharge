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

namespace OstArticleAssemblySurcharge\Listeners\Controllers;

use Enlight_Controller_Action as Controller;
use Enlight_Event_EventArgs as EventArgs;

class Frontend
{
    /**
     * ...
     *
     * @var string
     */
    protected $viewDir;

    /**
     * ...
     *
     * @param string $viewDir
     */
    public function __construct($viewDir)
    {
        // set params
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

        // add template dir
        $view->addTemplateDir($this->viewDir);
    }
}
