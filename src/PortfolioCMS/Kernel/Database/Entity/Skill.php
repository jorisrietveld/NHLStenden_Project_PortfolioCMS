<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 22-12-2016 11:30
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Kernel\Database\Entity;


class Skill implements EntityInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var int
     */
    protected $levelOfExperience;

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
     * @return Skill
     */
    public function setId( int $id ): Skill
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
     * @return Skill
     */
    public function setName( string $name ): Skill
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return int
     */
    public function getLevelOfExperience(): int
    {
        return $this->levelOfExperience;
    }

    /**
     * @param int $levelOfExperience
     * @return Skill
     */
    public function setLevelOfExperience( int $levelOfExperience ): Skill
    {
        $this->levelOfExperience = $levelOfExperience;
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
     * @return Skill
     */
    public function setPortfolio( Portfolio $portfolio ): Skill
    {
        $this->portfolio = $portfolio;
        return $this;
    } // One Skill has one Portfolio


}