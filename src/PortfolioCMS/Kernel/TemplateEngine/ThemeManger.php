<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 22-12-2016 16:53
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Kernel\TemplateEngine;

/**
 * TODO write this class... not enough time so do it manually.
 */

use StendenINF1B\PortfolioCMS\Kernel\Database\EntityManager;
use StendenINF1B\PortfolioCMS\Kernel\Helper\ConfigLoader;
use StendenINF1B\PortfolioCMS\Kernel\Helper\ParameterContainer;

class ThemeManger
{
    protected $entityManager;
    protected $themeEntities;

    /**
     * @var ConfigLoader
     */
    protected $configLoader;

    /**
     * @var ParameterContainer
     */
    protected $configContainer;

    /**
     * @var array
     */
    protected $defaultAssetDirs = [
        'css',
        'js',
        'images',
    ];

    public function __construct( EntityManager $entityManager, ConfigLoader $configLoader = NULL )
    {
        $this->entityManager = $entityManager;

        if ( $configLoader === NULL )
        {
            $this->configLoader = new ConfigLoader();
        }
        $this->configLoader->getConfigContainer();
        $this->setDefaultAssetDirs();
    }

    public function setDefaultAssetDirs()
    {
        if ( $this->configContainer->has( 'template_asset_dirs' ) )
        {
            array_combine(
                $this->defaultAssetDirs,
                explode( ':', $this->configContainer->get( 'template_asset_dirs' ) )
            );
        }
    }

    public function getAllInstalledThemes()
    {

    }

    public function installNewTheme()
    {

    }

    public function moveAssetDirs()
    {

    }
}