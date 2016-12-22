<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 16-12-2016 16:34
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Kernel\Http\Session\Storage;


class DefaultSessionStorage
{
    /**
     * Holds the registered session containers.
     *
     * @var array
     */
    protected $storageContainers;

    /**
     * Holds the session storage handler.
     *
     * @var \SessionHandlerInterface
     */
    protected $saveHandler;

    /**
     * Gets set to true when the session is started.
     *
     * @var bool
     */
    protected $isStarted = FALSE;

    /**
     * The valid sessions ini options for validating the if the user supplied correct sessions options.
     *
     * @var array
     */
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

    /**
     * DefaultSessionStorage constructor.
     *
     * @param array                         $options
     * @param \SessionHandlerInterface|null $handler
     * @param SessionMetadataContainer|null $metadataContainer
     */
    public function __construct( array $options = [], \SessionHandlerInterface $handler = NULL, SessionMetadataContainer $metadataContainer = NULL )
    {
        session_register_shutdown();
        
    }

    /**
     * You can set your session ini options here if it it is an valid option. see the $validSessionOptions property for
     * The valid session options.
     *
     * @param array $options
     */
    public function setOptions( array $options )
    {
        foreach ( $options as $option => $optionValue )
        {
            if( in_array( $option, $this->validSessionOptions, FALSE ) )
            {
                ini_set( $option, $optionValue );
            }
            else
            {
                throw new \InvalidArgumentException( sprintf( 'The option: %s is not an valid option.' , $option ) );
            }
        }
    }

    /**
     * @param \SessionHandlerInterface $handler
     */
    public function setSaveHandler( \SessionHandlerInterface $handler )
    {
        $this->saveHandler = $handler;
    }

    /**
     * @return \SessionHandlerInterface
     */
    public function getSaveHandler(  ) : \SessionHandlerInterface
    {
        return $this->saveHandler;
    }

    /**
     * Checks weather an session is started or not.
     *
     * @return bool
     */
    public function isStarted(  ) : bool
    {
        return $this->isStarted;
    }

    /**
     * Clears all stored data from all container except the metadata container.
     */
    public function clear(  )
    {
        foreach ( $this->storageContainers as $storageKey => $storageContainer )
        {
            if( !is_a('\\StendenINF1B\\PortfolioCMS\\Kernel\\Http\\Session\\Storage\\SessionMetadataContainer', $storageContainer ) )
            {
                $this->storageContainers[ $storageKey ]->clear();
            }
        }
    }

    /**
     * Starts the session
     */
    public function start(  )
    {
        if( $this->isStarted() )
        {
            return;
        }

        if( ini_get('session.use_cookies') && headers_sent( $fileName, $line ) )
        {
            throw new \RuntimeException( sprintf( 'You cannot start the session because the session uses cookies and the headers are already send in file: %s on line: %s', $fileName, $line ));
        }

        if( session_status() === \PHP_SESSION_ACTIVE )
        {
            throw new \RuntimeException( 'You cannot start the session because it was already started.' );
        }

        if( session_start() === FALSE )
        {
            throw new \RuntimeException( 'The session failed to start.' );
        }

        $this->loadSession();
    }

    /**
     * Initiates the session storage. You van pass an old $_SESSION by reference as argument.
     *
     * @param array|null $session
     */
    public function loadSession( array &$session = NULL )
    {
        if( $session === NULL )
        {
            $session = &$_SESSION;
        }

        foreach ( $this->storageContainers as $container )
        {
            $session[ $container->getKey() ] = isset( $session[ $container->getKey() ] ) ? $session[ $container->getKey() ] : [];
            $container->initialize( $session );
        }

        $this->isStarted = TRUE;
    }

    /**
     * Gets an registered container.
     *
     * @param string $containerKey
     * @return SessionContainerInterface
     */
    public function getContainer( string $containerKey ) : SessionContainerInterface
    {
        if( !isset( $this->storageContainers[ $containerKey ] ) )
        {
            throw new \InvalidArgumentException( sprintf( 'The session container: %s is not registered in this session.', $containerKey ) );
        }
        return $this->storageContainers[ $containerKey ];
    }

    /**
     * Registers a new storage container.
     * 
     * @param SessionContainerInterface $container
     */
    public function setContainer( SessionContainerInterface $container )
    {
        if( $this->isStarted() )
        {
            throw new \LogicException( 'You cannot register new session containers when the session is already started.' );
        }

        $this->storageContainers[ $container->getKey() ] = $container;
    }

    /**
     * Gets the metadata for this session.
     *
     * @return SessionMetadataContainer
     */
    public function getMetadataContainer(  ) : SessionMetadataContainer
    {
        foreach ( $this->storageContainers as $storageContainer )
        {
            if( is_a('\\StendenINF1B\\PortfolioCMS\\Kernel\\Http\\Session\\Storage\\SessionMetadataContainer', $storageContainer ) )
            {
                return $storageContainer;
            }
        }
        throw new \LogicException( 'There is no metadata container registered in this session.' );
    }
}