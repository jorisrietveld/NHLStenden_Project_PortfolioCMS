<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 22-12-2016 18:58
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Kernel\Database\Helper;


use StendenINF1B\PortfolioCMS\Kernel\Helper\ParameterContainer;

class DatabaseConfigurationContainer extends ParameterContainer
{
    /**
     * This holds the name of the database configuration file.
     * @var string
     */
    protected $connectionName;

    /**
     * This holds an ParameterContainer with all the PDO options.
     *
     * @var ParameterContainer
     */
    public $pdoOptions;

    /**
     * DatabaseConfigurationContainer constructor for initiating the database configuration container.
     *
     * @param array $databaseConfigurationParams
     */
    public function __construct( string $connectionName, array $databaseConfigurationParams = [] )
    {
        parent::__construct( $databaseConfigurationParams );
        $this->setConnectionName( $connectionName );

        $this->pdoOptions = new ParameterContainer();
    }

    /**
     * Gets name of the database connection.
     *
     * @return string
     */
    public function getConnectionName(): string
    {
        return $this->connectionName;
    }

    /**
     * Sets the name of the database connection.
     * @param string $connectionName
     */
    public function setConnectionName( string $connectionName )
    {
        $this->connectionName = $connectionName;
    }

    /**
     * Sets the PHP data object options.
     *
     * @param array $pdoOptions
     */
    public function setPdoOptions( array $pdoOptions )
    {
        $this->pdoOptions = new ParameterContainer( $pdoOptions );
    }

    /**
     * Gets the php data object options.
     *
     * @return ParameterContainer
     */
    public function getPdoOptions(  ) : ParameterContainer
    {
        return $this->pdoOptions;
    }


    
}