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

namespace OstArticleAssemblySurcharge\Services;

class AssemblyService implements AssemblyServiceInterface
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
     * @param ConfigurationServiceInterface $configurationService
     */
    public function __construct(ConfigurationServiceInterface $configurationService)
    {
        // set params
        $this->configurationService = $configurationService;
    }

    public function hasAssembly(array $attributes)
    {
        // we either have fullservice incl. assembly or we have additional surcharge
        return   ((int) $attributes[$this->configurationService->get('attributeTag')] === 2) || ((float) $attributes[$this->configurationService->get('attributeSurcharge')] > 0);
    }

    public function getSurcharge(array $attributes)
    {
        // fullservice is always included with 0,- surcharge or we have explicit surcharge for pickup or delivery price
        return ((int) $attributes[$this->configurationService->get('attributeTag')] === 2)
            ? 0.0
            : (float) $attributes[$this->configurationService->get('attributeSurcharge')];
    }
}
