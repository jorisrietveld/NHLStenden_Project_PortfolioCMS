<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 18-11-2016 19:46
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );
namespace StendenINF1B\PortefolioCMS\Kernel\Http;


class Cookie
{
    protected $name;

    protected $value;

    protected $expire;

    protected $path;

    protected $domain;

    protected $secure;

    protected $httpOnly;

    protected $raw;

    public function __construct( string $name, string $value = '', \DateTimeInterface $expire = NULL, string $path = '/', string $domain = '', bool $secure = FALSE, bool $httpOnly = TRUE, bool $raw = FALSE)
    {
        $this->setName( $name );
        $this->setValue( $value );

        if( $expire === NULL )
        {
            $this->setExpire( (new \DateTime('+2 weeks') ));
        }

        $this->setPath( $path );
        $this->setDomain( $domain );
        $this->setSecure( $secure );
        $this->setHttpOnly( $httpOnly );
        $this->setRaw( $raw );

    }

    /**
     * @return string $this->name
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Cookie
     */
    public function setName( string $name ) : Cookie
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string $this->value
     */
    public function getValue() : string
    {
        return $this->value;
    }

    /**
     * @param string $value
     * @return Cookie
     */
    public function setValue( string $value ) : Cookie
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getExpire() : \DateTimeInterface
    {
        return $this->expire;
    }

    /**
     * @param \DateTimeInterface $expire
     * @return Cookie
     */
    public function setExpire( \DateTimeInterface $expire ) : Cookie
    {
        $this->expire = $expire;
        return $this;
    }

    /**
     * @return string
     */
    public function getPath() : string
    {
        return $this->path;
    }

    /**
     * @param string $path
     * @return Cookie
     */
    public function setPath( string $path ) : Cookie
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @return string
     */
    public function getDomain() : string
    {
        return $this->domain;
    }

    /**
     * @param string $domain
     * @return Cookie
     */
    public function setDomain( string $domain ) : Cookie
    {
        $this->domain = $domain;
        return $this;
    }

    /**
     * @return bool
     */
    public function getSecure() : bool
    {
        return $this->secure;
    }

    /**
     * @param bool $secure
     * @return Cookie
     */
    public function setSecure( bool $secure ) : Cookie
    {
        $this->secure = $secure;
        return $this;
    }

    /**
     * @return bool
     */
    public function getHttpOnly() : bool
    {
        return $this->httpOnly;
    }

    /**
     * @param bool $httpOnly
     * @return Cookie
     */
    public function setHttpOnly( bool $httpOnly ) : Cookie
    {
        $this->httpOnly = $httpOnly;
        return $this;
    }

    /**
     * @return bool
     */
    public function getRaw() : bool
    {
        return $this->raw;
    }

    /**
     * @param bool $raw
     * @return Cookie
     */
    public function setRaw( bool $raw ) : Cookie
    {
        $this->raw = $raw;
        return $this;
    }

    /**
     * Returnes an cookie string that can be send to the user.
     */
    public function __toString(  ) : string
    {
        $cookieString = urlencode( $this->getName() ) . '=';

        if( empty( $this->value ))
        {
            $cookieString = 'deleted';
        }
        else
        {

        }
    }

}