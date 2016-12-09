<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 18-11-2016 19:46
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );
namespace StendenINF1B\PortefolioCMS\Kernel\Http;


use StendenINF1B\PortefolioCMS\Kernel\Http\File\FilesContainer;
use StendenINF1B\PortefolioCMS\Kernel\Http\Session\Session;

class Request implements RequestInterface
{
    /**
     * This holds an ParameterContainer with all the $_GET params.
     *
     * @var ParameterContainer
     */
    public $getParams;

    /**
     * This holds an ParameterContainer with all the $_POST params.
     *
     * @var ParameterContainer
     */
    public $postParams;

    /**
     * This holds an FilesContainer with all the $_FILES stored as uploaded files.
     *
     * @var FilesContainer
     */
    public $files;

    /**
     * This holds the Session.
     *
     * @var Session
     */
    public $session;

    /**
     * This holds the HeadersContainer with information about the headers send.
     *
     * @var
     */
    public $headers;

    /**
     * This holds an ParameterContainer with all the $_SERVER params.
     *
     * @var ServerContainer
     */
    public $server;

    /**
     * This holds an ParameterContainer with all the $_COOKIE params.
     *
     * @var ParameterContainer
     */
    public $cookies;

    /**
     * This holds the body send in the request.
     *
     * @var string
     */
    public $content;

    /**
     * The holds an string containing the full request URI.
     * www.site.com/home?logout=true -> /home?logout=true
     *
     * @var string
     */
    protected $requestUri;

    /**
     * This holds an string containing the URI without the query string.
     * www.site.com/home?logout=true -> /home
     *
     * @var string
     */
    protected $baseUrl;

    /**
     * This holds the full uri so the {scheme}://{hostname}/{path}?get
     * www.site.com/home?logout=true -> http://www.site.com/home?logout=true
     * @var string
     */
    protected $uri;

    /**
     * This holds the uri without the get params so {scheme}://{hostname}/{path}
     * www.site.com/home?logout=true -> http://www.site.com/home
     *
     * @var
     */
    protected $baseUri;

    /**
     * This holds an string with the query params (the $_GET params).
     * www.site.com/home?logout=true&user=bob -> ?logout=true&user=bob
     *
     * @var string
     */
    protected $queryString;


    /**
     * This holds an string containing the request method like GET, POST, PUT or DELETE.
     *
     * @var string
     */
    protected $method;

    /**
     * This contains the language that the user browser
     * @var array
     */
    protected $languages;

    /**
     * This holds an string containing the useragent with information about the operating system and browser.
     *
     * @var string
     */
    protected $userAgent;

    /**
     * This holds an string containing the requests scheme.
     * http://www.site.com/home -> http
     *
     * @var string
     */
    protected $requestScheme;

    /**
     * This holds an string containing the requests protocol like: HTTP/1.1 or HTTP/2.0
     *
     * @var string
     */
    protected $protocol;

    /**
     * This will hold the content type of the request, note that GET requests don't have an content type.
     *
     * @var string
     */
    protected $contentType;

    /**
     * This will hold an string containing the port the clients uses to connect.
     *
     * @var string
     */
    protected $clientPort;

    /**
     * This will hold an string containing the clients ip address.
     *
     * @var string
     */
    protected $clientIp;

    /**
     * This will hold an string containing the servers ip address.
     *
     * @var string
     */
    protected $serverIp;

    /**
     * This will contain an string holding the hostname of the server.
     *
     * @var string
     */
    protected $hostname;


    /**
     * Request constructor.
     *
     * @param array  $getParams
     * @param array  $postParams
     * @param array  $cookies
     * @param array  $files
     * @param array  $server
     * @param string $content
     */
    public function __construct( array $getParams = [], array $postParams = [], array $cookies = [], array $files = [], array $server = [], string $content = '' )
    {
        $this->init( $getParams, $postParams, $cookies, $files, $server, $content );
    }

    /**
     * Gets the request $_GET params in an HTTP\ParameterContainer.
     *
     * @return ParameterContainer
     */
    public function getGetParams() : ParameterContainer
    {
        return $this->getGetParams();
    }

    /**
     * Gets the requests $_POST params in an HTTP\ParameterContainer.
     *
     * @return ParameterContainer
     */
    public function getPostParams() : ParameterContainer
    {
        return $this->postParams;
    }

    /**
     * Gets the requests $_FILE parameters in an HTTP\File\FilesContainer.
     *
     * @return FilesContainer
     */
    public function getFiles() : FilesContainer
    {
        return $this->files;
    }

    /**
     * Gets the $_SERVER parameters in an HTTP\ServerContainer
     *
     * @return ServerContainer
     */
    public function getServer() : ServerContainer
    {
        return $this->server;
    }

    /**
     * Gets the headers from an request in an HTTP\HeaderContainer.
     *
     * @return HeaderContainer
     */
    public function getHeaders() : HeaderContainer
    {
        return $this->headers;
    }

    /**
     * Gets the $_COOKIE parameters in an HTTP\ParameterContainer.
     *
     * @return ParameterContainer
     */
    public function getCookies() : ParameterContainer
    {
        return $this->cookies;
    }

    /**
     * Gets the Session from the current request.
     *
     * @return Session
     */
    public function getSession() : Session
    {
        if( $this->session )
        {
            return $this->session;
        }
        throw new \LogicException( 'Cannot return an session because ther is no session associated with this reques.' );
    }

    /**
     * Checks if the request has an Session.
     *
     * @return bool
     */
    public function hasSession() : bool
    {
        return isset( $this->session );
    }

    /**
     * Sets an session to the request.
     *
     * @param Session $session
     */
    public function setSession( Session $session )
    {
        $this->session = $session;
    }

    /**
     * Gets the body of the request or an empty string.
     *
     * @return string
     */
    public function getContent() : string
    {
        return $this->content;
    }

    /**
     * Gets the uniform resource identifier.
     *
     * @return string
     */
    public function getRequestUri() : string
    {
        return $this->requestUri;
    }

    /**
     * Gets the uniform resource identifier without the $_GET string (query string).
     *
     * @return string
     */
    public function getUri() : string
    {
        return $this->baseRequestUri;
    }

    /**
     * Gets the clients ip address.
     *
     * @return string
     */
    public function getClientIp() : string
    {
        return $this->server->get( 'REMOTE_ADDR', '' );
    }

    /**
     * Gets the servers IP address.
     *
     * @return string
     */
    public function getHttpHost() : string
    {
        return $this->server->get( 'HTTP_HOST', '' );
    }

    /**
     * Gets the query string (the string from the URI containing the $_GET params).
     *
     * @return string
     */
    public function getQueryString() : string
    {
        return $this->queryString;
    }

    /**
     * Gets the hostname of the server.
     *
     * @return string
     */
    public function getHostname() : string
    {
        // TODO: Implement getHostname() method.
    }

    /**
     * Gets the default locale parsed from the header.
     *
     * @return string
     */
    public function getDefaultLocale() : string
    {
        return $this->locale;
    }

    /**
     * Gets the request method.
     *
     * @return string
     */
    public function getMethod() : string
    {
        return $this->method;
    }

    /**
     * Initiates the request.
     *
     * @param array $getParams
     * @param array $postParams
     * @param array $headers
     * @param array $cookies
     * @param array $files
     * @param array $server
     * @return mixed
     */
    public function init( array $getParams = [], array $postParams = [], array $cookies = [], array $files = [], array $server = [], string $content = '' )
    {
        $this->getParams = new ParameterContainer( $getParams );
        $this->postParams = new ParameterContainer( $postParams );
        $this->cookies =  new ParameterContainer( $cookies );
        $this->files = new FilesContainer( $files );
        $this->server = new ServerContainer( $server );
        $this->content = $content;

        $this->requestScheme = $this->server->get( 'REQUEST_SCHEME' );//
        $this->protocol = $this->server->get('SERVER_PROTOCOL', '');//
        $this->clientPort = $this->server->get('REMOTE_PORT', '');//
        $this->clientIp = $this->server->get('REMOTE_ADDR', '');//
        $this->serverIp = $this->server->get('SERVER_ADDR', ''); //
        $this->queryString = $this->server->get( 'QUERY_STRING', '' ); //
        $this->baseUrl = parse_url( $this->server->get('REQUEST_URI'), PHP_URL_PATH);//
        $this->method = $this->server->get('REQUEST_METHOD', '' );//
        $this->userAgent = $this->server->get('HTTP_USER_AGENT', '');
        $this->requestUri = $this->server->get('REQUEST_URI', '' );//
        $this->contentType = $this->server->get( 'CONTENT_TYPE', '' );
        $this->hostname = $this->server->get( 'SERVER_NAME', '' );
        $this->baseUri = $this->requestScheme . '://' . $this->hostname . $this->baseUrl;
        $this->uri = $this->baseUri . $this->queryString;

        //todo implement the languages initiation.

        /**
         * uri                  = http://hostname.nl/page?getparams=true
         * scheme               = http
         * schemeAndHostname    = http://hostname.nl
         * Hostname             = hostname.nl
         * baseUri              = http://hostname.nl/page
         * queryString          = ?getparams=true
         * baseUrl              = /page
         * requestUri           = /page?getparams=true
         */
    }

    /**
     * Returnes an Request object with created from globals like $_GET, $_POST, $_COOKIE, $FILES and server.
     *
     * @return Request
     */
    public static function createFromGlobals()
    {
        return new Request(
            $_GET,
            $_POST,
            $_COOKIE,
            $_FILES,
            $_SERVER,
            file_get_contents("php://input")
        );
    }

    /**
     * Returnes an request based on the arguments passed.
     *
     * @param string $uri
     * @param string $method
     * @param array  $postParams
     * @param array  $cookies
     * @param array  $files
     * @param string $body
     * @return Request
     */
    public static function create( string $uri, string $method = 'GET', array $postParams = [], array $cookies = [], array $files = [], string $body = '' ) : Request
    {
        // Todo implement an way to create requests.
        return new Request();
    }
}
