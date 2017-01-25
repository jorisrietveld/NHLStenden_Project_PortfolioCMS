<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 30-12-2016 15:31
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Kernel\Database\Entity;

class Page implements EntityInterface
{
    /**
     * @var int
     */
    protected $id = 0;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $fileName;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $url;

    /**
     * @var int
     */
    protected $themeId;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Page
     */
    public function setId( int $id ): Page
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Page
     */
    public function setName( string $name ): Page
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getFileName(): string
    {
        return $this->fileName;
    }

    /**
     * @param string $fileName
     * @return Page
     */
    public function setFileName( string $fileName ): Page
    {
        $this->fileName = $fileName;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Page
     */
    public function setDescription( string $description ): Page
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return Page
     */
    public function setUrl( string $url ): Page
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return int
     */
    public function getThemeId(): int
    {
        return $this->themeId;
    }

    /**
     * @param int $theme
     * @return Page
     */
    public function setThemeId( int $themeId ): Page
    {
        $this->themeId = $themeId;
        return $this;
    }

}