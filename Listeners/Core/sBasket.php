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

namespace OstArticleAssemblySurcharge\Listeners\Core;

use Enlight_Event_EventArgs as EventArgs;
use OstArticleAssemblySurcharge\Services\AssemblyService;
use OstArticleAssemblySurcharge\Services\SessionService;
use Shopware\Bundle\StoreFrontBundle\Struct\Attribute;

/**
 * Einrichtungshaus Ostermann GmbH & Co. KG - Article Assembly Surcharge
 */
class sBasket
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
     * @var AssemblyService
     */
    private $assemblyService;



    /**
     * ...
     *
     * @param SessionService  $sessionService
     * @param AssemblyService $assemblyService
     */
    public function __construct(SessionService $sessionService, AssemblyService $assemblyService)
    {
        // set params
        $this->sessionService = $sessionService;
        $this->assemblyService = $assemblyService;
    }



    /**
     * ...
     *
     * @param EventArgs $arguments
     *
     * @return array
     */
    public function getBasketFilter(EventArgs $arguments)
    {
        // get the basket
        $basket = $arguments->getReturn();

        // valid basket?
        if ((!is_array($basket)) || (!is_array($basket['content'])) || (count($basket['content']) === 0)) {
            // return default
            return $basket;
        }

        // loop the current basket
        foreach ($basket['content'] as $key => $article) {
            // do we even have attributes? we may have another plugin article in the basket
            if (!isset($article['additional_details']['attributes']) || (!is_array($article['additional_details']['attributes'])) || (!$article['additional_details']['attributes']['core'] instanceof Attribute)) {
                // invalid article never has assembly
                $article['ostArticleAssemblySurcharge'] = [
                    'status'    => false,
                    'selected'  => false,
                    'surcharge' => 0
                ];

                // set the article
                $basket['content'][$key] = $article;

                // next
                continue;
            }

            /* @var Attribute $attributes */
            $attributes = $article['additional_details']['attributes']['core'];

            // set article data
            $article['ostArticleAssemblySurcharge'] = [
                'status'    => $this->assemblyService->hasAssembly($attributes->toArray()),
                'surcharge' => $this->assemblyService->getSurcharge($attributes->toArray()),
                'selected'  => $this->sessionService->has($article['ordernumber']),
            ];

            // back to basket
            $basket['content'][$key] = $article;
        }

        // return final basket
        return $basket;
    }
}
