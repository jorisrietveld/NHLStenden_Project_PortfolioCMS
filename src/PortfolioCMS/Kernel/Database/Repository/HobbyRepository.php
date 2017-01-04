<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 03-01-2017 12:20
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Kernel\Database\Repository;

use StendenINF1B\PortfolioCMS\Kernel\Database\Entity\EntityInterface;
use StendenINF1B\PortfolioCMS\Kernel\Database\Entity\Hobby;
use StendenINF1B\PortfolioCMS\Kernel\Database\EntityManager;
use StendenINF1B\PortfolioCMS\Kernel\Exception\RepositoryException;

class HobbyRepository extends Repository
{

    /**
     * This holds an SQL statement for selecting an Hobby entity from the database by its id.
     *
     * @var string
     */
    protected $getByIdSql = '
        SELECT
            `Hobby`.`id`,
            `Hobby`.`name`,
            `Hobby`.`portfolioId`
        FROM `DigitalPortfolio`.`Hobby`
        WHERE `Hobby`.`id` = :id;
    ';

    /**
     * This holds an SQL statement for selecting an Hobby entity from the database.
     *
     * @var string
     */
    protected $getBySql = '
        SELECT
            `Hobby`.`id`,
            `Hobby`.`name`,
            `Hobby`.`portfolioId`
        FROM `DigitalPortfolio`.`Hobby`
    ';

    /**
     * This holds an SQL statement for inserting an Hobby entity into the database.
     *
     * @var string
     */
    protected $insertHobbySql = '
         INSERT INTO `DigitalPortfolio`.`Hobby`( 
            `name`,
            `portfolioId`
        ) VALUES ( 
            :name,
            :portfolioId
        );
    ';

    /**
     * This holds an SQL statement for updating an Hobby entity in the database.
     *
     * @var string
     */
    protected $updateHobbySql = '
        UPDATE Hobby SET 
            `name` = :name,
            `portfolioId` = :portfolioId
        WHERE `Hobby`.`id` = :id;
    ';

    /**
     * This holds an SQL statement for deleting an entity from the database.
     *
     * @var string
     */
    protected $deleteSql = '
        DELETE FROM Hobby WHERE `Hobby`.`id` = :id;
    ';

    /**
     * HobbyRepository constructor.
     *
     * @param EntityManager $entityManager
     */
    public function __construct( EntityManager $entityManager )
    {
        parent::__construct( $entityManager );
    }

    /**
     * Inserts an new hobby in the database.
     *
     * @param Hobby $hobby
     * @return Hobby
     * @throws RepositoryException
     */
    public function insert( Hobby $hobby ) : Hobby
    {
        try
        {
            $statement = $this->connection->prepare( $this->insertHobbySql );

            $statement->execute( [
                ':name' => $hobby->getName(),
                ':portfolioId' => $hobby->getPortfolioId(),
            ] );

            $id = (int)$this->connection->lastInsertId();

            return $this->getById( $id );

        } catch ( \PDOException $exception )
        {
            $this->connection->rollBack();
            throw new RepositoryException( 'The hobby could not be inserted: ' . $exception->getMessage() );
        }
    }

    /**
     * Updates an hobby in the database.
     *
     * @param Hobby $hobby
     * @return Hobby
     * @throws RepositoryException
     */
    public function update( Hobby $hobby ) : Hobby
    {
        try
        {
            $statement = $this->connection->prepare( $this->updateHobbySql );

            $statement->execute( [
                ':name' => $hobby->getName(),
                ':portfolioId' => $hobby->getPortfolioId(),
            ] );

            return $this->getById( $hobby->getId() );

        } catch ( \PDOException $exception )
        {
            $this->connection->rollBack();
            throw new RepositoryException( 'The hobby could not be updated: ' . $exception->getMessage() );
        }
    }

    /**
     * Creates an new hobby object from data from the database.
     *
     * @param array $databaseData
     * @return EntityInterface
     */
    public function createEntity( array $databaseData ) : EntityInterface
    {
        $hobby = new Hobby();
        $hobby->setId( (int)$databaseData[ 'id' ] );
        $hobby->setName( $databaseData[ 'name' ] );
        $hobby->setPortfolio( (int)$databaseData[ 'portfolioId' ] );


        return $hobby;
    }

    /**
     * Creates an new empty hobby object.
     * @return EntityInterface
     */
    public function createEmptyEntity() : EntityInterface
    {
        return new Hobby();
    }
}