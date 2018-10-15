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
        // return by configuration
        return  (int) $attributes[$this->configurationService->get('attributeTag')] === 2;
    }


    public function getSurcharge(array $attributes)
    {
        // return by configuration
        return (float) $attributes[$this->configurationService->get('attributeSurcharge')];
    }
}
