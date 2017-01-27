<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 03-01-2017 12:29
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Kernel\Database\Repository;

use StendenINF1B\PortfolioCMS\Kernel\Database\Entity\EntityInterface;
use StendenINF1B\PortfolioCMS\Kernel\Database\Entity\Project;
use StendenINF1B\PortfolioCMS\Kernel\Database\EntityManager;
use StendenINF1B\PortfolioCMS\Kernel\Exception\RepositoryException;

class ProjectRepository extends Repository
{
    /**
     * This holds an SQL statement for selecting an Project entity from the database by its id.
     *
     * @var string
     */
    protected $getByIdSql = '
        SELECT
            `Project`.`id`,
            `Project`.`name`,
            `Project`.`description`,
            `Project`.`link`,
            `Project`.`imageId`,
            `Project`.`portfolioId`,
            `Project`.`grade`
        FROM `DigitalPortfolio`.`Project`
        WHERE `Project`.`id` = :id;
    ';

    /**
     * This holds an SQL statement for selecting an Project entity from the database.
     *
     * @var string
     */
    protected $getBySql = '
        SELECT
            `Project`.`id`,
            `Project`.`name`,
            `Project`.`description`,
            `Project`.`link`,
            `Project`.`imageId`,
            `Project`.`portfolioId`,
            `Project`.`grade`
        FROM `DigitalPortfolio`.`Project`
    ';

    /**
     * This holds an SQL statement for inserting an Project entity into the database.
     *
     * @var string
     */
    protected $insertProjectSql = '
        INSERT INTO `DigitalPortfolio`.`Project`( 
            `name`,
            `description`,
            `link`,
            `imageId`,
            `portfolioId`,
            `grade`
        ) VALUES ( 
            :name,
            :description,
            :link,
            :imageId,
            :portfolioId,
            :grade
        );
    ';

    protected $getGradesSql = '
        SELECT
          `Project`.`id`,
          `Project`.`portfolioId`,
          `Project`.`name`,
          `Project`.`grade`
        FROM `DigitalPortfolio`.`Portfolio` JOIN `DigitalPortfolio`.`Project` ON Portfolio.id = Project.portfolioId 
        WHERE `Portfolio`.`userId` = :userId
    ';

    /**
     * This holds an SQL statement for updating an Project entity in the database.
     *
     * @var string
     */
    protected $updateProjectSql = '
        UPDATE Project SET 
            `name` = :name,
            `description` = :description,
            `link` = :link,
            `imageId` = :imageId,
            `portfolioId` = :portfolioId,
            `grade` = :grade
        WHERE `Project`.`id` = :id;
    ';

    /**
     * This holds an SQL statement for deleting an Project entity from the database.
     *
     * @var string
     */
    protected $deleteSql = '
        DELETE FROM Project WHERE `Project`.`id` = :id;
    ';

    /**
     * ProjectRepository constructor.
     *
     * @param EntityManager $entityManager
     */
    public function __construct( EntityManager $entityManager )
    {
        parent::__construct( $entityManager );
    }

    /**
     * Inserts an new Project and user in the database.
     *
     * @param Project $project
     * @return Project
     * @throws RepositoryException
     */
    public function insert( Project $project ) : Project
    {
        try
        {
            $statement = $this->connection->prepare( $this->insertProjectSql );

            $statement->execute( [
                ':name'        => $project->getName(),
                ':description' => $project->getDescription(),
                ':link'        => $project->getLink(),
                ':imageId'     => $project->getImage()->getId(),
                ':portfolioId' => $project->getPortfolioId(),
                ':grade'       => $project->getGrade(),
            ] );

            $id = (int)$this->connection->lastInsertId();

            return $this->getById( $id );

        }
        catch ( \PDOException $exception )
        {
            throw new RepositoryException( 'The project could not be inserted: ' . $exception->getMessage() );
        }
    }

    /**
     * Updates an Project in the database.
     *
     * @param Project $project
     * @return Project
     * @throws RepositoryException
     */
    public function update( Project $project ) : Project
    {
        try
        {
            $statement = $this->connection->prepare( $this->updateProjectSql );

            $statement->execute( [
                ':name'        => $project->getName(),
                ':description' => $project->getDescription(),
                ':link'        => $project->getLink(),
                ':imageId'     => $project->getImage()->getId(),
                ':portfolioId' => $project->getPortfolioId(),
                ':grade'       => $project->getGrade(),
                ':id'          => $project->getId(),
            ] );

            return $this->getById( $project->getId() );

        }
        catch ( \PDOException $exception )
        {
            throw new RepositoryException( 'The project could not be updated: ' . $exception->getMessage() );
        }
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getImage( int $id )
    {
        $imageRepository = $this->entityManager->getRepository( 'Image' );
        return $imageRepository->getById( $id );
    }

    /**
     * @param int $userId
     * @return mixed
     */
    public function getGradesByUserId( int $userId )
    {
        try
        {
            $statement = $this->connection->prepare( $this->getGradesSql );

            $statement->execute( [
                ':userId' => $userId
            ] );

            $returnArray = [];

            foreach ( $statement->fetchAll( \PDO::FETCH_CLASS, '\\StendenINF1B\\PortfolioCMS\\Kernel\\Database\\Helper\\ResultSet' ) as $resultSet)
            {
                $returnArray[ $resultSet->getInt( 'id' ) ] = $resultSet;
            }

            return $returnArray;
        }
        catch ( \PDOException $exception )
        {
            throw new RepositoryException( 'The project grades could not be fetched from the database: ' . $exception->getMessage() );
        }
    }

    /**
     * Creates an new Project object from data from the database.
     *
     * @param array $databaseData
     * @return EntityInterface
     */
    public function createEntity( array $databaseData ) : EntityInterface
    {
        $project = new Project();
        $project->setId( (int)$databaseData[ 'id' ] );
        $project->setName( $databaseData[ 'name' ] );
        $project->setDescription( $databaseData[ 'description' ] );
        $project->setLink( $databaseData[ 'link' ] );
        $project->setImage( $this->getImage( (int)$databaseData[ 'imageId' ] ) );
        $project->setPortfolioId( (int)$databaseData[ 'portfolioId' ] );
        $project->setGrade( (float)$databaseData[ 'grade' ] );

        return $project;
    }

    /**
     * Creates an new empty Project object.
     *
     * @return EntityInterface
     */
    public function createEmptyEntity() : EntityInterface
    {
        return new Project();
    }
}