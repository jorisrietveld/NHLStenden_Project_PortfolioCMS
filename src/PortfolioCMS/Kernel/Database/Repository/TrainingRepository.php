<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 03-01-2017 12:32
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Kernel\Database\Repository;

use StendenINF1B\PortfolioCMS\Kernel\Database\Entity\EntityInterface;
use StendenINF1B\PortfolioCMS\Kernel\Database\Entity\Training;
use StendenINF1B\PortfolioCMS\Kernel\Database\EntityManager;
use StendenINF1B\PortfolioCMS\Kernel\Exception\RepositoryException;

class TrainingRepository extends Repository
{
    /**
     * This holds an SQL statement for selecting an Training entity from the database by its id.
     *
     * @var string
     */
    protected $getByIdSql = '
        SELECT
            `Training`.`id`,
            `Training`.`title`,
            `Training`.`institution`,
            `Training`.`location`,
            `Training`.`startedAt`,
            `Training`.`finishedAt`,
            `Training`.`description`,
            `Training`.`obtainedCertificate`,
            `Training`.`currentTraining`,
            `Training`.`portfolioId`
        FROM `DigitalPortfolio`.`Training`
        WHERE `Training`.`id` = :id;
    ';

    /**
     * This holds an SQL statement for selecting an Training entity from the database.
     *
     * @var string
     */
    protected $getBySql = '
        SELECT
            `Training`.`id`,
            `Training`.`title`,
            `Training`.`institution`,
            `Training`.`location`,
            `Training`.`startedAt`,
            `Training`.`finishedAt`,
            `Training`.`description`,
            `Training`.`obtainedCertificate`,
            `Training`.`currentTraining`,
            `Training`.`portfolioId`
        FROM `DigitalPortfolio`.`Training`
    ';

    /**
     * This holds an SQL statement for inserting an Training entity into the database.
     *
     * @var string
     */
    protected $insertTrainingSql = '
        INSERT INTO `DigitalPortfolio`.`Training`( 
            `title`,
            `institution`,
            `location`,
            `startedAt`,
            `finishedAt`,
            `description`,
            `obtainedCertificate`,
            `currentTraining`,
            `portfolioId`
        ) VALUES ( 
            :title,
            :institution,
            :location,
            :startedAt,
            :finishedAt,
            :description,
            :obtainedCertificate,
            :currentTraining,
            :portfolioId
        );
    ';

    /**
     * This holds an SQL statement for updating an Training entity in the database.
     *
     * @var string
     */
    protected $updateTrainingSql = '
        UPDATE Training SET 
            `title` = :title,
            `institution` = :institution,
            `location` = :location,
            `startedAt` = :startedAt,
            `finishedAt` = :finishedAt,
            `description` = :description,
            `obtainedCertificate` = :obtainedCertificate,
            `currentTraining` = :currentTraining,
            `portfolioId` = :portfolioId
        WHERE `Training`.`id` = :id;
    ';

    /**
     * This holds an SQL statement for deleting an Training entity from the database.
     *
     * @var string
     */
    protected $deleteSql = '
        DELETE FROM Training WHERE `Training`.`id` = :id;
    ';

    /**
     * TrainingRepository constructor.
     *
     * @param EntityManager $entityManager
     */
    public function __construct( EntityManager $entityManager )
    {
        parent::__construct( $entityManager );
    }

    /**
     * Inserts an new Training and user in the database.
     *
     * @param Training $training
     * @return Training
     * @throws RepositoryException
     */
    public function insert( Training $training ) : Training
    {
        try
        {
            $statement = $this->connection->prepare( $this->insertTrainingSql );
            $statement->execute( [
                ':title'               => $training->getTitle(),
                ':institution'         => $training->getInstitution(),
                ':location'            => $training->getLocation(),
                ':startedAt'           => $training->getStatedAt()->format( 'Y-m-d' ),
                ':finishedAt'          => $training->getFinishedAt()->format( 'Y-m-d' ),
                ':description'         => $training->getDescription(),
                ':obtainedCertificate' => (int)$training->getObtainedCertificate(),
                ':currentTraining'     => (int)$training->getCurrentTraining(),
                ':portfolioId'         => $training->getPortfolioId(),
            ] );

            $id = (int)$this->connection->lastInsertId();

            return $this->getById( $id );

        }
        catch ( \PDOException $exception )
        {
            throw new RepositoryException( 'The training could not be inserted: ' . $exception->getMessage() );
        }
    }

    /**
     * Updates an Training in the database.
     *
     * @param Training $training
     * @return Training
     * @throws RepositoryException
     */
    public function update( Training $training ) : Training
    {
        try
        {
            $statement = $this->connection->prepare( $this->updateTrainingSql );

            $statement->execute( [
                ':title'               => $training->getTitle(),
                ':institution'         => $training->getInstitution(),
                ':location'            => $training->getLocation(),
                ':startedAt'           => $training->getStatedAt() ? $training->getStatedAt()->format( 'Y-m-d' ) : ( new \DateTime() )->format( 'Y-m-d' ),
                ':finishedAt'          => $training->getFinishedAt() ? $training->getStatedAt()->format( 'Y-m-d' ) : ( new \DateTime() )->format( 'Y-m-d' ),
                ':description'         => $training->getDescription(),
                ':obtainedCertificate' => (int)$training->getObtainedCertificate(),
                ':currentTraining'     => (int)$training->getCurrentTraining(),
                ':portfolioId'         => $training->getPortfolioId(),
                ':id'                  => $training->getId(),
            ] );

            return $this->getById( $training->getId() );

        }
        catch ( \PDOException $exception )
        {
            throw new RepositoryException( 'The training could not be updated: ' . $exception->getMessage() );
        }
    }

    /**
     * Creates an new Training object from data from the database.
     *
     * @param array $databaseData
     * @return EntityInterface
     */
    public function createEntity( array $databaseData ) : EntityInterface
    {
        $training = new Training();
        $training->setId( (int)$databaseData[ 'id' ] );
        $training->setTitle( $databaseData[ 'title' ] );
        $training->setInstitution( $databaseData[ 'institution' ] );
        $training->setLocation( $databaseData[ 'location' ] );
        $training->setStatedAt( new \DateTime( '' ) );
        $training->setFinishedAt( new \DateTime( '' ) );
        $training->setDescription( $databaseData[ 'description' ] );
        $training->setObtainedCertificate( (bool)$databaseData[ 'obtainedCertificate' ] );
        $training->setCurrentTraining( (bool)$databaseData[ 'currentTraining' ] );
        $training->setPortfolioId( (int)$databaseData[ 'portfolioId' ] );

        return $training;
    }

    /**
     * Creates an new empty hobby object.
     *
     * @return EntityInterface
     */
    public function createEmptyEntity() : EntityInterface
    {
        return new Training();
    }
}