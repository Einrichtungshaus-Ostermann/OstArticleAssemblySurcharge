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

use Enlight_Components_Session_Namespace as Session;

class SessionService implements SessionServiceInterface
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
     * @var string
     */
    private $index = 'ost-article-assembly-surcharge';



    /**
     * ...
     *
     * @param Session $session
     */
    public function __construct(Session $session)
    {
        // set params
        $this->session = $session;
    }


    public function get()
    {
        return (array) $this->session->offsetGet($this->index);
    }


    public function set(array $data)
    {
        $this->session->offsetSet($this->index, $data);
    }


    public function has($number)
    {
        return  $this->session->offsetExists($this->index) && is_array($this->session->offsetGet($this->index)) && in_array($number, $this->session->offsetGet($this->index), true);
    }


    public function add($number)
    {
        // already set?
        if ($this->has($number)) {
            // ignore it
            return;
        }

        // get the session
        $session = $this->get();

        // add and unique our article number
        $session[] = $number;
        $session = array_unique($session);

        // save back to session
        $this->set($session);
    }


    public function remove($number)
    {
        // not set?
        if ($this->has($number) === false) {
            // ignore it
            return;
        }

        // get the session
        $session = $this->get();

        // remove article number
        unset($session[array_search($number, $session, true)]);

        // save back to session
        $this->set($session);
    }
}
