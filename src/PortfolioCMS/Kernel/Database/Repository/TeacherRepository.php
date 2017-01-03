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

class TeacherRepository
{
    protected $getByIdSql = '
        SELECT 
            Teacher.userId,
            Teacher.isSLBer,
            User.password,
            User.accountCreated,
            User.lastLogin,
            User.email,
            User.lastIpAddress,
            User.firstName,
            User.lastName,
            User.isAdmin,
            User.active
        FROM `DigitalPortfolio`.`Teacher` JOIN `DigitalPortfolio`.`User` ON `User`.`id` = `Teacher`.`userId`
        WHERE id = :id';

    protected $getBySql = '
        SELECT 
            Teacher.userId,
            Teacher.isSLBer,
            User.password,
            User.accountCreated,
            User.lastLogin,
            User.email,
            User.lastIpAddress,
            User.firstName,
            User.lastName,
            User.isAdmin,
            User.active
        FROM `DigitalPortfolio`.`Teacher` JOIN `DigitalPortfolio`.`User` ON `User`.`id` = `Teacher`.`userId`';

    protected $insertUserSql = '
      INSERT INTO DigitalPortfolio.User(password, email, lastIpAddress, firstName, lastName, isAdmin, active) 
      VALUES ( :password, :email, :lastIpAddress, :firstName, :lastName, :isAdmin, :active)';

    protected $insertTeacherSql = '
        INSERT INTO DigitalPortfolio.Teacher(userId, isSLBer) VALUES ( LAST_INSERT_ID(), :isSLBer )';

    protected $updateSql ='UPDATE DigitalPortfolio.Teacher SET ';

    protected $deleteSql = 'DELETE FROM DigitalPortfolio.Teacher WHERE userId = :id';

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
            $teacherData = $statement->fetchAll( \PDO::FETCH_ASSOC );

            if( count( $teacherData ) < 1)
            {
                return new Teacher();
            }

            return $this->createNewImage( $teacherData[0] );
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
}