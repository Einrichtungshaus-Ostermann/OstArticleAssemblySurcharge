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

/**
 * Einrichtungshaus Ostermann GmbH & Co. KG - Article Assembly Surcharge
 */
interface SessionServiceInterface
{
    /**
     * ...
     *
     * @return array
     */
    public function get();

    /**
     * ...
     *
     * @param array $data
     */
    public function set(array $data);

    /**
     * ...
     *
     * @param string $number
     *
     * @return bool
     */
    public function has($number);

    /**
     * ...
     *
     * @param string $number
     */
    public function add($number);

    /**
     * ...
     *
     * @param string $number
     */
    public function remove($number);
}
