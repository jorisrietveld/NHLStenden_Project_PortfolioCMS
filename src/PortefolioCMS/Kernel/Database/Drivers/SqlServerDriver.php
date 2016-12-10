<?php
/**
 * Author: Joris Rietveld <jorisrietveld@protonmail.com>
 * Date: 4-9-15 - 15:15
 */

namespace StendenINF1B\PortefolioCMS\Kernel\Database\Driver;

use PDO;
use StendenINF1B\PortefolioCMS\Kernel\Helper\ParameterContainer;


class SqlServerDriver extends Driver implements DriverInterface
{
	/**
	 * The default php database object connection options
	 * @var array
	 */
	protected $options = [
		PDO::ATTR_CASE              => PDO::CASE_NATURAL,
		PDO::ATTR_ERRMODE           => PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_ORACLE_NULLS      => PDO::NULL_NATURAL,
		PDO::ATTR_STRINGIFY_FETCHES => false,
	];

	/**
	 * This method will connect to a SqlServer database
	 * @param array $config
	 */
	public function connect( ParameterContainer $config )
	{
		$dsn = $this->getDsn( $config );

		$options = $this->getOptions( $config );

		$sqlServerConnection = $this->openConnection( $dsn, $config, $options );
	}

	/**
	 * Return the dsn for opening an connection to an Microsoft SQL server or an Azure database.
	 *
	 * @param array $config
	 */
	protected function getDsn( Array $config )
	{
		if( in_array( "dblib", $this->getAvailablePdoDrivers() ) )
		{
			return $this->getDsnForDblibDriver( $config );
		}

		return $this->getDsnForSrvDriver( $config );
	}

	protected function getDsnForDblibDriver( Array $config )
	{
		$arguments = [
			'host'   => $this->buildHostString( $config, ':' ),
			'dbname' => $config[ 'database' ]
		];

		$arguments = array_merge( $arguments, function ( $config, $arrayKeys )
		{
			$array = array_intersect_key( $config, array_flip( (array)$arrayKeys ) );

			return $array;
		}
		);

		return $this->buildConnectString( 'dblib', $arguments );
	}

	protected function getDsnForSrvDriver( Array $config )
	{
		$arguments = [
			'Server' => $this->buildHostString( $config, ',' )
		];

		if( isset( $config[ 'database' ] ) )
		{
			$arguments[ 'CWDatabase' ] = $config[ 'database' ];
		}

		if( isset( $config[ 'appname' ] ) )
		{
			$arguments[ 'APP' ] = $config[ 'appname' ];
		}

		return $this->buildConnectString( 'sqlsrv', $arguments );
	}

	/**
	 * Build a connection string from the given arguments.
	 *
	 * @param  string $driver
	 * @param  array  $arguments
	 *
	 * @return string
	 */
	protected function buildConnectString( $driver, array $arguments )
	{
		$options = array_map( function ( $key ) use ( $arguments )
		{
			return sprintf( "%s=%s", $key, $arguments[ $key ] );
		}, array_keys( $arguments ) );

		return $driver . ":" . implode( ';', $options );
	}

	/**
	 * Build a host string from the given configuration.
	 *
	 * @param  array  $config
	 * @param  string $separator
	 *
	 * @return string
	 */
	protected function buildHostString( array $config, $separator )
	{
		if( isset( $config[ 'port' ] ) )
		{
			return $config[ 'host' ] . $separator . $config[ 'port' ];
		}
		else
		{
			return $config[ 'host' ];
		}
	}

}