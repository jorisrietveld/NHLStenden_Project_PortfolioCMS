<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 03-01-2017 12:27
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Kernel\Database\Repository;

use StendenINF1B\PortfolioCMS\Kernel\Database\Entity\EntityInterface;
use StendenINF1B\PortfolioCMS\Kernel\Database\Entity\Portfolio;
use StendenINF1B\PortfolioCMS\Kernel\Database\Entity\PortfolioMetadata;
use StendenINF1B\PortfolioCMS\Kernel\Database\EntityManager;
use StendenINF1B\PortfolioCMS\Kernel\Database\Helper\EntityCollection;
use StendenINF1B\PortfolioCMS\Kernel\Exception\RepositoryException;

/**
 * Class PortfolioRepository
 *
 * @package StendenINF1B\PortfolioCMS\Kernel\Database\Repository
 */
class PortfolioRepository extends Repository
{
    /**
     * This holds an SQL statement for selecting an Portfolio entity from the database by its id.
     *
     * @var string
     */
    protected $getByIdSql = '
        SELECT
            `Portfolio`.`id`,
            `Portfolio`.`themeId`,
            `Portfolio`.`title`,
            `Portfolio`.`url`,
            `Portfolio`.`grade`,
            `Portfolio`.`userId`
        FROM `DigitalPortfolio`.`Portfolio`
        WHERE `Portfolio`.`id` = :id;
    ';

    /**
     * This holds an SQL statement for selecting an Portfolio entity from the database.
     *
     * @var string
     */
    protected $getBySql = '
        SELECT
            `Portfolio`.`id`,
            `Portfolio`.`themeId`,
            `Portfolio`.`title`,
            `Portfolio`.`url`,
            `Portfolio`.`grade`,
            `Portfolio`.`userId`
        FROM `DigitalPortfolio`.`Portfolio`
    ';

    /**
     * This holds an SQL statement for inserting an Portfolio entity into the database.
     *
     * @var string
     */
    protected $insertPortfolioSql = '
        INSERT INTO `DigitalPortfolio`.`Portfolio`( 
            `themeId`,
            `title`,
            `url`,
            `grade`,
            `userId`
        ) VALUES ( 
            :themeId,
            :title,
            :url,
            :grade,
            :userId
        );
    ';

    /**
     * This holds an SQL statement for updating an Portfolio entity in the database.
     *
     * @var string
     */
    protected $updatePortfolioSQL = '
        UPDATE Portfolio SET 
            `themeId` = :themeId,
            `title` = :title,
            `url` = :url,
            `grade` = :grade,
            `userId` = :userId
        WHERE `Portfolio`.`id` = :id;
    ';

    /**
     * This holds an SQL statement for selecting metadata about all portfolio's.
     *
     * @var string
     */
    protected $getPortfolioMetaData = '
        SELECT
            `Portfolio`.`id`,
            `Portfolio`.`title`,
            `Portfolio`.`url`,
            `Portfolio`.`themeId`,
            `User`.`firstName`,
            `User`.`lastName`,
            `Portfolio`.`userId`
        FROM `DigitalPortfolio`.`Portfolio` JOIN `DigitalPortfolio`.`User` ON Portfolio.userId = User.id
    ';

    /**
     * This holds an SQL statement for deleting an Portfolio entity from the database.
     *
     * @var string
     */
    protected $deleteSql = '
        DELETE FROM Portfolio WHERE `Portfolio`.`id` = :id;
    ';

    /**
     * PortfolioRepository constructor.
     *
     * @param EntityManager $entityManager
     */
    public function __construct( EntityManager $entityManager )
    {
        parent::__construct( $entityManager );
    }

    /**
     * Inserts an new Portfolio and user in the database.
     *
     * @param Portfolio $portfolio
     * @return Portfolio
     * @throws RepositoryException
     */
    public function insert( Portfolio $portfolio ) : Portfolio
    {
        try
        {
            $statement = $this->connection->prepare( $this->insertPortfolioSql );

            $statement->execute( [
                ':themeId' => $portfolio->getTheme()->getId(),
                ':title'   => $portfolio->getTitle(),
                ':url'     => $portfolio->getUrl(),
                ':grade'   => $portfolio->getGrade(),
                ':userId'  => $portfolio->getStudent()->getId(),
            ] );

            $id = (int)$this->connection->lastInsertId();

            return $this->getById( $id );

        }
        catch ( \PDOException $exception )
        {
            throw new RepositoryException( 'The portfolio could not be inserted: ' . $exception->getMessage() );
        }
    }

    /**
     * Updates an Portfolio in the database.
     *
     * @param Portfolio $portfolio
     * @return Portfolio
     * @throws RepositoryException
     */
    public function update( Portfolio $portfolio ) : Portfolio
    {
        try
        {
            $statement = $this->connection->prepare( $this->updatePortfolioSQL );

            $statement->execute( [
                ':themeId' => $portfolio->getTheme()->getId(),
                ':title'   => $portfolio->getTitle(),
                ':url'     => $portfolio->getUrl(),
                ':grade'   => $portfolio->getGrade(),
                ':userId'  => $portfolio->getStudent()->getId(),
                ':id'      => $portfolio->getId(),
            ] );

            return $this->getById( $portfolio->getId() );

        }
        catch ( \PDOException $exception )
        {
            throw new RepositoryException( 'The Portfolio could not be updated: ' . $exception->getMessage() );
        }
    }

    /**
     * Gets metadata about the portfolios.
     *
     * @return EntityCollection
     * @throws RepositoryException
     */
    public function getPortfolioMetaData() : EntityCollection
    {
        $statement = $this->connection->prepare( $this->getPortfolioMetaData );

        if ( $statement->execute() )
        {
            $metaDataCollection = new EntityCollection();

            $pagesRepository = $this->entityManager->getRepository( 'Page' );
            $pages = $pagesRepository->getAll();

            foreach ($statement->fetchAll( \PDO::FETCH_CLASS, '\\StendenINF1B\\PortfolioCMS\\Kernel\\Database\\Helper\\ResultSet' ) as $resultSet)
            {
                $portfolioPages = $pages->getEntitiesWith( 'themeId', $resultSet->getInt( 'themeId' ) );

                $portfolioMetadata = new PortfolioMetadata();
                $portfolioMetadata->setId( $resultSet->getInt( 'id' ) );
                $portfolioMetadata->setUrl( $resultSet->getString( 'url' ) );
                $portfolioMetadata->setTitle( $resultSet->getString( 'title' ) );
                $portfolioMetadata->setStudentFirstName( $resultSet->getString( 'firstName' ) );
                $portfolioMetadata->setStudentLastName( $resultSet->getString( 'lastName' ) );
                $portfolioMetadata->setPortfolioSubPages( $portfolioPages );
                $portfolioMetadata->setStudentId( $resultSet->getInt( 'userId' ) );
                $metaDataCollection->set( $portfolioMetadata->getId(), $portfolioMetadata );
            }
            return $metaDataCollection;
        }
        throw new RepositoryException( sprintf( 'The query: %s could not be executed.', $this->getByIdSql ) );
    }

    /**
     * Creates an new Portfolio object from data from the database. It also contains all entities that have an N:M retation
     * with the portfolio.
     *
     * @param array $databaseData
     * @return EntityInterface
     */
    public function createEntity( array $databaseData ) : EntityInterface
    {
        $themeManager = $this->entityManager->getRepository( 'Theme' );
        $imageManager = $this->entityManager->getRepository( 'Image' );
        $jobExperienceManager = $this->entityManager->getRepository( 'JobExperience' );
        $languageManager = $this->entityManager->getRepository( 'Language' );
        $projectManager = $this->entityManager->getRepository( 'Project' );
        $skillManager = $this->entityManager->getRepository( 'Skill' );
        $slbAssignmentManager = $this->entityManager->getRepository( 'SLBAssignment' );
        $trainingManager = $this->entityManager->getRepository( 'Training' );
        $hobbyManager = $this->entityManager->getRepository( 'Hobby' );
        $studentManager = $this->entityManager->getRepository( 'Student' );

        $whereClause = '`portfolioId` = :wherePortfolioId';
        $param = [ ':wherePortfolioId' => $databaseData[ 'id' ] ];

        $portfolio = new Portfolio();

        $portfolio->setId(
            $databaseData[ 'id' ]
        );
        $portfolio->setTitle(
            $databaseData[ 'title' ]
        );
        $portfolio->setUrl(
            $databaseData[ 'url' ]
        );
        $portfolio->setGrade(
            (float)$databaseData[ 'grade' ]
        );
        $portfolio->setTheme(
            $themeManager->getById( $databaseData[ 'themeId' ] )
        );
        $portfolio->setImages(
            $imageManager->getByCondition( '`UploadedFile`.`portfolioId` = :wherePortfolioId', $param )
        );
        $portfolio->setJobExperience(
            $jobExperienceManager->getByCondition( $whereClause, $param )
        );
        $portfolio->setLanguage(
            $languageManager->getByCondition( $whereClause, $param )
        );
        $portfolio->setProjects(
            $projectManager->getByCondition( $whereClause, $param )
        );
        $portfolio->setSkills(
            $skillManager->getByCondition( $whereClause, $param )
        );
        $portfolio->setSlbAssignments(
            $slbAssignmentManager->getByCondition( '`UploadedFile`.`portfolioId` = :wherePortfolioId', $param )
        );
        $portfolio->setTrainings(
            $trainingManager->getByCondition( $whereClause, $param )
        );
        $portfolio->setStudent(
            $studentManager->getbyId( $databaseData[ 'userId' ] )
        );
        $portfolio->setHobbies(
            $hobbyManager->getByCondition( $whereClause, $param )
        );
        $portfolio->setPages(
            $themeManager->getPagesByThemeId( $databaseData[ 'themeId' ] )
        );

        $portfolio->setCv(
            $slbAssignmentManager->getCv( $databaseData['id'] )
        );

        return $portfolio;
    }

    /**
     * Creates an new empty Portfolio object.
     *
     * @return EntityInterface
     */
    public function createEmptyEntity() : EntityInterface
    {
        return new Portfolio();
    }

    public function getByUserId( int $userId )
    {
        return $this->getOneByCondition( 'WHERE userId = :whereUserId', [ 'whereUserId' => $userId ] );
    }
}