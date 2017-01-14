<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 22-12-2016 05:48
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Kernel\Database;

use StendenINF1B\PortfolioCMS\Kernel\Helper\ParameterContainer;

class EntityManager
{
    protected $repositories;
    protected $connectionManager;

    public function __construct(  )
    {
        $this->connectionManager = new ConnectionManager( TRUE, DATABASE_CONFIG_FILE );
        $this->repositories = new ParameterContainer();
    }

    public function getRepository( string $repositoryName )
    {
        if( !$this->repositories->has( $repositoryName ) )
        {
            $this->createNewRepository( $repositoryName );
        }

        return $this->repositories->get( $repositoryName );
    }

    protected function createNewRepository( string $repositoryName )
    {
        $this->connectionManager->loadConnectionFromConfig();
        $fullRepositoryName = '\\StendenINF1B\\PortfolioCMS\\Kernel\\Database\\Repository\\' . $repositoryName . 'Repository';
        $repository = new $fullRepositoryName( $this );

        $this->repositories->set( $repositoryName, $repository );
    }

    public function getRepositories(  ) : ParameterContainer
    {
        return $this->repositories;
    }

    public function getConnectionManager(  ) : ConnectionManager
    {
        return $this->connectionManager;
    }

}