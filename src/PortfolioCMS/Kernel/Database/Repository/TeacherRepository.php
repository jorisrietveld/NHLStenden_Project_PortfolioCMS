<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 30-12-2016 18:02
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Kernel\Database\Repository;

use StendenINF1B\PortfolioCMS\Kernel\Database\Entity\Teacher;
use StendenINF1B\PortfolioCMS\Kernel\Database\Helper\EntityCollection;
use StendenINF1B\PortfolioCMS\Kernel\Database\Entity\EntityInterface;
use StendenINF1B\PortfolioCMS\Kernel\Database\EntityManager;
use StendenINF1B\PortfolioCMS\Kernel\Exception\RepositoryException;

class TeacherRepository extends Repository
{
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

    protected $insertTeacherSql = '
       INSERT INTO `DigitalPortfolio`.`Teacher`( 
            `userId`,
            `isSLBer`
        ) VALUES ( 
            LAST_INSERT_ID(),
            :isSLBer
        );
    ';

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

    protected $updateStudentSql = '
        UPDATE Teacher SET 
            `isSLBer` = :isSLBer
        WHERE `Teacher`.`userId` = :idUser;
    ';

    protected $deleteSql = '
        DELETE FROM Student WHERE `Student`.`userId` = :idUserId;
    ';

    public function __construct( EntityManager $entityManager )
    {
        parent::__construct( $entityManager );
        //$this->connection = new \PDO('','','');
    }

    /**
     * Inserts an new Teacher and user in the database.
     *
     * @param Teacher $entity
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

            $studentStatement = $this->connection->prepare( $this->insertStudentSql );
            $studentStatement->execute( [
                ':address' => $teacher->getAddress(),
                ':zipCode' => $teacher->getZipCode(),
                ':location' => $teacher->getLocation(),
                ':dateOfBirth' => $teacher->getDateOfBirth()->format( 'Y-m-d H:i:s' ),
                ':studentCode' => $teacher->getStudentCode(),
                ':phoneNumber' => $teacher->getPhoneNumber(),
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
     * @throws RepositoryException
     */
    public function update( Teacher $teacher )
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

            $studentStatement = $this->connection->prepare( $this->updateStudentSql );
            $studentStatement->execute( [
                ':address' => $teacher->getAddress(),
                ':zipCode' => $teacher->getZipCode(),
                ':location' => $teacher->getLocation(),
                ':dateOfBirth' => $teacher->getDateOfBirth()->format( 'Y-m-d H:i:s' ),
                ':studentCode' => $teacher->getStudentCode(),
                ':phoneNumber' => $teacher->getPhoneNumber(),
                ':userId' => $teacher->getId(),
            ] );

            $this->connection->commit();

        }
        catch ( \PDOException $exception )
        {
            $this->connection->rollBack();
            throw new RepositoryException( 'The teacher could not be updated: ' . $exception->getMessage() );
        }
    }


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

    public function createEmptyEntity(  ) : EntityInterface
    {
        return new Teacher();
    }
}