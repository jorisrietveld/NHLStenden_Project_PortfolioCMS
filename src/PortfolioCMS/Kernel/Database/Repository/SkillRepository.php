<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 03-01-2017 12:30
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Kernel\Database\Repository;


use StendenINF1B\PortfolioCMS\Kernel\Database\Entity\EntityInterface;
use StendenINF1B\PortfolioCMS\Kernel\Database\Entity\Skill;
use StendenINF1B\PortfolioCMS\Kernel\Database\EntityManager;
use StendenINF1B\PortfolioCMS\Kernel\Exception\RepositoryException;

class SkillRepository extends Repository
{
    /**
     * This holds an SQL statement for selecting an Skill entity from the database by its id.
     *
     * @var string
     */
    protected $getByIdSql = '
        SELECT
            `Skill`.`id`,
            `Skill`.`name`,
            `Skill`.`levelOfExperience`,
            `Skill`.`portfolioId`
        FROM `DigitalPortfolio`.`Skill`
        WHERE `Skill`.`id` = :id;
    ';

    /**
     * This holds an SQL statement for selecting an Skill entity from the database.
     *
     * @var string
     */
    protected $getBySql = '
        SELECT
            `Skill`.`id`,
            `Skill`.`name`,
            `Skill`.`levelOfExperience`,
            `Skill`.`portfolioId`
        FROM `DigitalPortfolio`.`Skill`
    ';

    /**
     * This holds an SQL statement for inserting an Skill entity into the database.
     *
     * @var string
     */
    protected $insertHobbySql = '
        INSERT INTO `DigitalPortfolio`.`Skill`( 
            `name`,
            `levelOfExperience`,
            `portfolioId`
        ) VALUES ( 
            :name,
            :levelOfExperience,
            :portfolioId
        );
    ';

    /**
     * This holds an SQL statement for updating an Skill entity in the database.
     *
     * @var string
     */
    protected $updateHobbySql = '
        UPDATE Skill SET 
            `name` = :name,
            `levelOfExperience` = :levelOfExperience,
            `portfolioId` = :portfolioId
        WHERE `Skill`.`id` = :id;
    ';

    /**
     * This holds an SQL statement for deleting an Skill entity from the database.
     *
     * @var string
     */
    protected $deleteSql = '
        DELETE FROM Skill WHERE `Skill`.`id` = :id;
    ';

    /**
     * HobbyRepository constructor.
     *
     * @param EntityManager $entityManager
     */
    public function __construct( EntityManager $entityManager )
    {
        parent::__construct( $entityManager );
    }

    /**
     * Inserts an new Skill and user in the database.
     *
     * @param Skill $skill
     * @return Skill
     * @throws RepositoryException
     */
    public function insert( Skill $skill ) : Skill
    {
        try
        {
            $statement = $this->connection->prepare( $this->insertHobbySql );

            $statement->execute( [
                ':name' => $skill->getName(),
                ':levelOfExperience' => $skill->getLevelOfExperience(),
                ':portfolioId' => $skill->getPortfolioId(),
            ] );

            $id = (int)$this->connection->lastInsertId();

            return $this->getById( $id );

        } catch ( \PDOException $exception )
        {
            $this->connection->rollBack();
            throw new RepositoryException( 'The skill could not be inserted: ' . $exception->getMessage() );
        }
    }

    /**
     * Updates an Skill in the database.
     *
     * @param Skill $skill
     * @return Skill
     * @throws RepositoryException
     */
    public function update( Skill $skill ) : Skill
    {
        try
        {
            $statement = $this->connection->prepare( $this->updateHobbySql );

            $statement->execute( [
                ':name' => $skill->getName(),
                ':levelOfExperience' => $skill->getLevelOfExperience(),
                ':portfolioId' => $skill->getPortfolioId(),
            ] );

            return $this->getById( $skill->getId() );

        } catch ( \PDOException $exception )
        {
            $this->connection->rollBack();
            throw new RepositoryException( 'The skill could not be updated: ' . $exception->getMessage() );
        }
    }

    /**
     * Creates an new Skill object from data from the database.
     *
     * @param array $databaseData
     * @return EntityInterface
     */
    public function createEntity( array $databaseData ) : EntityInterface
    {
        $skill = new Skill();
        $skill->setId( (int)$databaseData[ 'id' ] );
        $skill->setName( $databaseData[ 'name' ] );
        $skill->setLevelOfExperience( (int)$databaseData[ 'levelOfExperience' ] );
        $skill->getPortfolioId( (int)$databaseData[ 'portfolioId' ] );

        return $skill;
    }

    /**
     * Creates an new empty Skill object.
     *
     * @return EntityInterface
     */
    public function createEmptyEntity() : EntityInterface
    {
        return new Skill();
    }
}