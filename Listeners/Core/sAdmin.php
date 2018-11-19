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

use Enlight_Components_Session_Namespace as Session;
use Enlight_Hook_HookArgs as HookArgs;
use Shopware\Bundle\StoreFrontBundle\Service\ContextServiceInterface;
use Shopware_Components_Modules as Modules;

class sAdmin
{
    /**
     * ...
     *
     * @var Session
     */
    private $session;

    /**
     * ...
     *
     * @var ContextServiceInterface
     */
    private $contextService;

    /**
     * ...
     *
     * @var Modules
     */
    private $modules;

    /**
     * ...
     *
     * @param Session                 $session
     * @param ContextServiceInterface $contextService
     * @param Modules                 $modules
     */
    public function __construct(Session $session, ContextServiceInterface $contextService, Modules $modules)
    {
        // set params
        $this->session = $session;
        $this->contextService = $contextService;
        $this->modules = $modules;
    }

    /**
     * Add custom article shipping costs.
     *
     * @param HookArgs $arguments
     *
     * @throws \Enlight_Exception
     */
    public function afterShippingcosts(HookArgs $arguments)
    {
        // get current dispatch costs
        $costs = $arguments->getReturn();

        // get tax, currency factor and current basket
        $tax = $costs['tax'] ?? $this->getTaxRate();
        $currencyFactor = (float) $this->contextService->getShopContext()->getShop()->getCurrency()->getFactor();
        $basket = $this->modules->Basket()->sGetBasketData();

        // not a valid basket?
        if ((!is_array($basket)) || !isset($basket['content']) || (!is_array($basket['content'])) || (count($basket['content']) === 0)) {
            // nope
            return;
        }

        // loop all articles
        foreach ($basket['content'] as $article) {
            // assembly selected?
            if (!isset($article['ostArticleAssemblySurcharge']) || ($article['ostArticleAssemblySurcharge']['status'] === false) || ($article['ostArticleAssemblySurcharge']['selected'] === false) || ($article['ostArticleAssemblySurcharge']['surcharge'] === 0)) {
                // nothing to do
                continue;
            }

            // get calculation data
            $surcharge = (float) $article['ostArticleAssemblySurcharge']['surcharge'];
            $quantity = (int) $article['quantity'];

            // add value, net and gross prices
            $costs['value'] += round($surcharge * $quantity, 2);
            $costs['netto'] += round(($surcharge / (($tax + 100) / 100)) * $quantity * $currencyFactor, 2);
            $costs['brutto'] += round($surcharge * $quantity, 2);

            // reset tax
            $costs['tax'] = $tax;
        }

        // set calculated shipping costs
        $arguments->setReturn($costs);
    }

    /**
     * Get the tax rate for the current dispach method.
     *
     * @return float
     */
    private function getTaxRate()
    {
        // get the current dispatch method
        $dispatch = $this->modules->Admin()->sGetPremiumDispatch((int) $this->session->offsetGet('sDispatch'));

        // get the tax rate by tax id or default 1
        return (float) $this->modules->Articles()->getTaxRateByConditions(
            ((int) $dispatch['tax_calculation'] > 0) ? (int) $dispatch['tax_calculation'] : 1
        );
    }
}
