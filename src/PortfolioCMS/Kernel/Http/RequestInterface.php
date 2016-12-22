<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 07-12-2016 16:42
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Kernel\Http;


use StendenINF1B\PortfolioCMS\Kernel\Http\File\FilesContainer;
use StendenINF1B\PortfolioCMS\Kernel\Http\Session\Session;

interface RequestInterface
{
    /**
     * Gets the request $_GET params in an HTTP\ParameterContainer.
     *
     * @return ParameterContainer
     */
    public function getQueryParams() : ParameterContainer;

    /**
     * Gets the requests $_POST params in an HTTP\ParameterContainer.
     *
     * @return ParameterContainer
     */
    public function getPostParams() : ParameterContainer;

    /**
     * Gets the requests $_FILE parameters in an HTTP\File\FilesContainer.
     *
     * @return FilesContainer
     */
    public function getFiles() : FilesContainer;

    /**
     * Gets the $_SERVER parameters in an HTTP\ServerContainer
     *
     * @return ServerContainer
     */
    public function getServer() : ServerContainer;

    /**
     * Gets the headers from an request in an HTTP\HeaderContainer.
     * @return HeaderContainer
     */
    public function getHeaders() : ParameterContainer;

    /**
     * Sets new headers.
     * @param ParameterContainer $headers
     */
    public function setHeaders( ParameterContainer $headers );

    /**
     * Gets the $_COOKIE parameters in an HTTP\ParameterContainer.
     * @return ParameterContainer
     */
    public function getCookies() : ParameterContainer;

    /**
     * Gets the Session from the current request.
     *
     * @return Session
     */
    public function getSession( ) : Session;

    /**
     * Checks if the request has an Session.
     *
     * @return bool
     */
    public function hasSession() : bool;

    /**
     * Sets an session to the request.
     *
     * @param Session $session
     */
    public function setSession( Session $session );

    /**
     * Gets the body of the request or an empty string.
     *
     * @return string
     */
    public function getContent() : string;

    /**
     * Gets the uniform resource identifier.
     * like: /page?param=true&true=false
     *
     * @return string
     */
    public function getRequestUri() : string;

    /**
     * Gets the full uniform resource identifier.
     * like: http://hostname.nl/some/path?getparams=true
     *
     * @return string
     */
    public function getUri() : string;

    /**
     * Gets the Scheme so either http or https.
     *
     * @return string
     */
    public function getScheme() : string;

    /**
     * Gets the base path from the request.
     * Like: http://www.hostname.nl/some/path?answerToLife=42 -> some/path
     * @return string
     */
    public function getBasePath(  ) : string;

    /**
     * Gets the scheme and hostname.
     * like: http://site.com
     *
     * @return string
     */
    public function getBaseUri() : string;

    /**
     * Gets the accepted charset from the user.
     * @return string
     */
    //public function getCharsets(  ) : array;

    /**
     * Gets the name that is executed by the user.
     *
     * @return string
     */
    public function getScriptName( ) : string;

    /**
     * Gets the clients ip address.
     *
     * @return string
     */
    public function getClientIp() : string;

    /**
     * Gets the servers IP address.
     *
     * @return string
     */
    public function getServerIp() : string;

    /**
     * Gets the query string (the string from the URI containing the $_GET params).
     *
     * @return string
     */
    public function getQueryString() : string;

    /**
     * Gets the hostname of the server.
     *
     * @return string
     */
    public function getHostname() : string;

    /**
     * Gets the default locale parsed from the header.
     *
     * @return string
     */
    //public function getLanguages() : array;

    /**
     * Gets the request method.
     *
     * @return string
     */
    public function getMethod() : string;

    /**
     * Initiates the request, it will do everything an constructor will normally do but it does it in an normal method for ]
     * more flexibility.
     *
     * @param array  $query
     * @param array  $postParams
     * @param array  $cookies
     * @param array  $files
     * @param array  $server
     * @param string $content
     * @return mixed
     */
    public function init( array $query = [], array $postParams = [], array $cookies = [], array $files = [], array $server = [], string $content = '' );
    /**
     * Returnes an Request object with created from globals like $_GET, $_POST, $_COOKIE, $FILES and server.
     *
     * @return Request
     */
    public static function createFromGlobals();

    /**
     * Returnes an request based on the arguments passed.
     * @param string $uri
     * @param string $method
     * @param array  $postParams
     * @param array  $cookies
     * @param array  $files
     * @param string $body
     * @return Request
     */
    public static function create( string $uri, string $method = 'GET', array $postParams = [], array $cookies = [], array $files = [], string $body = '' ) : Request;
}