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
use StendenINF1B\PortfolioCMS\Kernel\Database\Helper\EntityCollection;

class ImageRepository extends Repository
{
    protected $getByIdSql = '
     SELECT
        `Image`.`uploadedFileId`,
        `Image`.`name`,
        `Image`.`description`,
        `Image`.`type`,
        `Image`.`order`,
        `UploadedFile`.`fileName`,
        `UploadedFile`.`mimeType`,
        `UploadedFile`.`filePath`,
        `UploadedFile`.`PortfolioId`
    FROM `DigitalPortfolio`.`Image` JOIN `DigitalPortfolio`.`UploadedFile` ON `Image`.`UploadedFileId` = `UploadedFile`.`id`
    WHERE id = :id';

    protected $getBySql = '
      SELECT
        `Image`.`uploadedFileId`,
        `Image`.`name`,
        `Image`.`description`,
        `Image`.`type`,
        `Image`.`order`,
        `UploadedFile`.`fileName`,
        `UploadedFile`.`mimeType`,
        `UploadedFile`.`filePath`,
        `UploadedFile`.`PortfolioId`
    FROM `DigitalPortfolio`.`Image` JOIN `DigitalPortfolio`.`UploadedFile` ON `Image`.`UploadedFileId` = `UploadedFile`.`id`';

    protected $insertUploadedFileSql = '
    INSERT INTO `DigitalPortfolio`.`UploadedFile`(fileName, mimeType, filePath, portfolioId) VALUES ( :fileName, :mimeType, :filePath, :portfolioId );
    ';

    protected $insertImageSql = '
    INSERT INTO `DigitalPortfolio`.`Image`(uploadedFileId, name, description, type, order) VALUES ( LAST_INSERT_ID(), :name, :description, :type, :order )';

    protected $updateSql ='';

    protected $deleteSql = '';

    public function __construct( EntityManager $entityManager )
    {
        //$this->connection = new \PDO('','','');
        parent::__construct( $entityManager );
    }

    public function getById( int $id ) : EntityInterface
    {
        $statement = $this->connection->prepare( $this->getByIdSql );

        if( $statement->execute( [ 'id' => $id ] ))
        {
            $imageData = $statement->fetchAll( \PDO::FETCH_ASSOC );

            if( count( $imageData) < 1)
            {
                return new Image();
            }

            return $this->createNewImage( $imageData[0] );
        }
    }

    public function getByCondition( $whereClause, $params ) : EntityCollection
    {

    }

    public function getOneByCondition( $whereClause, $params ) : EntityInterface
    {

    }

    public function insert( EntityInterface $entity )
    {

    }

    public function update( EntityInterface $entity )
    {

    }

    public function delete( int $id )
    {

    }

    public function createNewImage( array $databaseData ) : Image
    {
        $image = new Image();
        $image->setId( $databaseData['uploadedFileId'] );
        $image->setName( $databaseData['name'] );
        $image->setDescription( $databaseData['description'] );
        $image->setType( $databaseData['type'] );
        $image->setOrder( $databaseData['order'] );
        $image->setFileName( $databaseData['fileName'] );
        $image->setMimeType( $databaseData['mimeType'] );
        $image->setFilePath( $databaseData['filePath'] );

        $image->setPortfolio( $this->entityManager->getRepository('Portfolio')->getById( $databaseData['PortfolioId'] ) );

        return $image;
    }
}