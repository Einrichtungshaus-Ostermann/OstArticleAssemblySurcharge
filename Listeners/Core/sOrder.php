<?php

/**
 * Einrichtungshaus Ostermann GmbH & Co. KG - Article Assembly Surcharge
 *
 * @package   OstArticleAssemblySurcharge
 * @author    Eike Brandt-Warneke <e.brandt-warneke@ostermann.de>
 * @copyright 2018 Einrichtungshaus Ostermann GmbH & Co. KG
 * @license   proprietary
 */

namespace OstArticleAssemblySurcharge\Listeners\Core;

use Enlight_Event_EventArgs as EventArgs;



/**
 * Einrichtungshaus Ostermann GmbH & Co. KG - Article Assembly Surcharge
 */

class sOrder
{

    /**
     * ...
     *
     * @param EventArgs   $arguments
     *
     * @return array
     */

    public function filterAttributes( EventArgs $arguments )
    {
        // get the basket
        $attributes = $arguments->getReturn();

        // get the article
        $article = $arguments->get( "basketRow" );

        // and our attribute
        $assembly = $article['ostArticleAssemblySurcharge'];

        // add our attributes to be saved
        $attributes = array_merge( $attributes, array(
            'ost_article_assembly_surcharge_status' => ( ( $assembly['selected'] == true ) or ( ( $assembly['status'] == true ) and ( (float) $assembly['surcharge'] == 0 ) ) ),
            'ost_article_assembly_surcharge_costs'  => ( ( $assembly['selected'] == true ) or ( ( $assembly['status'] == true ) and ( (float) $assembly['surcharge'] == 0 ) ) ) ? (float) $assembly['surcharge'] : null
        ));

        // return them
        return $attributes;
    }

}
