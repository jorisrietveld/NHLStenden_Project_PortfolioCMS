<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 09-12-2016 07:59
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortefolioCMS\Http;


interface ResponseInterface
{
    /**
     * Sets the responses content, it overwrites existing content if that exists.
     *
     * @param string $content
     * @return mixed
     */
    public function setContent( string $content );

    /**
     * Adds content to the request without overwriting the existing content.
     *
     * @param string $content
     * @return mixed
     */
    public function addContent( string $content );

    /**
     * Sets the headers for the request overwriting the existing headers.
     *
     * @param array $headers
     */
    public function setHeaders( array $headers );

    /**
     * Adds extra headers to the request without overwriting the existing ones.
     *
     * @param array $headers
     */
    public function addHeaders( array $headers );

    /**
     * Adds an single header to the request.
     *
     * @param string $header
     */
    public function addHeader( string $header );

    /**
     * Gets the headers in an HeaderContainer saved in the response.
     *
     * @return HeaderContainer
     */
    public function getHeaders() : HeaderContainer;

    /**
     * Prepares the response with parameters from the request.
     * @param Request $request
     */
    public function prepare( Request $request );

    /**
     * Sends the headers from the request.
     */
    public function sendHeaders();

    /**
     * Sends the body from the request.
     */
    public function sendBody();

    /**
     * Sends the headers and body of the request.
     */
    public function send();

    public function setProtocolVersion( string $httpProtocolVersion );

    public function setStatusCode( int $statusCode );
}