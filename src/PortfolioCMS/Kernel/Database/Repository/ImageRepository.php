<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 30-12-2016 18:02
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Kernel\Database\Repository;


use StendenINF1B\PortfolioCMS\Kernel\Database\Entity\EntityInterface;
use StendenINF1B\PortfolioCMS\Kernel\Database\Entity\Image;
use StendenINF1B\PortfolioCMS\Kernel\Database\EntityManager;
use StendenINF1B\PortfolioCMS\Kernel\Exception\RepositoryException;

class ImageRepository extends Repository
{
    /**
     * @var string
     */
    protected $getByIdSql = '
        SELECT
            `UploadedFile`.`id`,
            `UploadedFile`.`fileName`,
            `UploadedFile`.`mimeType`,
            `UploadedFile`.`filePath`,
            `UploadedFile`.`portfolioId`,
            `Image`.`name`,
            `Image`.`description`,
            `Image`.`type`,
            `Image`.`order`
        FROM `DigitalPortfolio`.`Image` JOIN `DigitalPortfolio`.`UploadedFile` ON `Image`.`uploadedFileId` = `UploadedFile`.`id`
        WHERE `Image`.`uploadedFileId` = :id;
    ';

    /**
     * @var string
     */
    protected $getBySql = '
        SELECT
            `UploadedFile`.`id`,
            `UploadedFile`.`fileName`,
            `UploadedFile`.`mimeType`,
            `UploadedFile`.`filePath`,
            `UploadedFile`.`portfolioId`,
            `Image`.`name`,
            `Image`.`description`,
            `Image`.`type`,
            `Image`.`order`
        FROM `DigitalPortfolio`.`Image` JOIN `DigitalPortfolio`.`UploadedFile` ON `Image`.`uploadedFileId` = `UploadedFile`.`id`
    ';

    /**
     * @var string
     */
    protected $insertUploadedFileSql = '
        INSERT INTO `DigitalPortfolio`.`UploadedFile`( 
            `id`,
            `fileName`,
            `mimeType`,
            `filePath`,
            `portfolioId`
        ) VALUES ( 
            LAST_INSERT_ID(),
            :fileName,
            :mimeType,
            :filePath,
            :portfolioId
        );
    ';

    /**
     * @var string
     */
    protected $insertImageSql = '
        INSERT INTO `DigitalPortfolio`.`Image`( 
            `uploadedFileId`,
            `name`,
            `description`,
            `type`,
            `order`
        ) VALUES ( 
            :uploadedFileId,
            :name,
            :description,
            :type,
            :order
        );
    ';

    /**
     * @var string
     */
    protected $updateImageSql = '
        UPDATE Image SET 
            `uploadedFileId` = :uploadedFileId,
            `name` = :name,
            `description` = :description,
            `type` = :type,
            `order` = :order
        WHERE `Image`.`uploadedFileId` = :id;
    ';

    /**
     * @var string
     */
    protected $updateUploadedFileSql = '
        UPDATE UploadedFile SET 
            `id` = :id,
            `fileName` = :fileName,
            `mimeType` = :mimeType,
            `filePath` = :filePath,
            `portfolioId` = :portfolioId
        WHERE `UploadedFile`.`id` = :id;
    ';

    /**
     * @var string
     */
    protected $deleteSql = '
        DELETE FROM Image WHERE `Image`.`uploadedFileId` = :id;
    ';

    /**
     * ImageRepository constructor.
     *
     * @param EntityManager $entityManager
     */
    public function __construct( EntityManager $entityManager )
    {
        parent::__construct( $entityManager );
    }

    /**
     * Inserts an new image and uploaded file in the database.
     *
     * @param Image $image
     * @throws RepositoryException
     * @return Image
     */
    public function insert( Image $image ) : Image
    {
        try
        {
            $this->connection->beginTransaction();

            $uploadedFileStatement = $this->connection->prepare( $this->insertUploadedFileSql );
            $uploadedFileStatement->execute( [
                ':fileName' => $image->getFileName(),
                ':mimeType' => $image->getMimeType(),
                ':filePath' => $image->getFilePath(),
                ':portfolioId' => $image->getPortfolioId(),
            ] );

            $imageStatement = $this->connection->prepare( $this->insertImageSql );
            $imageStatement->execute( [
                ':name' => $image->getName(),
                ':description' => $image->getDescription(),
                ':type' => $image->getType(),
                ':order' => $image->getOrder(),
            ] );

            $this->connection->commit();

            $id = (int)$this->connection->lastInsertId();
            return $this->getById( $id );

        } catch ( \PDOException $exception )
        {
            $this->connection->rollBack();
            throw new RepositoryException( 'The image could not be inserted: ' . $exception->getMessage() );
        }
    }

    /**
     * Updates an image and uploaded file in the database.
     *
     * @param Image $image
     * @throws RepositoryException
     * @return Image
     */
    public function update( Image $image ) : Image
    {
        try
        {
            $this->connection->beginTransaction();

            $uploadedFileStatement = $this->connection->prepare( $this->updateUploadedFileSql );
            $uploadedFileStatement->execute( [
                ':id' => $image->getId(),
                ':fileName' => $image->getFileName(),
                ':mimeType' => $image->getMimeType(),
                ':filePath' => $image->getFilePath(),
                ':portfolioId' => $image->getPortfolioId(),
            ] );

            $imageStatement = $this->connection->prepare( $this->updateImageSql );
            $imageStatement->execute( [
                ':uploadedFileId' => $image->getId(),
                ':name' => $image->getName(),
                ':description' => $image->getDescription(),
                ':type' => $image->getType(),
                ':order' => $image->getOrder(),
            ] );

            $this->connection->commit();

            return $this->getById( $image->getId() );

        } catch ( \PDOException $exception )
        {
            $this->connection->rollBack();
            throw new RepositoryException( 'The image could not be updated: ' . $exception->getMessage() );
        }
    }

    /**
     * Creates an new image object from data from the database.
     *
     * @param array $databaseData
     * @return EntityInterface
     */
    public function createEntity( array $databaseData ) : EntityInterface
    {
        $image = new Image();
        $image->setId( (int)$databaseData[ 'id' ] );
        $image->setFileName( $databaseData[ 'fileName' ] );
        $image->setMimeType( $databaseData[ 'mimeType' ] );
        $image->setFilePath( $databaseData[ 'filePath' ] );
        $image->setPortfolioId( (int)$databaseData[ 'portfolioId' ] );
        $image->setName( $databaseData['name']);
        $image->setDescription( $databaseData['description']);
        $image->setType( $databaseData['type']);
        $image->setOrder( (int)$databaseData['order']);

        return $image;
    }

    /**
     * @return EntityInterface
     */
    public function createEmptyEntity() : EntityInterface
    {
        return new Image();
    }
}