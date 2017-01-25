<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 03-01-2017 12:25
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Kernel\Database\Repository;

use StendenINF1B\PortfolioCMS\Kernel\Database\Entity\EntityInterface;
use StendenINF1B\PortfolioCMS\Kernel\Database\Entity\JobExperience;
use StendenINF1B\PortfolioCMS\Kernel\Database\EntityManager;
use StendenINF1B\PortfolioCMS\Kernel\Exception\RepositoryException;

class JobExperienceRepository extends Repository
{
    /**
     * This holds an SQL statement for selecting an JobExperience entity from the database by its id.
     *
     * @var string
     */
    protected $getByIdSql = '
        SELECT
            `JobExperience`.`id`,
            `JobExperience`.`location`,
            `JobExperience`.`startedAt`,
            `JobExperience`.`endedAt`,
            `JobExperience`.`description`,
            `JobExperience`.`isInternship`,
            `JobExperience`.`portfolioId`
        FROM `DigitalPortfolio`.`JobExperience`
        WHERE `JobExperience`.`id` = :id;
    ';

    /**
     * This holds an SQL statement for selecting an JobExperience entity from the database.
     *
     * @var string
     */
    protected $getBySql = '
        SELECT
            `JobExperience`.`id`,
            `JobExperience`.`location`,
            `JobExperience`.`startedAt`,
            `JobExperience`.`endedAt`,
            `JobExperience`.`description`,
            `JobExperience`.`isInternship`,
            `JobExperience`.`portfolioId`
        FROM `DigitalPortfolio`.`JobExperience`
    ';

    /**
     * This holds an SQL statement for inserting an JobExperience entity into the database.
     *
     * @var string
     */
    protected $insertJobExperienceSql = '
       INSERT INTO `DigitalPortfolio`.`JobExperience`( 
            `location`,
            `startedAt`,
            `endedAt`,
            `description`,
            `isInternship`,
            `portfolioId`
        ) VALUES ( 
            :location,
            :startedAt,
            :endedAt,
            :description,
            :isInternship,
            :portfolioId
        );
    ';

    /**
     * This holds an SQL statement for updating an JobExperience entity in the database.
     *
     * @var string
     */
    protected $updateJobExperienceSql = '
        UPDATE JobExperience SET 
            `location` = :location,
            `startedAt` = :startedAt,
            `endedAt` = :endedAt,
            `description` = :description,
            `isInternship` = :isInternship,
            `portfolioId` = :portfolioId
        WHERE `JobExperience`.`id` = :id;
    ';

    /**
     * This holds an SQL statement for deleting an JobExperience entity from the database.
     *
     * @var string
     */
    protected $deleteSql = '
        DELETE FROM JobExperience WHERE `JobExperience`.`id` = :id;
    ';

    /**
     * JobExperienceRepository constructor.
     *
     * @param EntityManager $entityManager
     */
    public function __construct( EntityManager $entityManager )
    {
        parent::__construct( $entityManager );
    }

    /**
     * Inserts an new job experience in the database.
     *
     * @param JobExperience $jobExperience
     * @throws RepositoryException
     */
    public function insert( JobExperience $jobExperience ) : JobExperience
    {
        try
        {
            $statement = $this->connection->prepare( $this->insertJobExperienceSql );

            $statement->execute( [
                ':location'     => $jobExperience->getLocation(),
                ':startedAt'    => $jobExperience->getStartedAt()->format( 'Y-m-d H:i:s' ),
                ':endedAt'      => $jobExperience->getEndedAt()->format( 'Y-m-d H:i:s' ),
                ':description'  => $jobExperience->getDescription(),
                ':isInternship' => (int)$jobExperience->getIsInternship(),
                ':portfolioId'  => (int)$jobExperience->getPortfolioId(),
            ] );

            $id = (int)$this->connection->lastInsertId();

            return $this->getById( $id );

        }
        catch ( \PDOException $exception )
        {
            throw new RepositoryException( 'The job experience could not be inserted: ' . $exception->getMessage() );
        }
    }

    /**
     * Updates an job experience in the database.
     *
     * @param JobExperience $jobExperience
     * @return JobExperience
     * @throws RepositoryException
     */
    public function update( JobExperience $jobExperience ) : JobExperience
    {
        try
        {
            $statement = $this->connection->prepare( $this->updateJobExperienceSql );

            $statement->execute( [
                ':id'           => (int)$jobExperience->getId(),
                ':location'     => $jobExperience->getLocation(),
                ':startedAt'    => $jobExperience->getStartedAt()->format( 'Y-m-d H:i:s' ),
                ':endedAt'      => $jobExperience->getEndedAt()->format( 'Y/m/d H:i:s' ),
                ':description'  => $jobExperience->getDescription(),
                ':isInternship' => (int)$jobExperience->getIsInternship(),
                ':portfolioId'  => (int)$jobExperience->getPortfolioId(),
            ] );

            return $this->getById( $jobExperience->getId() );

        }
        catch ( \PDOException $exception )
        {
            throw new RepositoryException( 'The job experience could not be updated: ' . $exception->getMessage() );
        }
    }

    /**
     * Creates an new job experience object from data from the database.
     *
     * @param array $databaseData
     * @return EntityInterface
     */
    public function createEntity( array $databaseData ) : EntityInterface
    {
        $jobExperience = new JobExperience();
        $jobExperience->setId( (int)$databaseData[ 'id' ] );
        $jobExperience->setLocation( $databaseData[ 'location' ] );
        $jobExperience->setStartedAt( new \DateTime( $databaseData[ 'startedAt' ] ) );
        $jobExperience->setEndedAt( new \DateTime( $databaseData[ 'endedAt' ] ) );
        $jobExperience->setDescription( $databaseData[ 'description' ] );
        $jobExperience->setIsInternship( (bool)$databaseData[ 'isInternship' ] );
        $jobExperience->setPortfolioId( (int)$databaseData[ 'portfolioId' ] );

        return $jobExperience;
    }

    /**
     * Creates an empty job experience object.
     *
     * @return EntityInterface
     */
    public function createEmptyEntity() : EntityInterface
    {
        return new JobExperience();
    }
}