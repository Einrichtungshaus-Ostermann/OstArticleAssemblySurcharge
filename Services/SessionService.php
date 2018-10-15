<?php

/**
 * Einrichtungshaus Ostermann GmbH & Co. KG - Article Assembly Surcharge
 *
 * @package   OstArticleAssemblySurcharge
 * @author    Eike Brandt-Warneke <e.brandt-warneke@ostermann.de>
 * @copyright 2018 Einrichtungshaus Ostermann GmbH & Co. KG
 * @license   proprietary
 */

namespace OstArticleAssemblySurcharge\Services;

use Enlight_Components_Session_Namespace as Session;



/**
 * Einrichtungshaus Ostermann GmbH & Co. KG - Article Assembly Surcharge
 */

class SessionService
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

    private $index = "ost-article-assembly-surcharge";



    /**
	 * ...
	 *
	 * @param Session $session
	 */

	public function __construct( Session $session )
	{
		// set params
		$this->session = $session;
	}



    /**
     * ...
     *
     * @return array
     */

    public function get()
    {
        return (array) $this->session->offsetGet( $this->index );
    }



    /**
     * ...
     *
     * @param array   $data
     *
     * @return void
     */

    public function set( array $data )
    {
        $this->session->offsetSet( $this->index, $data );
    }



    /**
     * ...
     *
     * @param string $number
     *
     * @return boolean
     */

    public function has( $number )
    {
        return ( ( $this->session->offsetExists( $this->index ) ) and ( is_array( $this->session->offsetGet( $this->index ) ) ) and ( in_array( $number, $this->session->offsetGet( $this->index ) ) ) );
    }



    /**
     * ...
     *
     * @param string $number
     *
     * @return void
     */

    public function add( $number )
    {
        // already set?
        if ( $this->has( $number ) )
            // ignore it
            return;

        // get the session
        $session = $this->get();

        // add and unique our article number
        array_push( $session, $number );
        $session = array_unique( $session );

        // save back to session
        $this->set( $session );
    }



    /**
     * ...
     *
     * @param string $number
     *
     * @return void
     */

    public function remove( $number )
    {
        // not set?
        if ( $this->has( $number ) == false )
            // ignore it
            return;

        // get the session
        $session = $this->get();

        // remove article number
        unset( $session[array_search( $number, $session )]);

        // save back to session
        $this->set( $session );
    }

}
