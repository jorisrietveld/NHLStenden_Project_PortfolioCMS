<?php
/**
 * Author: Joris Rietveld <jorisrietveld@protonmail.com>
 * Date: 2-9-15 - 19:06
 */

namespace StendenINF1B\PortfolioCMS\Kernel\Database\Driver;

use PDO;
use StendenINF1B\PortfolioCMS\Kernel\Exception\ConfigurationErrorException;
use StendenINF1B\PortfolioCMS\Kernel\Helper\ParameterContainer;


class MysqlDriver extends Driver implements DriverInterface
{
	private $mysqlConnection;

	/**
	 * This method will connect to a Mysql database
	 *
	 * @param array $config
	 *
	 * @return PDO
	 */
	public function connect( ParameterContainer $config )
	{
		$dsn = $this->getDsn( $config );

		// Get all options from the config and default PDO connection options.
		$options = $this->getOptions( $config );

		// Open an connection to the mysql database based on the config and default options.
		$this->mysqlConnection = $this->openConnection( $dsn, $config, $options );

		// If the configuration is set to use an unix socket set the connection to use an specific database.
		if( !empty( $config[ "unix_socket" ] ) )
		{
			$database = $config[ "database" ];
			$this->mysqlConnection->exec( "use `{$database}`;" );
		}

		if( $this->configHasCharset( $config ) )
		{
			$this->setCharset( $config );
		}

		if( $this->configHasTimezone( $config ) )
		{
			$this->setTimezone( $config );
		}

		if( $this->configHasStrict( $config ) )
		{
			$this->setStrict();
		}

		return $this->mysqlConnection;
	}

	/**
	 * If there is an charset set in the configuration set the connection to use that charset. And if there is an
	 * specific collation set also set the connection to use this.
	 *
	 * @param PDO   $connection
	 * @param array $config
	 *
	 * @return void
	 */
	protected function setCharset( ParameterContainer $config )
	{
		//extract( $config, EXTR_PREFIX_ALL, "conf" );

		$setNames = "set names '{$conf_charset}'";

		if( !empty( $conf_collation ) )
		{
			$setNames .= " collate '{$conf_collation}'";
		}

		$this->mysqlConnection->prepare( $setNames )->execute();
	}

	/**
	 * Execute an query that sets the timezone based on the configuration.
	 *
	 * @param PDO   $connection
	 * @param array $config
	 *
	 * @return void
	 */
	protected function setTimezone( Array $config )
	{
		extract( $config, EXTR_PREFIX_ALL, "conf" );

		$this->mysqlConnection->prepare( "set time_zone='{$conf_timezone}'" )->execute();
	}

	/**
	 * If the strict option is set in the configuration set the mysql connection to enable strict sql mode.
	 *
	 * @param PDO $connection
	 *
	 * @return void
	 */
	protected function setStrict()
	{
		$this->mysqlConnection->prepare( "set session sql_mode='STRICT_ALL_TABLES'" )->execute();
	}

	/**
	 * Get the domain name string.
	 *
	 * @param array $config
	 *
	 * @return string
	 */
	protected function getDsn( Array $config )
	{
		if( $this->configHasUnixSocket( $config ) )
		{
			return $this->getDsnWithSocketConfiguration( $config );
		}

		return $this->getDsnWithHostConfiguration( $config );
	}

	/**
	 * Get dsn with unix socket configuration.
	 *
	 * @param array $config
	 *
	 * @return string
	 */
	public function getDsnWithSocketConfiguration( ParameterContainer $config )
	{
	    if( $config->has( 'unix_socket' ) && $config->has( 'database' ) )
        {
            return "mysql:unix_socket={$config->get('unix_socket')};dbname={$config->get('database')}";
        }
		else
        {
            throw new ConfigurationErrorException('Missing configuration for mysql with unix socket connection..');
        }


	}

	/**
	 * Get a dsn with hostname configuration.
	 *
	 * @param array $config
	 *
	 * @return string
	 */
	protected function getDsnWithHostConfiguration( Array $config )
	{
		extract( $config, EXTR_PREFIX_ALL, "conf" );

		if( isset( $conf_port ) && isset( $conf_database ) )
		{
			return "mysql:host={$conf_host};port={$conf_port};dbname={$conf_database}";
		}
		elseif( isset( $conf_port ) )
		{
			return "mysql:host={$conf_host};port={$conf_port};";
		}
		elseif( isset( $conf_database ) )
		{
			return "mysql:host={$conf_host};dbname={$conf_database}";
		}
		else
		{
			return "mysql:host={$conf_host};}";
		}

	}

	/**
	 * Test if the strict option is enabled in the configuration.
	 *
	 * @param array $config
	 *
	 * @return bool
	 */
	private function configHasStrict( Array $config )
	{
		if( isset( $config[ "strict" ] ) && $config[ "strict" ] )
		{
			return true;
		}

		return false;
	}

	/**
	 * Test if there is an timezone set in the configuration.
	 *
	 * @param array $config
	 *
	 * @return bool
	 */
	private function configHasTimezone( Array $config )
	{
		if( isset( $config[ "timezone" ] ) )
		{
			return true;
		}

		return false;
	}

	/**
	 * Test if there is an charset set in the configuration.
	 *
	 * @param array $config
	 *
	 * @return bool
	 */
	protected function configHasCharset( Array $config )
	{
		if( !empty( $config[ "charset" ] ) )
		{
			return true;
		}

		return false;
	}

	/**
	 * Test if the config is set to use an unix socket.
	 *
	 * @param array $config
	 *
	 * @return int
	 */
	private function configHasUnixSocket( Array $config )
	{
		if( !empty( $config[ "unix_socket" ] ) )
		{
			return true;
		}

		return false;
	}
}