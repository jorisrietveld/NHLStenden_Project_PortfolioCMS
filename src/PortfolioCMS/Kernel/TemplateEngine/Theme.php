<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 22-12-2016 17:10
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Kernel\TemplateEngine;


class Theme
{
    protected $directoryName;
    protected $rootPath;
    protected $assetDirectories;
    protected $templateFiles;

    public function __construct( string $directoryName = '', string $rootPath = '', array $assetDirectories = [], array $templateFiles = [] )
    {
        $this->setDirectoryName( $directoryName );
        $this->setRootPath( $rootPath );
        $this->setAssetDirectories( $assetDirectories );
        $this->setTemplateFiles( $templateFiles );
    }

    /**
     * @return mixed
     */
    public function getDirectoryName()
    {
        return $this->directoryName;
    }

    /**
     * @param mixed $directoryName
     */
    public function setDirectoryName( $directoryName )
    {
        $this->directoryName = $directoryName;
    }

    /**
     * @return mixed
     */
    public function getRootPath()
    {
        return $this->rootPath;
    }

    /**
     * @param mixed $rootPath
     */
    public function setRootPath( $rootPath )
    {
        $this->rootPath = $rootPath;
    }

    /**
     * @return mixed
     */
    public function getAssetDirectories()
    {
        return $this->assetDirectories;
    }

    /**
     * @param mixed $assetDirectories
     */
    public function setAssetDirectories( $assetDirectories )
    {
        $this->assetDirectories = $assetDirectories;
    }

    /**
     * @return mixed
     */
    public function getTemplateFiles()
    {
        return $this->templateFiles;
    }

    /**
     * @param mixed $templateFiles
     */
    public function setTemplateFiles( $templateFiles )
    {
        $this->templateFiles = $templateFiles;
    }


}