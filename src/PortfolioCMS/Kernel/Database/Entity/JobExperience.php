<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 22-12-2016 05:45
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Kernel\Database\Entity;


class JobExperience implements EntityInterface
{
    /**
     * @var int
     */
    protected $id;

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
     * @var bool
     */
    protected $isInternship;

    /**
     * @var Portfolio
     */
    protected $portfolio;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return JobExperience
     */
    public function setId( int $id ): JobExperience
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getLocation(): string
    {
        return $this->location;
    }

    /**
     * @param string $location
     * @return JobExperience
     */
    public function setLocation( string $location ): JobExperience
    {
        $this->location = $location;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getStartedAt(): \DateTime
    {
        return $this->startedAt;
    }

    /**
     * @param \DateTime $startedAt
     * @return JobExperience
     */
    public function setStartedAt( \DateTime $startedAt ): JobExperience
    {
        $this->startedAt = $startedAt;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getEndedAt(): \DateTime
    {
        return $this->endedAt;
    }

    /**
     * @param \DateTime $endedAt
     * @return JobExperience
     */
    public function setEndedAt( \DateTime $endedAt ): JobExperience
    {
        $this->endedAt = $endedAt;
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
     * @return JobExperience
     */
    public function setDescription( string $description ): JobExperience
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isIsInternship(): bool
    {
        return $this->isInternship;
    }

    /**
     * @param boolean $isInternship
     * @return JobExperience
     */
    public function setIsInternship( bool $isInternship ): JobExperience
    {
        $this->isInternship = $isInternship;
        return $this;
    }

    /**
     * @return Portfolio
     */
    public function getPortfolio(): Portfolio
    {
        return $this->portfolio;
    }

    /**
     * @param Portfolio $portfolio
     * @return JobExperience
     */
    public function setPortfolio( Portfolio $portfolio ): JobExperience
    {
        $this->portfolio = $portfolio;
        return $this;
    } // One JobExperience has one portfolio


}