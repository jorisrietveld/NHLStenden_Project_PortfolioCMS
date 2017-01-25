<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 30-12-2016 18:01
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Kernel\Database\Repository;

use StendenINF1B\PortfolioCMS\Kernel\Database\Entity\EntityInterface;
use StendenINF1B\PortfolioCMS\Kernel\Database\Entity\Student;
use StendenINF1B\PortfolioCMS\Kernel\Database\EntityManager;
use StendenINF1B\PortfolioCMS\Kernel\Exception\RepositoryException;

class StudentRepository extends Repository
{
    /**
     * An simple trait with some helper methods for getting an user.
     */
    use UserHelper;

    /**
     * This holds an SQL statement for selecting an Student entity from the database by its id.
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
            `Student`.`address`,
            `Student`.`zipCode`,
            `Student`.`location`,
            `Student`.`dateOfBirth`,
            `Student`.`studentCode`,
            `Student`.`phoneNumber`
        FROM `DigitalPortfolio`.`Student` JOIN `DigitalPortfolio`.`User` ON `Student`.`userId` = `User`.`id`
        WHERE `Student`.`userId` = :id;
    ';

    /**
     * This holds an SQL statement for selecting an Student entity from the database.
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
            `Student`.`address`,
            `Student`.`zipCode`,
            `Student`.`location`,
            `Student`.`dateOfBirth`,
            `Student`.`studentCode`,
            `Student`.`phoneNumber`
        FROM `DigitalPortfolio`.`Student` JOIN `DigitalPortfolio`.`User` ON `Student`.`userId` = `User`.`id`
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
     * This holds an SQL statement for inserting an new Student entity into the database.
     *
     * @var string
     */
    protected $insertStudentSql = '
        INSERT INTO `DigitalPortfolio`.`Student`( 
            `userId`,
            `address`,
            `zipCode`,
            `location`,
            `dateOfBirth`,
            `studentCode`,
            `phoneNumber`
        ) VALUES ( 
            LAST_INSERT_ID(),
            :address,
            :zipCode,
            :location,
            :dateOfBirth,
            :studentCode,
            :phoneNumber
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
     * This holds an SQL statement for updating an Student entity in the database.
     *
     * @var string
     */
    protected $updateStudentSql = '
        UPDATE Student SET 
            `address` = :address,
            `zipCode` = :zipCode,
            `location` = :location,
            `dateOfBirth` = :dateOfBirth,
            `studentCode` = :studentCode,
            `phoneNumber` = :phoneNumber
        WHERE `Student`.`userId` = :userId;
    ';

    /**
     * This holds an SQL statement for deleting an Student entity from the database.
     *
     * @var string
     */
    protected $deleteSql = '
        DELETE FROM Student WHERE `Student`.`userId` = :id;
    ';

    /**
     * StudentRepository constructor.
     *
     * @param EntityManager $entityManager
     */
    public function __construct( EntityManager $entityManager )
    {
        parent::__construct( $entityManager );
    }

    /**
     * Inserts an new Student and user in the database.
     *
     * @param Student $entity
     * @return Student
     * @throws RepositoryException
     */
    public function insert( Student $student ) : Student
    {
        try
        {
            $this->connection->beginTransaction();
            $userStatement = $this->connection->prepare( $this->insertUserSql );

            $userStatement->execute( [
                ':password'      => $student->getHashedPassword(),
                ':email'         => $student->getEmail(),
                ':lastIpAddress' => $student->getLastIpAddress(),
                ':firstName'     => $student->getFirstName(),
                ':lastName'      => $student->getLastName(),
                ':isAdmin'       => (int)$student->getIsAdmin(),
                ':active'        => (int)$student->getIsActive(),
            ] );

            $studentStatement = $this->connection->prepare( $this->insertStudentSql );
            $studentStatement->execute( [
                ':address'     => $student->getAddress(),
                ':zipCode'     => $student->getZipCode(),
                ':location'    => $student->getLocation(),
                ':dateOfBirth' => $student->getDateOfBirth()->format( 'Y-m-d H:i:s' ),
                ':studentCode' => $student->getStudentCode(),
                ':phoneNumber' => $student->getPhoneNumber(),
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
     * Updates an student and user in the database.
     *
     * @param Student $student
     * @throws RepositoryException
     */
    public function update( Student $student ) : Student
    {
        try
        {
            $this->connection->beginTransaction();
            $userStatement = $this->connection->prepare( $this->updateUserSql );

            $userStatement->execute( [
                ':password'      => $student->getHashedPassword(),
                ':email'         => $student->getEmail(),
                ':lastIpAddress' => $student->getLastIpAddress(),
                ':firstName'     => $student->getFirstName(),
                ':lastName'      => $student->getLastName(),
                ':isAdmin'       => (int)$student->getIsAdmin(),
                ':active'        => (int)$student->getIsActive(),
                ':id'            => $student->getId(),
            ] );

            $studentStatement = $this->connection->prepare( $this->updateStudentSql );
            $studentStatement->execute( [
                ':address'     => $student->getAddress(),
                ':zipCode'     => $student->getZipCode(),
                ':location'    => $student->getLocation(),
                ':dateOfBirth' => $student->getDateOfBirth()->format( 'Y-m-d' ),
                ':studentCode' => $student->getStudentCode(),
                ':phoneNumber' => $student->getPhoneNumber(),
                ':userId'      => $student->getId(),
            ] );

            $this->connection->commit();

            return $this->getById( $student->getId() );

        }
        catch ( \PDOException $exception )
        {
            $this->connection->rollBack();
            throw new RepositoryException( 'The user could not be updated: ' . $exception->getMessage() );
        }
    }

    /**
     * Creates an new Student object from data from the database.
     *
     * @param array $databaseStudent
     * @return EntityInterface
     */
    public function createEntity( array $databaseStudent ) : EntityInterface
    {
        $student = new Student();
        $student->setId( (int)$databaseStudent[ 'id' ] );
        $student->setHashedPassword( $databaseStudent[ 'password' ] );
        $student->setEmail( $databaseStudent[ 'email' ] );
        $student->setAccountCreated( new \DateTime( $databaseStudent[ 'accountCreated' ] ) );
        $student->setLastLogin( new \DateTime( $databaseStudent[ 'lastLogin' ] ) );
        $student->setLastIpAddress( $databaseStudent[ 'lastIpAddress' ] );
        $student->setFirstName( $databaseStudent[ 'firstName' ] );
        $student->setLastName( $databaseStudent[ 'lastName' ] );
        $student->setIsAdmin( (bool)$databaseStudent[ 'isAdmin' ] );
        $student->setActive( (bool)$databaseStudent[ 'active' ] );
        $student->setAddress( $databaseStudent[ 'address' ] );
        $student->setZipCode( $databaseStudent[ 'zipCode' ] );
        $student->setLocation( $databaseStudent[ 'location' ] );
        $student->setDateOfBirth( new \DateTime( $databaseStudent[ 'dateOfBirth' ] ) );
        $student->setStudentCode( $databaseStudent[ 'studentCode' ] );
        $student->setPhoneNumber( $databaseStudent[ 'phoneNumber' ] );

        return $student;
    }

    /**
     * Creates an new Student object from data from the database.
     *
     * @return EntityInterface
     */
    public function createEmptyEntity() : EntityInterface
    {
        return new Student();
    }
}