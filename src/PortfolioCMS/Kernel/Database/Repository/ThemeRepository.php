<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 03-01-2017 12:31
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Kernel\Database\Repository;

use StendenINF1B\PortfolioCMS\Kernel\Database\Entity\EntityInterface;
use StendenINF1B\PortfolioCMS\Kernel\Database\Entity\Theme;
use StendenINF1B\PortfolioCMS\Kernel\Database\EntityManager;
use StendenINF1B\PortfolioCMS\Kernel\Database\Helper\EntityCollection;
use StendenINF1B\PortfolioCMS\Kernel\Exception\RepositoryException;

class ThemeRepository extends Repository
{
    /**
     * This holds an SQL statement for selecting an Theme entity from the database by its id.
     *
     * @var string
     */
    protected $getByIdSql = '
        SELECT
            `Theme`.`id`,
            `Theme`.`name`,
            `Theme`.`author`,
            `Theme`.`description`,
            `Theme`.`directoryName`
        FROM `DigitalPortfolio`.`Theme`
        WHERE `Theme`.`id` = :id;
    ';

    /**
     * This holds an SQL statement for selecting an Theme entity from the database.
     *
     * @var string
     */
    protected $getBySql = '
        SELECT
            `Theme`.`id`,
            `Theme`.`name`,
            `Theme`.`author`,
            `Theme`.`description`,
            `Theme`.`directoryName`
        FROM `DigitalPortfolio`.`Theme`
    ';

    /**
     * This holds an SQL statement for inserting an Theme entity into the database.
     *
     * @var string
     */
    protected $insertThemeSql = '
        INSERT INTO `DigitalPortfolio`.`Theme`( 
            `author`,
            `Theme`.`name`,
            `description`,
            `directoryName`
        ) VALUES ( 
            :author,
            :name,
            :description,
            :directoryName
        );
    ';

    /**
     * This holds an SQL statement for updating an Theme entity in the database.
     *
     * @var string
     */
    protected $updateThemeSql = '
        UPDATE Theme SET 
            `author` = :author,
            `name` = :name,
            `description` = :description,
            `directoryName` = :directoryName
        WHERE `Theme`.`id` = :id;
    ';

    /**
     * This holds an SQL statement for deleting an Theme entity from the database.
     *
     * @var string
     */
    protected $deleteSql = '
        DELETE FROM Theme WHERE `Theme`.`id` = :id;
    ';

    /**
     * ThemeRepository constructor.
     *
     * @param EntityManager $entityManager
     */
    public function __construct( EntityManager $entityManager )
    {
        parent::__construct( $entityManager );
    }

    /**
     * Inserts an new theme and user in the database.
     *
     * @param Theme $theme
     * @return Theme
     * @throws RepositoryException
     */
    public function insert( Theme $theme ) : Theme
    {
        try
        {
            $statement = $this->connection->prepare( $this->insertThemeSql );

            $statement->execute( [
                ':author'        => $theme->getAuthor(),
                ':name'          => $theme->getName(),
                ':description'   => $theme->getDescription(),
                ':directoryName' => $theme->getDirectoryName(),
            ] );

            $id = (int)$this->connection->lastInsertId();

            return $this->getById( $id );

        }
        catch ( \PDOException $exception )
        {
            throw new RepositoryException( 'The theme could not be inserted: ' . $exception->getMessage() );
        }
    }

    /**
     * Updates an theme in the database.
     *
     * @param Theme $theme
     * @return Theme
     * @throws RepositoryException
     */
    public function update( Theme $theme ) : Theme
    {
        try
        {
            $statement = $this->connection->prepare( $this->updateThemeSql );

            $statement->execute( [
                ':author'        => $theme->getAuthor(),
                ':name'          => $theme->getName(),
                ':description'   => $theme->getDescription(),
                ':directoryName' => $theme->getDirectoryName(),
            ] );

            return $this->getById( $theme->getId() );

        }
        catch ( \PDOException $exception )
        {
            throw new RepositoryException( 'The theme could not be updated: ' . $exception->getMessage() );
        }
    }

    public function getPagesByThemeId( int $themeId ) : EntityCollection
    {
        $pageManager = $this->entityManager->getRepository( 'Page' );

        return $pageManager->getByCondition( '`themeId` = :whereThemeId', [ ':whereThemeId' => $themeId ] );
    }

    /**
     * Creates an new Theme object from data from the database.
     *
     * @param array $databaseData
     * @return EntityInterface
     */
    public function createEntity( array $databaseData ) : EntityInterface
    {
        $theme = new Theme();
        $theme->setId( (int)$databaseData[ 'id' ] );
        $theme->setName( $databaseData[ 'name' ] );
        $theme->setAuthor( $databaseData[ 'author' ] );
        $theme->setDescription( $databaseData[ 'description' ] );
        $theme->setDirectoryName( $databaseData[ 'directoryName' ] );
        $theme->setPages( $this->getPagesByThemeId( (int)$databaseData[ 'id' ] ) );

        return $theme;
    }

    /**
     * Creates an new empty Theme object.
     *
     * @return EntityInterface
     */
    public function createEmptyEntity() : EntityInterface
    {
        return new Theme();
    }

    /**
     * @param string $themeName
     * @return Theme
     */
    public function getByName( string $themeName ) : Theme
    {
        return $this->getOneByCondition( 'WHERE name=:whereName', [
            ':whereName',
            $themeName,
        ] );
    }
}