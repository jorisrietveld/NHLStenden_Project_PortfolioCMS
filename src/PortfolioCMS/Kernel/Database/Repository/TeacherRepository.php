<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 30-12-2016 18:02
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Kernel\Database\Repository;

use StendenINF1B\PortfolioCMS\Kernel\Database\Entity\Teacher;
use StendenINF1B\PortfolioCMS\Kernel\Database\Entity\EntityInterface;
use StendenINF1B\PortfolioCMS\Kernel\Database\EntityManager;
use StendenINF1B\PortfolioCMS\Kernel\Exception\RepositoryException;

class TeacherRepository extends Repository
{
    /**
     * This holds an SQL statement for selecting an Teacher entity from the database by its id.
     *
     * @var string
     */
    protected $getByIdSql = '
        SELECT
            `User`.`id`,
            `User`.`password`,
            `User`.`accountCreated`,
            `User`.`lastLogin`,
            `User`.`email`,
            `User`.`lastIpAddress`,
            `User`.`firstName`,
            `User`.`lastName`,
            `User`.`isAdmin`,
            `User`.`active`, 
            `Teacher`.`isSLBer`
        FROM `DigitalPortfolio`.`Teacher` JOIN `DigitalPortfolio`.`User` ON `Teacher`.`userId` = `User`.`id`
        WHERE `Student`.`userId` = :id;
    ';

    /**
     * This holds an SQL statement for selecting an Teacher entity from the database.
     *
     * @var string
     */
    protected $getBySql = '
        SELECT
            `User`.`id`,
            `User`.`password`,
            `User`.`accountCreated`,
            `User`.`lastLogin`,
            `User`.`email`,
            `User`.`lastIpAddress`,
            `User`.`firstName`,
            `User`.`lastName`,
            `User`.`isAdmin`,
            `User`.`active`, 
            `Teacher`.`isSLBer`
        FROM `DigitalPortfolio`.`Teacher` JOIN `DigitalPortfolio`.`User` ON `Teacher`.`userId` = `User`.`id`
    ';

    /**
     * This holds an SQL statement for inserting an new User entity into the database.
     *
     * @var string
     */
    protected $insertUserSql = '
            INSERT INTO `DigitalPortfolio`.`User`( 
            `password`,
            `email`,
            `lastIpAddress`,
            `firstName`,
            `lastName`,
            `isAdmin`,
            `active`
        ) VALUES ( 
            :password,
            :email,
            :lastIpAddress,
            :firstName,
            :lastName,
            :isAdmin,
            :active
        );
    ';

    /**
     * This holds an SQL statement for inserting an new Teacher entity into the database.
     *
     * @var string
     */
    protected $insertTeacherSql = '
       INSERT INTO `DigitalPortfolio`.`Teacher`( 
            `userId`,
            `isSLBer`
        ) VALUES ( 
            LAST_INSERT_ID(),
            :isSLBer
        );
    ';

    /**
     * This holds an SQL statement for updating an User entity in the database.
     *
     * @var string
     */
    protected $updateUserSql = '
        UPDATE User SET         
            `password` = :password,
            `email` = :email,
            `lastIpAddress` = :lastIpAddress,
            `firstName` = :firstName,
            `lastName` = :lastName,
            `isAdmin` = :isAdmin,
            `active` = :active
        WHERE `User`.`id` = :id;
    ';

    /**
     * This holds an SQL statement for updating an Teacher entity in the database.
     *
     * @var string
     */
    protected $updateTeacherSql = '
        UPDATE Teacher SET 
            `isSLBer` = :isSLBer
        WHERE `Teacher`.`userId` = :idUser;
    ';

    /**
     * This holds an SQL statement for deleting an Teacher entity from the database.
     *
     * @var string
     */
    protected $deleteSql = '
        DELETE FROM `Teacher` WHERE `Teacher`.`userId` = :userId;
    ';

    /**
     * TeacherRepository constructor.
     *
     * @param EntityManager $entityManager
     */
    public function __construct( EntityManager $entityManager )
    {
        parent::__construct( $entityManager );
        //$this->connection = new \PDO('','','');
    }

    /**
     * Inserts an new Teacher and user in the database.
     *
     * @param Teacher $entity
     * @return Teacher
     * @throws RepositoryException
     */
    public function insert( Teacher $teacher ) : Teacher
    {
        try
        {
            $this->connection->beginTransaction();
            $userStatement = $this->connection->prepare( $this->insertUserSql );

            $userStatement->execute( [
                ':password' => $teacher->getHashedPassword(),
                ':email' => $teacher->getEmail(),
                ':lastIpAddress' => $teacher->getLastIpAddress(),
                ':firstName' => $teacher->getFirstName(),
                ':lastName' => $teacher->getLastName(),
                ':isAdmin' => (int)$teacher->getIsAdmin(),
                ':active' => (int)$teacher->getIsActive(),
            ] );

            $teacherStatement = $this->connection->prepare( $this->insertTeacherSql );
            $teacherStatement->execute( [
               ':userId' => $teacher->getId(),
                ':isSLBer' => $teacher->getIsSLBer(),
            ] );

            $this->connection->commit();

            $id = (int)$this->connection->lastInsertId();

            return $this->getById( $id );

        }
        catch ( \PDOException $exception )
        {
            $this->connection->rollBack();
            throw new RepositoryException( 'The user could not be insterted: ' . $exception->getMessage() );
        }
    }

    /**
     * Updates an teacher and user in the database.
     *
     * @param Teacher $teacher
     * @return Teacher
     * @throws RepositoryException
     */
    public function update( Teacher $teacher ) : Teacher
    {
        try
        {
            $this->connection->beginTransaction();
            $userStatement = $this->connection->prepare( $this->updateUserSql );

            $userStatement->execute( [
                ':password' => $teacher->getHashedPassword(),
                ':email' => $teacher->getEmail(),
                ':lastIpAddress' => $teacher->getLastIpAddress(),
                ':firstName' => $teacher->getFirstName(),
                ':lastName' => $teacher->getLastName(),
                ':isAdmin' => $teacher->getIsAdmin(),
                ':active' => $teacher->getIsActive(),
                ':id' => $teacher->getId(),
            ] );

            $studentStatement = $this->connection->prepare( $this->updateTeacherSql );
            $studentStatement->execute( [
                ':userId' => $teacher->getId(),
                ':isSLBer' => $teacher->getIsSLBer(),
            ] );

            $this->connection->commit();

            return $this->getById( $teacher->getId() );

        }
        catch ( \PDOException $exception )
        {
            $this->connection->rollBack();
            throw new RepositoryException( 'The teacher could not be updated: ' . $exception->getMessage() );
        }
    }

    /**
     * Creates an new Teacher object from data from the database.
     *
     * @param array $databaseTeacher
     * @return EntityInterface
     */
    public function createEntity( array $databaseTeacher ) : EntityInterface
    {
        $teacher = new Teacher();
        $teacher->setId( (int)$databaseTeacher[ 'userId' ] );
        $teacher->setHashedPassword( $databaseTeacher[ 'password' ] );
        $teacher->setEmail( $databaseTeacher[ 'email' ] );
        $teacher->setAccountCreated( new \DateTime( $databaseTeacher[ 'accountCreated' ] ) );
        $teacher->setLastLogin( new \DateTime( $databaseTeacher[ 'lastLogin' ] ) );
        $teacher->setLastIpAddress( $databaseTeacher[ 'lastIpAddress' ] );
        $teacher->setFirstName( $databaseTeacher[ 'firstName' ] );
        $teacher->setLastName( $databaseTeacher[ 'lastName' ] );
        $teacher->setIsAdmin( (bool)$databaseTeacher[ 'isAdmin' ] );
        $teacher->setActive( (bool)$databaseTeacher[ 'active' ] );
        $teacher->setIsSLBer( $databaseTeacher[ 'isSLBer' ] );

        return $teacher;
    }

    /**
     * Creates an new empty Teacher object.
     *
     * @return EntityInterface
     */
    public function createEmptyEntity(  ) : EntityInterface
    {
        return new Teacher();
    }
}