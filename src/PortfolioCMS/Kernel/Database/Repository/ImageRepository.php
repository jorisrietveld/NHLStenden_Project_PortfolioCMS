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

    public function __construct( $connection )
    {
        parent::__construct( $connection );
    }

    public function getById( int $id ) : EntityInterface
    {

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
}