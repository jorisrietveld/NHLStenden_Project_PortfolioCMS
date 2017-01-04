<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 03-01-2017 12:20
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Kernel\Database\Repository;

use StendenINF1B\PortfolioCMS\Kernel\Database\Entity\EntityInterface;
use StendenINF1B\PortfolioCMS\Kernel\Database\Entity\GuestBookMessage;
use StendenINF1B\PortfolioCMS\Kernel\Database\EntityManager;
use StendenINF1B\PortfolioCMS\Kernel\Exception\RepositoryException;

class GuestBookMessageRepository extends Repository
{
    protected $getByIdSql = '
        SELECT
            `GuestBookMessage`.`id`,
            `GuestBookMessage`.`sender`,
            `GuestBookMessage`.`title`,
            `GuestBookMessage`.`message`,
            `GuestBookMessage`.`sendAt`,
            `GuestBookMessage`.`studentId`,
            `GuestBookMessage`.`accsepted`
        FROM `DigitalPortfolio`.`GuestBookMessage`
        WHERE `GuestBookMessage`.`id` = :id;
    ';

    protected $getBySql = '
        SELECT
            `GuestBookMessage`.`id`,
            `GuestBookMessage`.`sender`,
            `GuestBookMessage`.`title`,
            `GuestBookMessage`.`message`,
            `GuestBookMessage`.`sendAt`,
            `GuestBookMessage`.`studentId`,
            `GuestBookMessage`.`accsepted`
        FROM `DigitalPortfolio`.`GuestBookMessage`
    ';

    protected $insertGuestBookMessageSql = '
          INSERT INTO `DigitalPortfolio`.`GuestBookMessage`( 
                `sender`,
                `title`,
                `message`,
                `sendAt`,
                `studentId`,
                `accsepted`
            ) VALUES ( 
                :sender,
                :title,
                :message,
                :sendAt,
                :studentId,
                :accsepted
            );
    ';

    protected $updateGuestBookMessageSql = '
        UPDATE GuestBookMessage SET 
            `sender` = :sender,
            `title` = :title,
            `message` = :message,
            `sendAt` = :sendAt,
            `studentId` = :studentId,
            `accsepted` = :accsepted
        WHERE `GuestBookMessage`.`id` = :id;
    ';

    protected $deleteSql = '
        DELETE FROM GuestBookMessage WHERE `GuestBookMessage`.`id` = :id;
    ';

    public function __construct( EntityManager $entityManager )
    {
        parent::__construct( $entityManager );
    }

    /**
     * Inserts an new GuestBookMessage and user in the database.
     *
     * @param GuestBookMessage $guestBookMessage
     * @throws RepositoryException
     */
    public function insert( GuestBookMessage $guestBookMessage ) : GuestBookMessage
    {
        try
        {
            $statement = $this->connection->prepare( $this->insertGuestBookMessageSql );

            $statement->execute( [
                ':sender' => $guestBookMessage->getSender(),
                ':title' => $guestBookMessage->getTitle(),
                ':message' => $guestBookMessage->getMessage(),
                ':sendAt' => $guestBookMessage->getSendAt()->format( 'Y-m-d H:i:s' ),
                ':studentId' => (int)$guestBookMessage->getStudentId(),
                ':accsepted' => (int)$guestBookMessage->getIsAccepted(),
            ] );

            $id = (int)$this->connection->lastInsertId();

            return $this->getById( $id );

        } catch ( \PDOException $exception )
        {
            $this->connection->rollBack();
            throw new RepositoryException( 'The guestbook message could not be inserted: ' . $exception->getMessage() );
        }
    }

    /**
     * Updates an guest book message and user in the database.
     *
     * @param GuestBookMessage $teacher
     * @throws RepositoryException
     */
    public function update( GuestBookMessage $guestBookMessage ) : GuestBookMessage
    {
        try
        {
            $statement = $this->connection->prepare( $this->updateGuestBookMessageSql );

            $statement->execute( [
                ':sender' => $guestBookMessage->getSender(),
                ':title' => $guestBookMessage->getTitle(),
                ':message' => $guestBookMessage->getMessage(),
                ':sendAt' => $guestBookMessage->getSendAt()->format( 'Y-m-d H:i:s' ),
                ':studentId' => (int)$guestBookMessage->getStudentId(),
                ':accsepted' => (int)$guestBookMessage->getIsAccepted(),
            ] );

            return $this->getById( $guestBookMessage->getId() );

        } catch ( \PDOException $exception )
        {
            $this->connection->rollBack();
            throw new RepositoryException( 'The guestbook message could not be updated: ' . $exception->getMessage() );
        }
    }

    /**
     * @param array $databaseData
     * @return EntityInterface
     */
    public function createEntity( array $databaseData ) : EntityInterface
    {
        $guestBookMessage = new GuestBookMessage();
        $guestBookMessage->setId( (int)$databaseData[ 'id' ] );
        $guestBookMessage->setSender( $databaseData[ 'sender' ] );
        $guestBookMessage->setTitle( $databaseData[ 'title' ] );
        $guestBookMessage->setMessage( $databaseData[ 'message' ] );
        $guestBookMessage->setSendAt( new \DateTime( $databaseData[ 'sendAt' ] ) );
        $guestBookMessage->setStudentId( (int)$databaseData[ 'studentId' ] );
        $guestBookMessage->setIsAccepted( (bool)$databaseData[ 'accsepted' ] );

        return $guestBookMessage;
    }

    /**
     * @return EntityInterface
     */
    public function createEmptyEntity() : EntityInterface
    {
        return new GuestBookMessage();
    }
}