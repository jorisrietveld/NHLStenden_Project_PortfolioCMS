<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 18-11-2016 19:46
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );
namespace StendenINF1B\PortefolioCMS\Http;


class Response implements ResponseInterface
{
    /**
     * Constants with all HTTP Status codes, source: https://en.wikipedia.org/wiki/List_of_HTTP_status_codes
     */
    const HTTP_STATUS_CONTINUE = 100;
    const HTTP_STATUS_SWITCHING_PROTOCOLS = 101;
    const HTTP_STATUS_PROCESSING = 102;
    const HTTP_STATUS_OK = 200;
    const HTTP_STATUS_CREATED = 201;
    const HTTP_STATUS_ACCEPTED = 202;
    const HTTP_STATUS_NON_AUTHORITATIVE_INFORMATION = 203;
    const HTTP_STATUS_NO_CONTENT = 204;
    const HTTP_STATUS_RESET_CONTENT = 205;
    const HTTP_STATUS_PARTIAL_CONTENT = 206;
    const HTTP_STATUS_MULTI_STATUS = 207;
    const HTTP_STATUS_ALREADY_REPORTED = 208;
    const HTTP_STATUS_IM_USED = 226;
    const HTTP_STATUS_MULTIPLE_CHOICES = 300;
    const HTTP_STATUS_MOVED_PERMANENTLY = 301;
    const HTTP_STATUS_FOUND = 302;
    const HTTP_STATUS_SEE_OTHER = 303;
    const HTTP_STATUS_NOT_MODIFIED = 304;
    const HTTP_STATUS_USE_PROXY = 305;
    const HTTP_STATUS_SWITCH_PROXY = 306;
    const HTTP_STATUS_TEMPORARY_REDIRECT = 307;
    const HTTP_STATUS_PERMANENTLY_REDIRECT = 308;
    const HTTP_STATUS_BAD_REQUEST = 400;
    const HTTP_STATUS_UNAUTHORIZED = 401;
    const HTTP_STATUS_PAYMENT_REQUIRED = 402;
    const HTTP_STATUS_FORBIDDEN = 403;
    const HTTP_STATUS_NOT_FOUND = 404;
    const HTTP_STATUS_METHOD_NOT_ALLOWED = 405;
    const HTTP_STATUS_NOT_ACCEPTABLE = 406;
    const HTTP_STATUS_PROXY_AUTHENTICATION_REQUIRED = 407;
    const HTTP_STATUS_REQUEST_TIMEOUT = 408;
    const HTTP_STATUS_CONFLICT = 409;
    const HTTP_STATUS_GONE = 410;
    const HTTP_STATUS_LENGTH_REQUIRED = 411;
    const HTTP_STATUS_PRECONDITION_FAILED = 412;
    const HTTP_STATUS_PAYLOAD_TOO_LARGE = 413;
    const HTTP_STATUS_URI_TOO_LONG = 414;
    const HTTP_STATUS_UNSUPPORTED_MEDIA_TYPE = 415;
    const HTTP_STATUS_REQUESTED_RANGE_NOT_SATISFIABLE = 416;
    const HTTP_STATUS_EXPECTATION_FAILED = 417;
    const HTTP_STATUS_I_AM_A_TEAPOT = 418; // Important HTTP STATUS code!
    const HTTP_STATUS_MISDIRECTED_REQUEST = 421;
    const HTTP_STATUS_UNPROCESSABLE_ENTITY = 422;
    const HTTP_STATUS_LOCKED = 423;
    const HTTP_STATUS_FAILED_DEPENDENCY = 424;
    const HTTP_STATUS_UPGRADE_REQUIRED = 426;
    const HTTP_STATUS_PRECONDITION_REQUIRED = 428;
    const HTTP_STATUS_TOO_MANY_REQUESTS = 429;
    const HTTP_STATUS_REQUEST_HEADER_FIELDS_TOO_LARGE = 431;
    const HTTP_STATUS_UNAVAILABLE_FOR_LEGAL_REASONS = 451;
    const HTTP_STATUS_INTERNAL_SERVER_ERROR = 500;
    const HTTP_STATUS_NOT_IMPLEMENTED = 501;
    const HTTP_STATUS_BAD_GATEWAY = 502;
    const HTTP_STATUS_SERVICE_UNAVAILABLE = 503;
    const HTTP_STATUS_GATEWAY_TIMEOUT = 504;
    const HTTP_STATUS_HTTP_VERSION_NOT_SUPPORTED = 505;
    const HTTP_STATUS_VARIANT_ALSO_NEGOTIATES = 506;
    const HTTP_STATUS_INSUFFICIENT_STORAGE = 507;
    const HTTP_STATUS_LOOP_DETECTED = 508;
    const HTTP_STATUS_NOT_EXTENDED = 510;
    const HTTP_STATUS_NETWORK_AUTHENTICATION_REQUIRED = 511;

    /**
     * The HTTP status texts lend from the Symfony framework.
     * @var array
     */
    public static $statusTexts = [
        100 => 'Continue',
        101 => 'Switching Protocols',
        102 => 'Processing',
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',
        207 => 'Multi-Status',
        208 => 'Already Reported',
        226 => 'IM Used',
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Found',
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        307 => 'Temporary Redirect',
        308 => 'Permanent Redirect',
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Timeout',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Payload Too Large',
        414 => 'URI Too Long',
        415 => 'Unsupported Media Type',
        416 => 'Range Not Satisfiable',
        417 => 'Expectation Failed',
        418 => 'I\'m a teapot',
        421 => 'Misdirected Request',
        422 => 'Unprocessable Entity',
        423 => 'Locked',
        424 => 'Failed Dependency',
        425 => 'Reserved for WebDAV advanced collections expired proposal',
        426 => 'Upgrade Required',
        428 => 'Precondition Required',
        429 => 'Too Many Requests',
        431 => 'Request Header Fields Too Large',
        451 => 'Unavailable For Legal Reasons',
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Timeout',
        505 => 'HTTP Version Not Supported',
        506 => 'Variant Also Negotiates (Experimental)',
        507 => 'Insufficient Storage',
        508 => 'Loop Detected',
        510 => 'Not Extended',
        511 => 'Network Authentication Required',
    ];

    protected $content;

    protected $headers;

    protected $HTTPStatusCode;

    protected $method;

    protected $protocolVersion;


    /**
     * Response constructor.
     *
     * @param string $content
     * @param int    $status
     * @param array  $headers
     */
    public function __construct( string $content = '', $status = self::HTTP_STATUS_OK, array $headers = [] )
    {
        $this->setHeaders( $headers );
    }

    /**
     * Sets the responses content, it overwrites existing content if that exists.
     *
     * @param string $content
     */
    public function setContent( string $content )
    {
        $this->content = $content;
    }

    /**
     * Adds content to the request without overwriting the existing content.
     *
     * @param string $content
     */
    public function addContent( string $content )
    {
        $this->content .= $content;
    }

    public function setStatusCode( int $statusCode )
    {
        if( !array_key_exists( $statusCode, self::$statusTexts ))
        {
            throw new \InvalidArgumentException( 'The status code passed as argument is not an valid HTTP status code.' );
        }
        $this->statusCode = $statusCode;
    }

    public function setProtocolVersion( string $httpProtocolVersion )
    {
        $this->protocolVersion = $httpProtocolVersion;
    }

    /**
     * Sets the headers for the request overwriting the existing headers.
     *
     * @param array $headers
     */
    public function setHeaders( array $headers )
    {
        $this->headers = new HeaderContainer( $headers );
    }

    /**
     * Adds extra headers to the request without overwriting the existing ones.
     *
     * @param array $headers
     */
    public function addHeaders( array $headers )
    {
        if( $this->headers == NULL )
        {
            $this->headers = new HeaderContainer( $headers );
        }
        else
        {
            $this->headers->addHeaders( $headers );
        }
    }

    /**
     * Adds an single header to the request.
     *
     * @param string $header
     */
    public function addHeader( string $header )
    {
        // TODO: Implement addHeader() method.
    }

    /**
     * Gets the headers in an HeaderContainer saved in the response.
     *
     * @return HeaderContainer
     */
    public function getHeaders() : HeaderContainer
    {
        // TODO: Implement getHeaders() method.
    }

    /**
     * Prepares the response with parameters from the request.
     *
     * @param Request $request
     */
    public function prepare( Request $request )
    {
        // TODO: Implement prepare() method.
    }

    /**
     * Sends the headers from the request.
     */
    public function sendHeaders()
    {
        // TODO: Implement sendHeaders() method.
    }

    /**
     * Sends the body from the request.
     */
    public function sendBody()
    {
        echo $this->content;
    }

    /**
     * Sends the headers and body of the request.
     */
    public function send()
    {
        $this->sendHeaders();
        $this->sendBody();
    }

}