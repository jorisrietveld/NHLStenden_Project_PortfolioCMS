<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 18-11-2016 16:02
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );
namespace StendenINF1B\PortfolioCMS\Kernel\Http;


class ServerContainer extends ParameterContainer 
{
    /**
     * Get all the HTTP headers. this method is replaced by the Parameter container that is saved directly
     * to the Request. todo remove this method.
     *
     * @return array
     */
    public function getHeaders(  )
    {

        $headers = [];
        $contentHeaders = [
            'CONTENT_LENGTH' => true,
            'CONTENT_MD5' => true,
            'CONTENT_TYPE' => true
        ];

        foreach ( $this->parameters as $key => $value )
        {
            if( 0 === strpos( $key, 'HTTP_' ) )
            {
                $headers[ substr( $key, 5 ) ] = $value;
            }
            elseif( isset( $contentHeaders[ $key ] ))
            {
                // For the CONTENT_* keys
                $headers[ $key ] = $value;
            }
        }

        /**
         * TODO implement the headers for HTTP authentication.
         */

        return $headers;
    }
}