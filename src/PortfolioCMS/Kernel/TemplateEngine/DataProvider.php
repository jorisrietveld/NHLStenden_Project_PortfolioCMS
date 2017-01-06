<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 06-01-2017 16:34
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Kernel\TemplateEngine;


use StendenINF1B\PortfolioCMS\Kernel\Authorization\User;
use StendenINF1B\PortfolioCMS\Kernel\Helper\ParameterContainer;

class DataProvider extends ParameterContainer 
{
    protected $user;

    public function __construct( )
    {

    }

    public function get( $key, $default = NULL )
    {
        // todo write check if the user is allowed to view that data.

        return parent::get( $key , 'Data not found.' );
    }

    /**
     * Calls an method an an object stored in the DataProvider if the object exists.
     *
     * @param $key
     * @param method
     */
    public function call( $key, string $method, array $passParams = [] )
    {
        if( $this->has( $key ) )
        {
            $object = $this->get( $key );

            if( method_exists( $object, $method ) )
            {
                return $object->{$method}( ...array_values( $passParams ) );
            }
        }

        return NULL;
    }
    
    
}