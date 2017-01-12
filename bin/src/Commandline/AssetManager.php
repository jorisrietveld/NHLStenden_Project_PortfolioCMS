<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 12-01-2017 13:53
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace bin\src\Commandline;


class AssetManager
{
    protected $resourcesDirectory = THEMES_DIR;
    protected $publicAssetDirectory = PUBLIC_WEB_DIR;

    public function moveAssets(  )
    {
        
    }

    protected function findThemes() : array
    {
        $themeDirectories = [];

        foreach ( scandir( $this->resourcesDirectory ) as $dirItem )
        {
            if( is_dir( $this->resourcesDirectory . $dirItem ) )
            {
                $themeDirectories[] = $dirItem;
            }
        }

    }

    protected function getAssetsForTheme( string $themeName )
    {
        
    }
}