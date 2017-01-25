<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 22-12-2016 05:28
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Kernel\Database\Entity;

use StendenINF1B\PortfolioCMS\Kernel\Database\Helper\EntityCollection;

class Theme implements EntityInterface
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
    protected $author;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $directoryName;

    /**
     * @var EntityCollection
     */
    protected $pages;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Theme
     */
    public function setId( int $id ): Theme
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
     * @return Theme
     */
    public function setName( string $name ): Theme
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->author;
    }

    /**
     * @param string $author
     * @return Theme
     */
    public function setAuthor( string $author ): Theme
    {
        $this->author = $author;
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
     * @return Theme
     */
    public function setDescription( string $description ): Theme
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getDirectoryName(): string
    {
        return $this->directoryName;
    }

    /**
     * @param string $directoryName
     * @return Theme
     */
    public function setDirectoryName( string $directoryName ): Theme
    {
        $this->directoryName = $directoryName;
        return $this;
    }

    /**
     * @return EntityCollection
     */
    public function getPages(): EntityCollection
    {
        return $this->pages;
    }

    /**
     * @param EntityCollection $pages
     */
    public function setPages( EntityCollection $pages )
    {
        $this->pages = $pages;
    }

}