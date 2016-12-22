<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 22-12-2016 05:47
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Kernel\Database\Entity;


class Language implements EntityInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var int
     */
    protected $level;

    /**
     * @var bool
     */
    protected $isNative;

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
     * @return Language
     */
    public function setId( int $id ): Language
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getLevel(): int
    {
        return $this->level;
    }

    /**
     * @param int $level
     * @return Language
     */
    public function setLevel( int $level ): Language
    {
        $this->level = $level;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isIsNative(): bool
    {
        return $this->isNative;
    }

    /**
     * @param boolean $isNative
     * @return Language
     */
    public function setIsNative( bool $isNative ): Language
    {
        $this->isNative = $isNative;
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
     * @return Language
     */
    public function setPortfolio( Portfolio $portfolio ): Language
    {
        $this->portfolio = $portfolio;
        return $this;
    } // One Language has one Portfolio.


}