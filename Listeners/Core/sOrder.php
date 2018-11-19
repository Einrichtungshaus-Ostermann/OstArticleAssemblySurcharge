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

class sOrder
{
    /**
     * ...
     *
     * @param EventArgs $arguments
     *
     * @return array
     */
    public function filterAttributes(EventArgs $arguments)
    {
        // get the basket
        $attributes = $arguments->getReturn();

        // get the article
        $article = $arguments->get('basketRow');

        // and our attribute
        $assembly = $article['ostArticleAssemblySurcharge'];

        // add our attributes to be saved
        $attributes = array_merge($attributes, [
            'ost_article_assembly_surcharge_status' => $this->hasSurcharge($assembly),
            'ost_article_assembly_surcharge_costs'  => $this->hasSurcharge($assembly) ? (float) $assembly['surcharge'] : null
        ]);

        // return them
        return $attributes;
    }

    /**
     * @param $assembly
     *
     * @return bool
     */
    private function hasSurcharge($assembly): bool
    {
        return ($assembly['selected'] === true) || (($assembly['status'] === true) && ((float) $assembly['surcharge'] === 0));
    }
}
