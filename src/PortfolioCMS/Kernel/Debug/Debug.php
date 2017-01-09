<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 10-12-2016 16:30
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Kernel\Debug;


use DebugBar\DebugBar;
use DebugBar\StandardDebugBar;

/**
 * Class Debug this is an singleton wrapper for the debugbar.
 * It is compatible with the fig-standards Psr-3-logger
 *
 * @package StendenINF1B\PortfolioCMS\Kernel\Debug
 */
class Debug
{
    /**
     * This holds the debug bar instance that will be shared with the whole application for displaying debug information.
     *
     * @var StandardDebugBar
     */
    protected static $debugBar;

    /**
     * Debug constructor.
     */
    protected function __construct(  )
    {
        self::$debugBar = new StandardDebugBar();
    }

    /**
     * Retunes the singleton debugbar instance.
     * 
     * @return StandardDebugBar
     */
    public static function getDebugBar()
    {
        self::init();
        return self::$debugBar;
    }

    /**
     * Initiate the debugbar.
     */
    protected static function init(  )
    {
        if( self::$debugBar === NULL )
        {
            new Debug();
        }
    }
    /**
     * Detailed debug information.
     *
     * @param string $message
     * @param array $context
     */
    public static function debug( string $message = '', array $context = [] )
    {
        if( DEBUG )
        {
            self::init();
            self::$debugBar['messages']->debug( $message );
        }
    }

    /**
     * Normal but significant events.
     *
     * @param string $message
     * @param array $context
     */
    public static function notice( string $message = '', array $context = [] )
    {
        if( DEBUG )
        {
            self::init();
            self::$debugBar['messages']->notice( $message );
        }
    }

    /**
     * System is unusable.
     *
     * @param string $message
     * @param array $context
     */
    public static function emergency( string $message, array $context = [] )
    {
        if( DEBUG )
        {
            self::init();
            self::$debugBar['messages']->emergency( $message );
        }
    }

    /**
     * Action must be taken immediately.
     *
     * Example: Entire website down, database unavailable, etc. This should
     * trigger the SMS alerts and wake you up.
     *
     * @param string $message
     * @param array $context
     */
    public static function alert( string $message, array $context = [] )
    {
        if( DEBUG )
        {
            self::init();
            self::$debugBar['messages']->alert( $message );
        }
    }

    /**
     * Critical conditions.
     *
     * Example: Application component unavailable, unexpected exception.
     *
     * @param string $message
     * @param array $context
     */
    public static function critical( string $message, array $context = [] )
    {
        if( DEBUG )
        {
            self::init();
            self::$debugBar['messages']->critical( $message );
        }
    }

    /**
     * Runtime errors that do not require immediate action but should typically
     * be logged and monitored.
     *
     * @param string $message
     * @param array $context
     */
    public static function error( string $message, array $context = [] )
    {
        if( DEBUG )
        {
            self::init();
            self::$debugBar['messages']->error( $message );
        }
    }

    /**
     * Exceptional occurrences that are not errors.
     *
     * Example: Use of deprecated APIs, poor use of an API, undesirable things
     * that are not necessarily wrong.
     *
     * @param string $message
     * @param array $context
     */
    public static function warning( string $message, array $context = [] )
    {
        if( DEBUG )
        {
            self::init();
            self::$debugBar['messages']->warning( $message );
        }
    }

    /**
     * Interesting events.
     *
     * Example: User logs in, SQL logs.
     *
     * @param string $message
     * @param array $context
     */
    public static function info( string $message, array $context = [] )
    {
        if( DEBUG )
        {
            self::init();
            self::$debugBar['messages']->info( $message );
        }
    }

    /**
     * Adds an new exception to the debugbar instance.
     *
     * @param \Exception $exception
     */
    public static function addException( \Exception $exception )
    {
        if( DEBUG )
        {
            self::init();
            self::$debugBar['exceptions']->addException( $exception );
        }
    }
}
