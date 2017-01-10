<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 10-12-2016 03:19
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Kernel\Database\Driver;

use StendenINF1B\PortfolioCMS\Kernel\Database\DatabaseConnection;
use StendenINF1B\PortfolioCMS\Kernel\Database\Helper\DatabaseConfigurationContainer;

interface DriverInterface
{
    /**
     * Returnes an database connection for the connection configuration passed to it.
     *
     * @param DatabaseConfigurationContainer $config
     * @return DatabaseConnection
     */
    public function connect( DatabaseConfigurationContainer $config ) : DatabaseConnection;
}