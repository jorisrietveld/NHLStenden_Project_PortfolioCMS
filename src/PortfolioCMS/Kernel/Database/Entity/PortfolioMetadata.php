<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 16-01-2017 11:56
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Kernel\Database\Entity;

use StendenINF1B\PortfolioCMS\Kernel\Database\Helper\EntityCollection;

class PortfolioMetadata
{
    /**
     * @var int
     */
    protected $id = 0;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $url;

    /**
     * @var string
     */
    protected $studentFirstName;

    /**
     * @var string
     */
    protected $studentLastName;

    /**
     * @var EntityCollection
     */
    protected $portfolioSubPages;

    /**
     * @var int
     */
    protected $studentId;

    /**
     * This method gets the Id property.
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * This method sets the id property.
     *
     * @param int $id
     */
    public function setId( int $id )
    {
        $this->id = $id;
    }

    /**
     * This method gets the Title property.
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * This method sets the title property.
     *
     * @param string $title
     */
    public function setTitle( string $title )
    {
        $this->title = $title;
    }

    /**
     * This method gets the Url property.
     *
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * This method sets the url property.
     *
     * @param string $url
     */
    public function setUrl( string $url )
    {
        $this->url = $url;
    }

    /**
     * This method gets the StudentFirstName property.
     *
     * @return string
     */
    public function getStudentFirstName(): string
    {
        return $this->studentFirstName;
    }

    /**
     * This method sets the studentFirstName property.
     *
     * @param string $studentFirstName
     */
    public function setStudentFirstName( string $studentFirstName )
    {
        $this->studentFirstName = $studentFirstName;
    }

    /**
     * This method gets the StudentLastName property.
     *
     * @return string
     */
    public function getStudentLastName(): string
    {
        return $this->studentLastName;
    }

    /**
     * This method sets the studentLastName property.
     *
     * @param string $studentLastName
     */
    public function setStudentLastName( string $studentLastName )
    {
        $this->studentLastName = $studentLastName;
    }

    /**
     * This method gets the PortfolioSubPages property.
     *
     * @return EntityCollection
     */
    public function getPortfolioSubPages(): EntityCollection
    {
        return $this->portfolioSubPages;
    }

    /**
     * This method sets the portfolioSubPages property.
     *
     * @param EntityCollection $portfolioSubPages
     */
    public function setPortfolioSubPages( EntityCollection $portfolioSubPages )
    {
        $this->portfolioSubPages = $portfolioSubPages;
    }

    public function getStudentName() : string
    {
        return $this->getStudentFirstName() . ' ' . $this->getStudentLastName();
    }

    /**
     * This method gets the StudentId property.
     *
     * @return int
     */
    public function getStudentId(): int
    {
        return $this->studentId;
    }

    /**
     * This method sets the studentId property.
     *
     * @param int $studentId
     */
    public function setStudentId( int $studentId )
    {
        $this->studentId = $studentId;
    }


}