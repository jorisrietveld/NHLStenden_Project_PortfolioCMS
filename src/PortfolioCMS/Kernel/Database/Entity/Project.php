<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 22-12-2016 11:31
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Kernel\Database\Entity;

class Project implements EntityInterface
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
    protected $description;

    /**
     * @var string
     */
    protected $link;

    /**
     * @var float
     */
    protected $grade;

    /**
     * @var Image
     */
    protected $image; // One project has one image.

    /**
     * @var int
     */
    protected $portfolioId; // One project has one project.

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Project
     */
    public function setId( int $id ): Project
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
     * @return Project
     */
    public function setName( string $name ): Project
    {
        $this->name = $name;
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
     * @return Project
     */
    public function setDescription( string $description ): Project
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getLink(): string
    {
        return $this->link;
    }

    /**
     * @param string $link
     * @return Project
     */
    public function setLink( string $link ): Project
    {
        $this->link = $link;
        return $this;
    }

    /**
     * @return Image
     */
    public function getImage(): Image
    {
        return $this->image;
    }

    /**
     * @param Image $image
     * @return Project
     */
    public function setImage( Image $image ): Project
    {
        $this->image = $image;
        return $this;
    }

    /**
     * @return int
     */
    public function getPortfolioId(): int
    {
        return $this->portfolioId;
    }

    /**
     * @param int $portfolio
     * @return Project
     */
    public function setPortfolioId( int $portfolioId ): Project
    {
        $this->portfolioId = $portfolioId;
        return $this;
    }

    /**
     * @return float
     */
    public function getGrade(): float
    {
        if ( $this->grade === NULL )
        {
            $this->grade = (float)0;
        }
        return $this->grade;
    }

    /**
     * @param float $grade
     */
    public function setGrade( float $grade )
    {
        $this->grade = $grade;
    }
}