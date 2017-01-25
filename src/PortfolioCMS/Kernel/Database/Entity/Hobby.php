<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 22-12-2016 11:31
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Kernel\Database\Entity;

class Hobby implements EntityInterface
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
     * @var int
     */
    protected $portfolioId;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Hobby
     */
    public function setId( int $id ): Hobby
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
     * @return Hobby
     */
    public function setName( string $name ): Hobby
    {
        $this->name = $name;
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
     * @param int $portfolioId
     * @return Hobby
     */
    public function setPortfolio( int $portfolioId ): Hobby
    {
        $this->portfolioId = $portfolioId;
        return $this;
    }

}