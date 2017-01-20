<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 06-01-2017 16:34
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Kernel\TemplateEngine;

use StendenINF1B\PortfolioCMS\Controller\Authentication;
use StendenINF1B\PortfolioCMS\Kernel\Debug\Debug;
use StendenINF1B\PortfolioCMS\Kernel\Helper\ParameterContainer;

class DataProvider extends ParameterContainer
{
    protected $user;

    public function __construct()
    {

    }

    /**
     * Gets stored data in the parameter property.
     *
     * @param      $key
     * @param null $default
     * @return mixed|null
     */
    public function get( $key, $default = NULL )
    {
        return parent::get( $key, 'Data not found.' );
    }

    /**
     * Checks if the session stored authorization level is one from an administrator.
     *
     * @return bool
     */
    public function isAdmin()
    {
        if ( isset( $_SESSION[ 'userId' ], $_SESSION[ 'authorizationLevel' ] ) )
        {
            if ( $_SESSION[ 'authorizationLevel' ] == Authentication::ADMIN )
            {
                return TRUE;
            }
        }
        return FALSE;
    }

    /**
     * Checks if the session stored authorization level is one from an SLB teacher.
     *
     * @return bool
     */
    public function isSlbTeacher()
    {
        if ( isset( $_SESSION[ 'userId' ], $_SESSION[ 'authorizationLevel' ] ) )
        {
            if ( $_SESSION[ 'authorizationLevel' ] == Authentication::SLB_TEACHER )
            {
                return TRUE;
            }
        }
        return FALSE;
    }

    /**
     * Checks if the session stored authorization level one from an teacher.
     *
     * @return bool
     */
    public function isTeacher()
    {
        if ( isset( $_SESSION[ 'userId' ], $_SESSION[ 'authorizationLevel' ] ) )
        {
            if ( $_SESSION[ 'authorizationLevel' ] == Authentication::TEACHER )
            {
                return TRUE;
            }
        }
        return FALSE;
    }

    /**
     * Checks if the session stored authorization level one from an student.
     *
     * @return bool
     */
    public function isStudent()
    {
        if ( isset( $_SESSION[ 'userId' ], $_SESSION[ 'authorizationLevel' ] ) )
        {
            if ( $_SESSION[ 'authorizationLevel' ] == Authentication::STUDENT )
            {
                return TRUE;
            }
        }
        return FALSE;
    }

    /**
     * Checks if the session stored authorization level one from an teacher or above.
     *
     * @return bool
     */
    public function isAtLeasedTeacher()
    {
        if ( isset( $_SESSION[ 'userId' ], $_SESSION[ 'authorizationLevel' ] ) )
        {
            if ( $_SESSION[ 'authorizationLevel' ] >= Authentication::TEACHER )
            {
                return TRUE;
            }
        }
        return FALSE;
    }

    /**
     * Checks if the session stored authorization level one from an student or above.
     *
     * @return bool
     */
    public function isAtLeasedStudent()
    {
        if ( isset( $_SESSION[ 'userId' ], $_SESSION[ 'authorizationLevel' ] ) )
        {
            if ( $_SESSION[ 'authorizationLevel' ] >= Authentication::STUDENT )
            {
                return TRUE;
            }
        }
        return FALSE;
    }

    /**
     * Checks if the session stored authorization level is from the students own id or if the authorization level is SLB teacher or admin.
     *
     * @return bool
     */
    public function isOwnOrSlbTeacher()
    {
        if ( isset( $_SESSION[ 'userId' ], $_SESSION[ 'authorizationLevel' ] ) )
        {
            if ( $this->call( 'student', 'getId' ) == $_SESSION[ 'id' ] || $_SESSION[ 'authorizationLevel' ] > 2 )
            {
                return TRUE;
            }
        }
        return FALSE;
    }

    /**
     * Checks if its there is no session stored authorization level.
     *
     * @return bool
     */
    public function isGuest()
    {
        if ( !isset( $_SESSION[ 'userId' ], $_SESSION[ 'authorizationLevel' ] ) )
        {
            return TRUE;
        }
        return FALSE;
    }

    /**
     * Gets the current authorization level.
     *
     * @return int
     */
    public function getCurrentAuthorizationLevel(  ) : int
    {
        return isset( $_SESSION['authorizationLevel']) ? (int)$_SESSION['authorizationLevel'] : 0;
    }

    /**
     * Gets the current user id.
     *
     * @return int
     */
    public function getCurrentUserId(  ) : int
    {
        return isset( $_SESSION['userId'] ) ? (int)$_SESSION['userId'] : 0;
    }

    public function getCurrentUserName(  ) : int
    {
        return isset( $_SESSION['userName'] ) ? (int)$_SESSION['userName'] : 0;
    }

    /**
     * Calls an method an an object stored in the DataProvider if the object exists.
     *
     * @param $key
     * @param method
     */
    public function call( $key, string $method, array $passParams = [] )
    {
        try
        {
            if ( $this->has( $key ) )
            {
                $object = $this->get( $key );

                if ( method_exists( $object, $method ) )
                {
                    return $object->{$method}( ...array_values( $passParams ) );
                }
            }
        }
        catch ( \Exception $e )
        {
            Debug::addException( $e );
        }

        return NULL;
    }

    /**
     * Calling an nested method on an object stored in the data provider.
     * Example:
     * The following call:
     * $dp->nestedCall( 'Users', 'getById:getAsAn', [ [1], ['object'] ] );
     * Will execute this code:
     * Users->getById( 1 )->getAsAn( 'object' );
     *
     * @param        $key
     * @param string $methods
     * @param array  $passParams
     * @return null
     */
    public function nestedCall( $key, string $methods, array $passParams = [] )
    {
        $methods = explode( ':', $methods );
        try
        {
            if ( $this->has( $key ) )
            {
                $object = $this->get( $key );

                foreach ( $methods as $index => $method)
                {
                    if ( method_exists( $object, $method ) )
                    {
                        if ( array_key_exists( $index, $passParams ) )
                        {
                            $object = $object->{$method}( ...array_values( $passParams[$index] ) );
                        }
                        else
                        {
                            $object = $object->{$method}();
                        }
                    }
                }
                return $object;
            }
        }
        catch ( \Exception $e )
        {
            Debug::addException( $e );
        }

        return NULL;
    }

}