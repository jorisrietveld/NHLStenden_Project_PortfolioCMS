<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 07-12-2016 16:42
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortefolioCMS\Http;


use StendenINF1B\PortefolioCMS\Http\File\FilesContainer;
use StendenINF1B\PortefolioCMS\Http\Session\Session;

interface RequestInterface
{
    /**
     * Gets the request $_GET params in an HTTP\ParameterContainer.
     *
     * @return ParameterContainer
     */
    public function getGetParams() : ParameterContainer;

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
    public function getHeaders() : HeaderContainer;

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
     *
     * @return string
     */
    public function getRequestUri() : string;

    /**
     * Gets the uniform resource identifier without the $_GET string (query string).
     *
     * @return string
     */
    public function getUri() : string;

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
    public function getHttpHost() : string;

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
    public function getDefaultLocale() : string;

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
     * @param array  $getParams
     * @param array  $postParams
     * @param array  $cookies
     * @param array  $files
     * @param array  $server
     * @param string $content
     * @return mixed
     */
    public function init( array $getParams = [], array $postParams = [], array $cookies = [], array $files = [], array $server = [], string $content = '' );
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