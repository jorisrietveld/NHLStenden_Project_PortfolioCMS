<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 10-12-2016 03:14
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortefolioCMS\Kernel\Database\Driver;

use StendenINF1B\PortefolioCMS\Kernel\Helper\ParameterContainer;

class DriverFactory
{
    /**
     * Search in the configuration for the driver key and return an driver instance that implements the DriverInterface.
     *
     * @param array $config
     * @return DriverInterface
     */
    public function createDriver( ParameterContainer $databaseConfiguration  ) : DriverInterface
    {
        if( $databaseConfiguration->has( 'driver' ) === FALSE )
        {
            throw new \InvalidArgumentException("A database driver must be specified.");
        }

        switch( $databaseConfiguration->get( 'driver' ) )
        {
            case "mysql":
                return new MysqlDriver();
            case "mssql":
                return new SqlServerDriver();
            case "sqlight":
                return new SqlightDriver();
            default:
                throw new \InvalidArgumentException( sprintf( 'Unsupported driver in configuration: %s', $databaseConfiguration->get('driver') ));
        }
    }
}