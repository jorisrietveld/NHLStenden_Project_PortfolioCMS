<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 22-12-2016 16:55
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Kernel\TemplateEngine;


use StendenINF1B\PortfolioCMS\Kernel\Exception\TemplateEngineException;

class TemplateEngine
{
    public function __construct(  )
    {
        
    }

    public function render( string $name, array $context = [] )
    {
        
    }

    public function moveAssets( string $name, array $types = [ 'css', 'js', 'images' ] )
    {
        
    }

    protected function loadTheme( string $name )
    {
        $nameParts = explode( ':', $name );

        if( count( $nameParts ) !== 2 )
        {
            throw new TemplateEngineException( sprintf( 'Mallformed template name: %s', $name ) );
        }
    }
}