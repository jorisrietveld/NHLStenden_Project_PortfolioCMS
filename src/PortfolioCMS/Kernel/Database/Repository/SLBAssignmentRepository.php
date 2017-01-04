<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 03-01-2017 12:31
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Kernel\Database\Repository;


use StendenINF1B\PortfolioCMS\Kernel\Database\Entity\EntityInterface;
use StendenINF1B\PortfolioCMS\Kernel\Database\Entity\SLBAssignment;
use StendenINF1B\PortfolioCMS\Kernel\Database\EntityManager;
use StendenINF1B\PortfolioCMS\Kernel\Exception\RepositoryException;

class SLBAssignmentRepository extends Repository
{
    /**
     * This holds an SQL statement for selecting an SLBAssignment entity from the database by its id.
     *
     * @var string
     */
    protected $getByIdSql = '
        SELECT
            `UploadedFile`.`id`,
            `UploadedFile`.`fileName`,
            `UploadedFile`.`mimeType`,
            `UploadedFile`.`filePath`,
            `UploadedFile`.`portfolioId`,
            `SLBAssignment`.`name`,
	        `SLBAssignment`.`feedback`
        FROM `DigitalPortfolio`.`Image` JOIN `DigitalPortfolio`.`SLBAssignment` ON `SLBAssignment`.`uploadedFileId` = `UploadedFile`.`id`
        WHERE `Image`.`uploadedFileId` = :id;
    ';

    /**
     * This holds an SQL statement for selecting an SLBAssignment entity from the database.
     *
     * @var string
     */
    protected $getBySql = '
        SELECT
            `UploadedFile`.`id`,
            `UploadedFile`.`fileName`,
            `UploadedFile`.`mimeType`,
            `UploadedFile`.`filePath`,
            `UploadedFile`.`portfolioId`,
            `SLBAssignment`.`name`,
	        `SLBAssignment`.`feedback`
        FROM `DigitalPortfolio`.`Image` JOIN `DigitalPortfolio`.`SLBAssignment` ON `SLBAssignment`.`uploadedFileId` = `UploadedFile`.`id`
    ';

    /**
     * This holds an SQL statement for inserting an new UploadedFile entity into the database.
     *
     * @var string
     */
    protected $insertUploadedFileSql = '
        INSERT INTO `DigitalPortfolio`.`UploadedFile`( 
            `fileName`,
            `mimeType`,
            `filePath`,
            `portfolioId`
        ) VALUES ( 
            :fileName,
            :mimeType,
            :filePath,
            :portfolioId
        );
    ';

    /**
     * This holds an SQL statement for inserting an new SLBAssignment entity into the database.
     * @var string
     */
    protected $insertSLBAssignment = '
        INSERT INTO `DigitalPortfolio`.`SLBAssignment`( 
            `uploadedFileId`,
            `name`,
            `feedback`
        ) VALUES ( 
            LAST_INSERT_ID(),
            :name,
            :feedback
        );
    ';

    /**
     * This holds an SQL statement for updating an UploadedFile entity in the database.
     *
     * @var string
     */
    protected $updateUploadedFileSql = '
        UPDATE UploadedFile SET 
            `fileName` = :fileName,
            `mimeType` = :mimeType,
            `filePath` = :filePath,
            `portfolioId` = :portfolioId
        WHERE `UploadedFile`.`id` = :id;
    ';

    /**
     * This holds an SQL statement for updating an SLBAssignment entity in the database.
     * @var string
     */
    protected $updateImageSql = '
        UPDATE SLBAssignment SET 
            `name` = :name,
            `feedback` = :feedback
        WHERE `SLBAssignment`.`uploadedFileId` = :id;
    ';

    /**
     * This holds an SQL statement for deleting an SLBAssignment entity from the database.
     *
     * @var string
     */
    protected $deleteSql = '
        DELETE FROM SLBAssignment WHERE `SLBAssignment`.`uploadedFileId` = :id;
    ';

    /**
     * SLBAssignmentRepository constructor.
     *
     * @param EntityManager $entityManager
     */
    public function __construct( EntityManager $entityManager )
    {
        parent::__construct( $entityManager );
    }

    /**
     * Inserts an new SLBAssignment and uploaded file in the database.
     *
     * @param SLBAssignment $slbAssignment
     * @throws RepositoryException
     * @return SLBAssignment
     */
    public function insert( SLBAssignment $slbAssignment ) : SLBAssignment
    {
        try
        {
            $this->connection->beginTransaction();

            $uploadedFileStatement = $this->connection->prepare( $this->insertUploadedFileSql );
            $uploadedFileStatement->execute( [
                ':fileName' => $slbAssignment->getFileName(),
                ':mimeType' => $slbAssignment->getMimeType(),
                ':filePath' => $slbAssignment->getFilePath(),
                ':portfolioId' => $slbAssignment->getPortfolioId(),
            ] );

            $slbAssignmentStatement = $this->connection->prepare( $this->insertSLBAssignment );
            $slbAssignmentStatement->execute( [
                ':name' => $slbAssignment->getName(),
                ':feedback' => $slbAssignment->getFeedback(),
            ] );

            $this->connection->commit();

            $id = (int)$this->connection->lastInsertId();
            return $this->getById( $id );

        } catch ( \PDOException $exception )
        {
            $this->connection->rollBack();
            throw new RepositoryException( 'The slb assignment could not be inserted: ' . $exception->getMessage() );
        }
    }

    /**
     * Updates an SLBAssignment and uploaded file in the database.
     *
     * @param SLBAssignment $slbAssignment
     * @throws RepositoryException
     * @return SLBAssignment
     */
    public function update( SLBAssignment $slbAssignment ) : SLBAssignment
    {
        try
        {
            $this->connection->beginTransaction();

            $uploadedFileStatement = $this->connection->prepare( $this->insertUploadedFileSql );
            $uploadedFileStatement->execute( [
                ':fileName' => $slbAssignment->getFileName(),
                ':mimeType' => $slbAssignment->getMimeType(),
                ':filePath' => $slbAssignment->getFilePath(),
                ':portfolioId' => $slbAssignment->getPortfolioId(),
            ] );

            $slbAssignmentStatement = $this->connection->prepare( $this->insertSLBAssignment );
            $slbAssignmentStatement->execute( [
                ':name' => $slbAssignment->getName(),
                ':feedback' => $slbAssignment->getFeedback(),
            ] );

            $this->connection->commit();

            return $this->getById( $slbAssignment->getId() );

        } catch ( \PDOException $exception )
        {
            $this->connection->rollBack();
            throw new RepositoryException( 'The slb assignment could not be updated: ' . $exception->getMessage() );
        }
    }

    /**
     * Creates an new SLBAssignment object from data from the database.
     *
     * @param array $databaseData
     * @return EntityInterface
     */
    public function createEntity( array $databaseData ) : EntityInterface
    {
        $slbAssignment = new SLBAssignment();
        $slbAssignment->setId( (int)$databaseData[ 'id' ] );
        $slbAssignment->setFileName( $databaseData[ 'fileName' ] );
        $slbAssignment->setMimeType( $databaseData[ 'mimeType' ] );
        $slbAssignment->setFilePath( $databaseData[ 'filePath' ] );
        $slbAssignment->setName( $databaseData[ 'name' ] );
        $slbAssignment->setFeedback( $databaseData[ 'feedback' ] );

        return $slbAssignment;
    }

    /**
     * Creates an new empty SLBAssignment object.
     *
     * @return EntityInterface
     */
    public function createEmptyEntity() : EntityInterface
    {
        return new SLBAssignment();
    }
}