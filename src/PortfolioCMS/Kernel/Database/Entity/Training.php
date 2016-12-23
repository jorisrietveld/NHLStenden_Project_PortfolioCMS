<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 22-12-2016 05:51
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Kernel\Database\Entity;


class Training implements EntityInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $institution;

    /**
     * @var string
     */
    protected $location;

    /**
     * @var \DateTime
     */
    protected $statedAt;

    /**
     * @var \DateTime
     */
    protected $finishedAt;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var bool
     */
    protected $obtainedCertificate;

    /**
     * @var bool
     */
    protected $currentTraining;

    /**
     * @var Portfolio
     */
    protected $portfolio; // One training has one portfolio.

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Training
     */
    public function setId( int $id ): Training
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Training
     */
    public function setTitle( string $title ): Training
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getInstitution(): string
    {
        return $this->institution;
    }

    /**
     * @param string $institution
     * @return Training
     */
    public function setInstitution( string $institution ): Training
    {
        $this->institution = $institution;
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
     * @return Training
     */
    public function setLocation( string $location ): Training
    {
        $this->location = $location;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getStatedAt(): \DateTime
    {
        return $this->statedAt;
    }

    /**
     * @param \DateTime $statedAt
     * @return Training
     */
    public function setStatedAt( \DateTime $statedAt ): Training
    {
        $this->statedAt = $statedAt;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getFinishedAt(): \DateTime
    {
        return $this->finishedAt;
    }

    /**
     * @param \DateTime $finishedAt
     * @return Training
     */
    public function setFinishedAt( \DateTime $finishedAt ): Training
    {
        $this->finishedAt = $finishedAt;
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
     * @return Training
     */
    public function setDescription( string $description ): Training
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isObtainedCertificate(): bool
    {
        return $this->obtainedCertificate;
    }

    /**
     * @param boolean $obtainedCertificate
     * @return Training
     */
    public function setObtainedCertificate( bool $obtainedCertificate ): Training
    {
        $this->obtainedCertificate = $obtainedCertificate;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isCurrentTraining(): bool
    {
        return $this->currentTraining;
    }

    /**
     * @param boolean $currentTraining
     * @return Training
     */
    public function setCurrentTraining( bool $currentTraining ): Training
    {
        $this->currentTraining = $currentTraining;
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
     * @return Training
     */
    public function setPortfolio( Portfolio $portfolio ): Training
    {
        $this->portfolio = $portfolio;
        return $this;
    }


}