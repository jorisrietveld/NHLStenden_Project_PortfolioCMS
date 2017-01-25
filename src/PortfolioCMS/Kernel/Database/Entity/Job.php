<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 16-01-2017 12:14
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Kernel\Database\Entity;

/**
 * Class Job
 *
 * This class is an alias for JobExperience objects that are jobs.
 *
 * @package StendenINF1B\PortfolioCMS\Kernel\Database\Entity
 */
class Job
{
    /**
     * @var int
     */
    protected $id = 0;

    /**
     * @var string
     */
    protected $location;

    /**
     * @var \DateTime
     */
    protected $startedAt;

    /**
     * @var \DateTime
     */
    protected $endedAt;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var int
     */
    protected $portfolioId;

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
     * This method gets the Location property.
     *
     * @return string
     */
    public function getLocation(): string
    {
        return $this->location;
    }

    /**
     * This method sets the location property.
     *
     * @param string $location
     */
    public function setLocation( string $location )
    {
        $this->location = $location;
    }

    /**
     * This method gets the StartedAt property.
     *
     * @return \DateTime
     */
    public function getStartedAt(): \DateTime
    {
        return $this->startedAt;
    }

    /**
     * This method sets the startedAt property.
     *
     * @param \DateTime $startedAt
     */
    public function setStartedAt( \DateTime $startedAt )
    {
        $this->startedAt = $startedAt;
    }

    /**
     * This method gets the EndedAt property.
     *
     * @return \DateTime
     */
    public function getEndedAt(): \DateTime
    {
        return $this->endedAt;
    }

    /**
     * This method sets the endedAt property.
     *
     * @param \DateTime $endedAt
     */
    public function setEndedAt( \DateTime $endedAt )
    {
        $this->endedAt = $endedAt;
    }

    /**
     * This method gets the Description property.
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * This method sets the description property.
     *
     * @param string $description
     */
    public function setDescription( string $description )
    {
        $this->description = $description;
    }

    /**
     * This method gets the PortfolioId property.
     *
     * @return int
     */
    public function getPortfolioId(): int
    {
        return $this->portfolioId;
    }

    /**
     * This method sets the portfolioId property.
     *
     * @param int $portfolioId
     */
    public function setPortfolioId( int $portfolioId )
    {
        $this->portfolioId = $portfolioId;
    }
}