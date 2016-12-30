<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 30-12-2016 15:38
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Kernel\Database;


use StendenINF1B\PortfolioCMS\Kernel\Helper\ParameterContainer;

class DatabaseConnection
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var \PDO
     */
    public $pdo;

    /**
     * @var ParameterContainer
     */
    protected $pdoSettings;

    /**
     * @var string
     */
    protected $type;

    /**
     * DatabaseConnection constructor for initiating the object.
     *
     * @param string    $name
     * @param string    $type
     * @param \PDO|null $PDO
     * @param $pdoSettings ParameterContainer|null
     */
    public function __construct( string $name, string $type, \PDO $PDO = null, ParameterContainer $pdoSettings = NULL )
    {
        $this->setName( $name );
        $this->setType( $type );
        $this->pdo = $PDO;
        $this->pdoSettings = $pdoSettings ?? new ParameterContainer();
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
     */
    public function setName( string $name )
    {
        $this->name = $name;
    }

    /**
     * Gets the pdo object.
     *
     * @return \PDO
     * @throws \LogicException
     */
    public function getPdo(): \PDO
    {
        if( $this->pdo == NULL )
        {
            throw new \LogicException( 'Cannot return the php data object because it is not set.' );
        }
        return $this->pdo;
    }

    /**
     * @param \PDO $pdo
     */
    public function setPdo( \PDO $pdo )
    {
        $this->pdo = $pdo;
    }

    /**
     * @return array
     */
    public function getPdoSettings(): ParameterContainer
    {
        return $this->pdoSettings;
    }

    /**
     * @param array $pdoSettings
     */
    public function setPdoSettings( ParameterContainer $pdoSettings )
    {
        $this->pdoSettings = $pdoSettings;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return DatabaseConnection
     */
    public function setType( string $type ): DatabaseConnection
    {
        $this->type = $type;
        return $this;
    }


}