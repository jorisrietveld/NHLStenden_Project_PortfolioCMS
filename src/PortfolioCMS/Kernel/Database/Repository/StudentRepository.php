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
use StendenINF1B\PortfolioCMS\Kernel\Database\Helper\EntityCollection;
use StendenINF1B\PortfolioCMS\Kernel\Exception\RepositoryException;

class StudentRepository extends Repository
{
    protected $getByIdSql = '
        SELECT
            `User`.`password`,
            `User`.`accountCreated`,
            `User`.`lastLogin`,
            `User`.`email`,
            `User`.`lastIpAddress`,
            `User`.`firstName`,
            `User`.`lastName`,
            `User`.`isAdmin`,
            `User`.`active`, 
            `Student`.`userId`,
            `Student`.`address`,
            `Student`.`zipCode`,
            `Student`.`location`,
            `Student`.`dateOfBirth`,
            `Student`.`studentCode`,
            `Student`.`phoneNumber`
        FROM `DigitalPortfolio`.`Student` JOIN `DigitalPortfolio`.`User` ON `Student`.`userId` = `User`.`id`
        WHERE `Student`.`userId` = :id;
    ';

    protected $getBySql = '
        SELECT
            `User`.`password`,
            `User`.`accountCreated`,
            `User`.`lastLogin`,
            `User`.`email`,
            `User`.`lastIpAddress`,
            `User`.`firstName`,
            `User`.`lastName`,
            `User`.`isAdmin`,
            `User`.`active`, 
            `Student`.`userId`,
            `Student`.`address`,
            `Student`.`zipCode`,
            `Student`.`location`,
            `Student`.`dateOfBirth`,
            `Student`.`studentCode`,
            `Student`.`phoneNumber`
        FROM `DigitalPortfolio`.`Student` JOIN `DigitalPortfolio`.`User` ON `Student`.`userId` = `User`.`id`
    ';


    protected $insertUserSql = '
            INSERT INTO `DigitalPortfolio`.`User`( 
            `password`,
            `accountCreated`,
            `lastLogin`,
            `email`,
            `lastIpAddress`,
            `firstName`,
            `lastName`,
            `isAdmin`,
            `active`
        ) VALUES ( 
            :password,
            :accountCreated,
            :lastLogin,
            :email,
            :lastIpAddress,
            :firstName,
            :lastName,
            :isAdmin,
            :active
        );
    ';

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

    protected $updateUserSql = '
        UPDATE User SET         
            `password` = :password,
            `accountCreated` = :accountCreated,
            `lastLogin` = :lastLogin,
            `email` = :email,
            `lastIpAddress` = :lastIpAddress,
            `firstName` = :firstName,
            `lastName` = :lastName,
            `isAdmin` = :isAdmin,
            `active` = :active
        WHERE `User`.`id` = :id;
    ';

    protected $updateStudentSql = '
        UPDATE Student SET 
            `userId` = :userId,
            `address` = :address,
            `zipCode` = :zipCode,
            `location` = :location,
            `dateOfBirth` = :dateOfBirth,
            `studentCode` = :studentCode,
            `phoneNumber` = :phoneNumber
        WHERE `Student`.`userId` = :id;
    ';

    protected $deleteSql = '
        DELETE FROM Student WHERE `Student`.`userId` = :id;
    ';

    public function __construct( EntityManager $entityManager )
    {
        parent::__construct( $entityManager );
    }

    public function getById( int $id ) : EntityInterface
    {
        $statement = $this->connection->prepare( $this->getByIdSql );

        if ( $statement->execute( [ 'id' => $id ] ) )
        {
            $studentData = $statement->fetchAll( \PDO::FETCH_ASSOC );

            if ( count( $studentData ) < 1 )
            {
                return new Student();
            }

            return $this->createNewStudent( $studentData[ 0 ] );
        }
        throw new RepositoryException( sprintf( 'The query: %s could not be executed.', $this->getByIdSql ) );
    }

    public function getByCondition( $whereClause, $params ) : EntityCollection
    {
        $query = $this->getBySql . $whereClause;
        $statement = $this->connection->prepare( $query );

        if ( $statement->execute( $params ) )
        {
            $studentData = $statement->fetchAll( \PDO::FETCH_ASSOC );

            if ( count( $studentData ) < 1 )
            {
                return new Student();
            }

            return $this->createNewStudent( $studentData[ 0 ] );
        }
        throw new RepositoryException( sprintf( 'The query: %s could not be executed.', $this->getByIdSql ) );
    }

    public function getOneByCondition( $whereClause, $params ) : EntityInterface
    {
        $query = $this->getBySql . $whereClause;
        $statement = $this->connection->prepare( $query );

        if ( $statement->execute( $params ) )
        {
            $studentData = $statement->fetchAll( \PDO::FETCH_ASSOC );

            if ( count( $studentData ) < 1 )
            {
                return new Student();
            }

            return $this->createNewStudent( $studentData[ 0 ] );
        }
        throw new RepositoryException( sprintf( 'The query: %s could not be executed.', $this->getByIdSql ) );
    }

    public function insert( EntityInterface $entity )
    {
        try
        {
            $this->connection->beginTransaction();
            $userStatement = $this->connection->prepare( $this->insertUserSql );

            $userStatement->execute( [
                ':password' => $entity->getHashedPassword(),
                ':email' => $entity->getEmail(),
                ':lastIpAddress' => $entity->getLastIpAddress(),
                ':firstName' => $entity->getFisrtName(),
                ':lastName' => $entity->getLastName(),
                ':isAdmin' => $entity->getIsAdmin(),
                ':active' => $entity->getActive(),
            ] );

            $studentStatement = $this->connection->prepare( $this->insertStudentSql );
            $studentStatement->execute( [
                ':address' => $entity->getAddress(),
                ':zipCode' => $entity->getZipCode(),
                ':location' => $entity->getLocation(),
                ':dateOfBirth' => $entity->getDateOfBirth()->format( 'Y-m-d H:i:s' ),
                ':studentCode' => $entity->getStudentCode(),
                ':phoneNumber' => $entity->getPhoneNumber(),
            ] );

            $this->connection->commit();

        }
        catch ( \PDOException $exception )
        {
            $this->connection->rollBack();
            throw new RepositoryException( 'The user could not be insterted: ' . $exception->getMessage() );
        }
    }

    public function update( EntityInterface $entity )
    {
        try
        {
            $this->connection->beginTransaction();
            $userStatement = $this->connection->prepare( $this->updateUserSql );

            $userStatement->execute( [
                ':password' => $entity->getHashedPassword(),
                ':email' => $entity->getEmail(),
                ':lastIpAddress' => $entity->getLastIpAddress(),
                ':firstName' => $entity->getFisrtName(),
                ':lastName' => $entity->getLastName(),
                ':isAdmin' => $entity->getIsAdmin(),
                ':active' => $entity->getActive(),
            ] );

            $studentStatement = $this->connection->prepare( $this->updateStudentSql );
            $studentStatement->execute( [
                ':address' => $entity->getAddress(),
                ':zipCode' => $entity->getZipCode(),
                ':location' => $entity->getLocation(),
                ':dateOfBirth' => $entity->getDateOfBirth()->format( 'Y-m-d H:i:s' ),
                ':studentCode' => $entity->getStudentCode(),
                ':phoneNumber' => $entity->getPhoneNumber(),
            ] );

            $this->connection->commit();

        }
        catch ( \PDOException $exception )
        {
            $this->connection->rollBack();
            throw new RepositoryException( 'The user could not be updated: ' . $exception->getMessage() );
        }
    }

    public function delete( int $id )
    {
        try
        {
            $statement = $this->connection ->prepare( $this->deleteSql );

            if( !$statement->execute( [ ':id' => $id  ]))
            {
                throw new \PDOException( 'Could not execute the deletion of the student.');
            }
        }
        catch ( \PDOException $exception )
        {
            $this->connection->rollBack();
            throw new RepositoryException( 'The user could not be deleted: ' . $exception->getMessage() );
        }
    }

    public function createNewStudents( array $databaseStudents )
    {
        $students = new EntityCollection();

        foreach ($databaseStudents as $databaseStudent)
        {
            $students->set( $databaseStudent[ 'userId' ], $this->createNewStudent( $databaseStudent ) );
        }
    }

    public function createNewStudent( array $databaseStudent )
    {
        $student = new Student();
        $student->setId( $databaseStudent[ 'userId' ] );
        $student->setHashedPassword( $databaseStudent[ 'password' ] );
        $student->setEmail( $databaseStudent[ 'email' ] );
        $student->setAccountCreated( new \DateTime( $databaseStudent[ 'accountCreated' ] ) );
        $student->setLastLogin( new \DateTime( $databaseStudent[ 'lastLogin' ] ) );
        $student->setLastIpAddress( $databaseStudent[ 'lastIpAddress' ] );
        $student->setFirstName( $databaseStudent[ 'firstName' ] );
        $student->setLastName( $databaseStudent[ 'lastName' ] );
        $student->setIsAdmin( $databaseStudent[ 'isAdmin' ] );
        $student->setActive( $databaseStudent[ 'active' ] );
        $student->setAddress( $databaseStudent[ 'address' ] );
        $student->setZipCode( $databaseStudent[ 'zipCode' ] );
        $student->setLocation( $databaseStudent[ 'location' ] );
        $student->setDateOfBirth( $databaseStudent[ 'dateOfBirth' ] );
        $student->setStudentCode( $databaseStudent[ 'studentCode' ] );
        $student->setPhoneNumber( $databaseStudent[ 'phoneNumber' ] );

    }
}