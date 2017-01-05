<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 22-12-2016 16:55
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Kernel\TemplateEngine;


use StendenINF1B\PortfolioCMS\Kernel\Exception\TemplateEngineException;
use StendenINF1B\PortfolioCMS\Kernel\Helper\ConfigLoader;

class TemplateEngine
{
    protected $configLoader;
    protected $configContainer;

    public function __construct( ConfigLoader $configLoader = NULL )
    {
        if( $configLoader === NULL )
        {
            $this->configLoader = new ConfigLoader( CONFIG_FILE );
        }
        $this->configContainer = $this->configLoader->getConfigContainer();

    }

    public function render( string $name, array $context = [] )
    {

    }

    public function getAssetsFromTheme( string $themeName, array $types = [ 'css', 'js', 'images' ] )
    {

    }

    /**
     * Gets the path for an given template like SomeTheme:SomeTemplate will return
     * something like: /var/www/PortfolioCMS/src/PortfolioCMS/Theme/SomeTheme/SomeTemplate.php
     *
     * @param string $name
     * @return string
     * @throws TemplateEngineException
     */
    protected function getTemplatePath( string $name )
    {
        $nameParts = explode( ':', $name );

        if( count( $nameParts ) !== 2 )
        {
            throw new TemplateEngineException( sprintf( 'Malformed template name: %s', $name ) );
        }

        $theme = $nameParts[0];
        $template = $nameParts[1];

        $themePath = THEMES_DIR . $theme;
        $templatePath = $themePath . DIR_SEP . $template . '.php';

        if( !is_dir( $themePath ) )
        {
            throw new TemplateEngineException( sprintf( 'The theme: %s is not found at location: %s', $theme, $themePath ) );
        }

        if( !file_exists( $templatePath ) )
        {
            throw new TemplateEngineException( sprintf( 'The template: %s is not found at location: %s', $template, $templatePath ) );
        }

        return $templatePath;
    }
}