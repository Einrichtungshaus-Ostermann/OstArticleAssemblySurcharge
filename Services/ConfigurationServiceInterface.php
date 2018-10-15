<?php declare(strict_types=1);
/**
 * Einrichtungshaus Ostermann GmbH & Co. KG - Article Assembly Surcharge
 *
 * @package   OstArticleAssemblySurcharge
 *
 * @author    Tim Windelschmidt <tim.windelschmidt@ostermann.de>
 * @copyright 2018 Einrichtungshaus Ostermann GmbH & Co. KG
 * @license   proprietary
 */

namespace OstArticleAssemblySurcharge\Services;

interface ConfigurationServiceInterface
{
    /**
     * ...
     *
     * @param string|null $key
     *
     * @return mixed
     */
    public function get($key = null);
}
