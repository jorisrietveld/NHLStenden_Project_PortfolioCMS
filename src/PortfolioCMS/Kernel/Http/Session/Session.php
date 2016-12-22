<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 03-12-2016 04:52
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Kernel\Http\Session;


use StendenINF1B\PortfolioCMS\Kernel\Http\Session\Storage\SessionMetadataContainer;

class Session implements SessionInterface
{
    protected $containers;
    protected $started;

    protected $validSessionOptions = [
        'session.cache_limiter',
        'session.cookie_domain',
        'session.cookie_httponly',
        'session.cookie_lifetime',
        'session.cookie_path',
        'session.cookie_secure',
        'session.entropy_file',
        'session.entropy_length',
        'session.gc_divisor',
        'session.gc_maxlifetime',
        'session.gc_probability',
        'session.hash_bits_per_character',
        'session.hash_function',
        'session.name',
        'session.referer_check',
        'session.serialize_handler',
        'session.use_cookies',
        'session.use_only_cookies',
        'session.use_trans_sid',
        'session.upload_progress.enabled',
        'session.upload_progress.cleanup',
        'session.upload_progress.prefix',
        'session.upload_progress.name',
        'session.upload_progress.freq',
        'session.upload_progress.min-freq',
        'session.url_rewriter.tags',
    ];

    public function __construct( \SessionHandlerInterface $handler = NULL, array $options = [], SessionMetadataContainer $metadataContainer )
    {
        session_register_shutdown();
        $this->setOptions( $options );
        $this->registerContainer( $metadataContainer );
    }

    /**
     * Check if the session is started.
     * @return bool
     */
    public function isStarted(): bool
    {
        return $this->started;
    }

    /**
     * Start the session.
     * @return bool
     */
    public function start() : bool
    {
        if( $this->isStarted() )
        {
            return TRUE;
        }

        if( \PHP_SESSION_ACTIVE == session_status() )
        {
            throw new \RuntimeException( 'Cannot start the session because the session is already started.' );
        }

        if( !session_start() )
        {
            throw new \RuntimeException( 'The session failed to start.' );
        }
        return TRUE;
    }

    /**
     * Set the save path for the session file storage.
     * @param string|null $savePath
     */
    public function setSavePath( string $savePath = NULL )
    {
        if( $savePath === NULL )
        {
            $savePath = ini_get('session.save_path');
        }

        ini_set('session.save_path', $savePath);
        ini_set('session.save_handler', 'files');
    }

    /**
     * Set all valid session options with ini_set()
     * @param array $sessionOptions
     */
    public function setOptions( array $sessionOptions )
    {
        foreach ($sessionOptions as $option => $optionValue )
        {
            if( in_array( $option, $this->validSessionOptions, FALSE ) )
            {
                ini_set( $option, $optionValue );
            }
        }
    }

    /**
     * @return bool
     */
    public function destroy() : bool
    {
        $this->containers = [];
        session_destroy();

    }

    /**
     * @return bool
     */
    public function regenerate( bool $destroyData = FALSE, int $cookieLifetime = 0 ) : bool
    {
        session_regenerate_id( $destroyData );
    }

    /**
     * @return mixed
     */
    public function clear()
    {
        foreach ( $this->containers as $container )
        {
            if( !is_a('\\HTTP\\Session\\SessionMetadataContainer', $container) )
            {
                $container->clear();
            }
        }
    }

    /**
     * @return SessionContainerInterface
     */
    public function getContainer(): SessionContainerInterface
    {
        // TODO: Implement getContainer() method.
    }

    public function registerContainer( SessionContainerInterface $sessionContainer )
    {
        if( is_a( '\\HTTP\\Session\\SessionMetadataContainer', $sessionContainer ))
        {
            $this->metaDataContainer = $sessionContainer;
        }
        else
        {
            $this->containers[ $sessionContainer->getName() ] = $sessionContainer;
        }
    }

    /**
     * @param int $sessionId
     * @return mixed
     */
    public function setId( int $sessionId )
    {
        // TODO: Implement setId() method.
    }

    /**
     * @return int
     */
    public function getId() : int
    {
        // TODO: Implement getId() method.
    }

    /**
     * @param string $sessionName
     * @return mixed
     */
    public function setName( string $sessionName )
    {
        // TODO: Implement setName() method.
    }

    /**
     * @return string
     */
    public function getName() : string
    {
        // TODO: Implement getName() method.
    }

    /**
     * @param string $attributeKey
     * @return bool
     */
    public function has( string $attributeKey ) : bool
    {
        // TODO: Implement has() method.
    }

    /**
     * @return array
     */
    public function all() : array
    {
        // TODO: Implement all() method.
    }

    /**
     * @param string $attributeName
     * @param null   $default
     * @return mixed
     */
    public function get( string $attributeName, $default = null )
    {
        // TODO: Implement get() method.
    }

    /**
     * @param array $attributesArray
     * @return mixed
     */
    public function replace( array $attributesArray )
    {
        // TODO: Implement replace() method.
    }

    /**
     * @param string $attributeKey
     * @return mixed
     */
    public function remove( string $attributeKey )
    {
        // TODO: Implement remove() method.
    }

    /**
     * @return SessionMetadataContainer
     */
    public function getMetadata() : SessionMetadataContainer
    {
        // TODO: Implement getMetadata() method.
    }

    /**
     * Load the containers to $_SESSION
     * @param array|null $session
     */
    public function load( array &$session = NULL )
    {
        if( $session == NULL )
        {
            $session = &$_SESSION;
        }

        $containers = array_merge( $this->containers, [ $this->metaDataContainer ]);

        // Save all containers in the session.
        foreach ($containers as $container)
        {
            $containerKey = $container->getStorageKey();
            $session[ $containerKey ] = $session[ $containerKey ] ?? [];
            $container->init();

        }

        $this->started = TRUE;
    }

}