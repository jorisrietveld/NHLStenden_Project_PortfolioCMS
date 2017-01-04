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
     * @var string
     */
    protected $language;

    /**
     * @var int
     */
    protected $level;

    /**
     * @var bool
     */
    protected $isNative;

    /**
     * @var int
     */
    protected $portfolioId; // One Language has one Portfolio.

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
    public function getIsIsNative(): bool
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
     * @return int
     */
    public function getPortfolioId(): int
    {
        return $this->portfolioId;
    }

    /**
     * @param int $portfolio
     * @return Language
     */
    public function setPortfolioId( int $portfolioId ): Language
    {
        $this->portfolioId = $portfolioId;
        return $this;
    }

    /**
     * @return string
     */
    public function getLanguage(): string
    {
        return $this->language;
    }

    /**
     * @param string $language
     */
    public function setLanguage( string $language )
    {
        $this->language = $language;
    }



}