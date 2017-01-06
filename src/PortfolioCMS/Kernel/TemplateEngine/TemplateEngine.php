<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 22-12-2016 16:55
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Kernel\TemplateEngine;


use DebugBar\DebugBar;
use StendenINF1B\PortfolioCMS\Kernel\Debug\Debug;
use StendenINF1B\PortfolioCMS\Kernel\Exception\TemplateEngineException;
use StendenINF1B\PortfolioCMS\Kernel\Helper\ConfigLoader;

class TemplateEngine
{
    /**
     * @var null|ConfigLoader
     */
    protected $configLoader;

    /**
     * @var array|\StendenINF1B\PortfolioCMS\Kernel\Helper\ParameterContainer
     */
    protected $configContainer;

    /**
     * ThemeManager that maneges all installed themes.
     *
     * @var ThemeManger
     */
    protected $themeManager;

    /**
     * The path to the assets from the theme.
     * @var string
     */
    protected $assetPath;

    /**
     * TemplateEngine constructor.
     *
     * @param ConfigLoader|null $configLoader
     */
    public function __construct( ConfigLoader $configLoader = NULL )
    {
        $this->configLoader = $configLoader ?? new ConfigLoader( CONFIG_FILE );
        $this->configContainer = $this->configLoader->getConfigContainer();
        $this->assetPath = 'assets/site';
    }

    /**
     * Sets an asset path for a given theme.
     *
     * @param string $themeName
     */
    public function setAssetPath( string $themeName )
    {
        $this->assetPath = ASSET_BASE_PATH . $themeName;
    }

    /**
     * Returnes the asset path for an given theme.
     *
     * @return mixed
     */
    public function getAssetPath(  ) : string
    {
        return $this->assetPath;
    }

    /**
     * Renders an template file and returnes it as an string.
     *
     * @param string $name
     * @param array  $context
     * @return string
     */
    public function render( string $name, array $context = [] ) : string
    {
        $templatePath = $this->getTemplatePath( $name );
        $dataProvider = new DataProvider();
        $dataProvider->replace( $context );
        $dataProvider->set( 'debugBarRenderer', Debug::getDebugBar()->getJavascriptRenderer() );
        $dataProvider->set( 'assetPath', $this->getAssetPath() );

        // Start an new output buffer.
        ob_start();

        include $templatePath;

        // Return the data from the output buffer as an string.
        return ob_get_clean();
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
        $this->setAssetPath( $theme );

        return $templatePath;
    }
}