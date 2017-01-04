<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 03-01-2017 12:27
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Kernel\Database\Repository;


use StendenINF1B\PortfolioCMS\Kernel\Database\Entity\EntityInterface;
use StendenINF1B\PortfolioCMS\Kernel\Database\Entity\Page;
use StendenINF1B\PortfolioCMS\Kernel\Database\EntityManager;
use StendenINF1B\PortfolioCMS\Kernel\Exception\RepositoryException;

class PageRepository extends Repository
{
    /**
     * This holds an SQL statement for selecting an Page entity from the database by its id.
     *
     * @var string
     */
    protected $getByIdSql = '
        UPDATE Page SET 
            `id` = :id,
            `name` = :name,
            `fileName` = :fileName,
            `description` = :description,
            `url` = :url,
            `themeId` = :themeId
        WHERE `Page`.`id` = :id;
    ';

    /**
     * This holds an SQL statement for selecting an Page entity from the database.
     *
     * @var string
     */
    protected $getBySql = '
        SELECT
            `Page`.`id`,
            `Page`.`name`,
            `Page`.`fileName`,
            `Page`.`description`,
            `Page`.`url`,
            `Page`.`themeId`
        FROM `DigitalPortfolio`.`Page`
    ';

    /**
     * This holds an SQL statement for inserting an new Page entity into the database.
     *
     * @var string
     */
    protected $insertPageSql = '
        INSERT INTO `DigitalPortfolio`.`Page`( 
            `name`,
            `fileName`,
            `description`,
            `url`,
            `themeId`
        ) VALUES ( 
            :name,
            :fileName,
            :description,
            :url,
            :themeId
        );
    ';

    /**
     * This holds an SQL statement for updating an Page entity in the database.
     *
     * @var string
     */
    protected $updatePageSql = '
        UPDATE Page SET 
            `id` = :id,
            `name` = :name,
            `fileName` = :fileName,
            `description` = :description,
            `url` = :url,
            `themeId` = :themeId
        WHERE `Page`.`id` = :id;
    ';

    /**
     * This holds an SQL statement for deleting an Page entity from the database.
     *
     * @var string
     */
    protected $deleteSql = '
        DELETE FROM Page WHERE `Page`.`id` = :id;
    ';

    /**
     * PageRepository constructor.
     *
     * @param EntityManager $entityManager
     */
    public function __construct( EntityManager $entityManager )
    {
        parent::__construct( $entityManager );
    }

    /**
     * Inserts an new Page in the database.
     *
     * @param Page $page
     * @return Page
     * @throws RepositoryException
     */
    public function insert( Page $page ) : Page
    {
        try
        {
            $userStatement = $this->connection->prepare( $this->insertPageSql );

            $userStatement->execute( [
                ':name' => $page->getName(),
                ':fileName' => $page->getFileName(),
                ':description' => $page->getDescription(),
                ':url' => $page->getUrl(),
                ':themeId' => $page->getThemeId(),
            ] );

            $id = (int)$this->connection->lastInsertId();

            return $this->getById( $id );

        } catch ( \PDOException $exception )
        {
            $this->connection->rollBack();
            throw new RepositoryException( 'The page could not be inserted: ' . $exception->getMessage() );
        }
    }

    /**
     * Updates an Page in the database.
     *
     * @param Page $page
     * @return Page
     * @throws RepositoryException
     */
    public function update( Page $page ) : Page
    {
        try
        {
            $userStatement = $this->connection->prepare( $this->updatePageSql );

            $userStatement->execute( [
                ':name' => $page->getName(),
                ':fileName' => $page->getFileName(),
                ':description' => $page->getDescription(),
                ':url' => $page->getUrl(),
                ':themeId' => $page->getThemeId(),
            ] );

            return $this->getById( $page->getId() );

        } catch ( \PDOException $exception )
        {
            $this->connection->rollBack();
            throw new RepositoryException( 'The page could not be updated: ' . $exception->getMessage() );
        }
    }

    /**
     * Creates an new page object from data from the database.
     *
     * @param array $databaseData
     * @return EntityInterface
     */
    public function createEntity( array $databaseData ) : EntityInterface
    {
        $page = new Page();
        $page->setId( (int)$databaseData[ 'id' ] );
        $page->setName( $databaseData[ 'name' ] );
        $page->setDescription( $databaseData[ 'description' ] );
        $page->setFileName( $databaseData[ 'fileName' ] );
        $page->setUrl( $databaseData[ 'url' ] );
        $page->setThemeId( $databaseData[ 'themeId' ] );

        return $page;
    }

    /**
     * Creates an new empty Page object.
     *
     * @return EntityInterface
     */
    public function createEmptyEntity() : EntityInterface
    {
        return new Page();
    }
}