<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 10-12-2016 03:19
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortefolioCMS\Kernel\Database\Driver;


use StendenINF1B\PortefolioCMS\Kernel\Helper\ParameterContainer;

interface DriverInterface
{
    public function connect( ParameterContainer $databaseConfiguration ) : \PDO;
}