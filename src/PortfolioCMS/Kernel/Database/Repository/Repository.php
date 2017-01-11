<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 02-01-2017 17:43
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Kernel\Database\Repository;


use DebugBar\DataCollector\PDO\TraceablePDO;
use StendenINF1B\PortfolioCMS\Kernel\Database\Entity\EntityInterface;
use StendenINF1B\PortfolioCMS\Kernel\Database\EntityManager;
use StendenINF1B\PortfolioCMS\Kernel\Database\Helper\EntityCollection;
use StendenINF1B\PortfolioCMS\Kernel\Exception\RepositoryException;

abstract class Repository
{
    /**
     * This holds an \PDO or TraceablePDO in debugging mode. it is used for communicating with the database.
     *
     * @var \PDO|TraceablePDO
     */
    protected $connection;

    /**
     * This hods the entity manager that is used for getting the database connection and for getting other Repositories
     * that implement this class.
     *
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * This holds an SQL statement for selecting an entity from the database by its id.
     *
     * @var string
     */
    protected $getByIdSql;

    /**
     * This holds an SQL statement for selecting an entity from the database.
     *
     * @var string
     */
    protected $getBySql;

    /**
     * This holds an SQL statement for deleting an entity from the database.
     *
     * @var string
     */
    protected $deleteSql;

    /**
     * Repository constructor initiates the repository class.
     *
     * @param EntityManager $entityManager
     */
    public function __construct( EntityManager $entityManager )
    {
        $this->entityManager = $entityManager;
        $this->connection = $entityManager->getConnectionManager()->getConnection()->getPdo();
    }

    /**
     * Creates an new entity from data stored in database.
     *
     * @param array $entityData
     * @return mixed
     */
    abstract protected function createEntity( array $entityData ) : EntityInterface;

    /**
     * Creates an new empty entity.
     *
     * @return mixed
     */
    abstract protected function createEmptyEntity(  ) : EntityInterface;

    /**
     * Creates an collection of entities from the database.
     *
     * @param array $entitiesData
     * @return EntityCollection
     */
    public function createEntities( array $entitiesData ) : EntityCollection
    {
        $entityCollection = new EntityCollection();

        foreach ( $entitiesData as $entityData )
        {
            $entityCollection->set( $entityData[ 'id' ], $this->createEntity( $entityData ) );
        }

        return $entityCollection;
    }

    /**
     * Gets an entity from the database.
     *
     * @param int $id
     * @return mixed
     * @throws RepositoryException
     */
    public function getById( int $id )
    {
        $statement = $this->connection->prepare( $this->getByIdSql );

        if ( $statement->execute( [ 'id' => $id ] ) )
        {
            $data = $statement->fetchAll( \PDO::FETCH_ASSOC );

            if ( count( $data ) < 1 )
            {
                return $this->createEmptyEntity();
            }

            return $this->createEntity( $data[ 0 ] );
        }
        throw new RepositoryException( sprintf( 'The query: %s could not be executed.', $this->getByIdSql ) );
    }

    /**
     * Gets an collection of all entities from the database.
     *
     * @return EntityCollection
     * @throws RepositoryException
     */
    public function getAll( ) : EntityCollection
    {
        $statement = $this->connection->prepare( $this->getBySql );

        if ( $statement->execute(  ) )
        {
            $data = $statement->fetchAll( \PDO::FETCH_ASSOC );

            if ( count( $data ) < 1 )
            {
                return $this->createEntities( $data );
            }

            return $this->createEntities( $data );
        }
        throw new RepositoryException( sprintf( 'The query: %s could not be executed.', $this->getByIdSql ) );
    }

    /**
     * Gets an collection of entities from the database based on an where clause.
     *
     * @param $whereClause
     * @param $params
     * @return EntityCollection
     * @throws RepositoryException
     */
    public function getByCondition( $whereClause, $params ) : EntityCollection
    {
        $query = $this->getBySql . ' WHERE ' . $whereClause;
        try
        {
            $statement = $this->connection->prepare( $query );

            if ( $statement->execute( $params ) )
            {
                $data = $statement->fetchAll( \PDO::FETCH_ASSOC );

                if ( count( $data ) < 1 )
                {
                    return new EntityCollection();
                }

                return $this->createEntities( $data );
            }
            throw new RepositoryException( sprintf( 'The query: %s could not be executed.', $query ) );
        }
        catch (\PDOException $exception )
        {
            throw new RepositoryException( sprintf( 'The query: %s could not be executed because: %s', $query, $exception->getMessage() ) );
        }
    }

    /**
     * Gets an single entity from the database.
     *
     * @param $whereClause
     * @param $params
     * @return mixed
     * @throws RepositoryException
     */
    public function getOneByCondition( $whereClause, $params ) : EntityInterface
    {
        $query = $this->getBySql . $whereClause;
        try
        {
            $statement = $this->connection->prepare( $query );

            if ( $statement->execute( $params ) )
            {
                $data = $statement->fetchAll( \PDO::FETCH_ASSOC );

                if ( count( $data ) < 1 )
                {
                    return $this->createEmptyEntity();
                }

                return $this->createEntity( $data[ 0 ] );
            }
            throw new RepositoryException( sprintf( 'The query: %s could not be executed.', $query ) );
        }
        catch (\PDOException $exception )
        {
            throw new RepositoryException( sprintf( 'The query: %s could not be executed because: %s', $query, $exception->getMessage() ) );
        }
    }

    /**
     * Delete an stored entity in the database.
     *
     * @param int $id
     * @throws RepositoryException
     */
    public function delete( int $id )
    {
        try
        {
            $statement = $this->connection ->prepare( $this->deleteSql );

            if( !$statement->execute( [ ':id' => $id  ]))
            {
                throw new \PDOException( 'Could not execute the deletion of the record.');
            }
        }
        catch ( \PDOException $exception )
        {
            $this->connection->rollBack();
            throw new RepositoryException( 'The record could not be deleted: ' . $exception->getMessage() );
        }
    }
}