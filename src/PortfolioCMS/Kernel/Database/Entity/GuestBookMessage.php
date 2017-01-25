<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 22-12-2016 05:07
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Kernel\Database\Entity;

class GuestBookMessage implements EntityInterface
{
    /**
     * @var int
     */
    protected $id = 0;

    /**
     * @var string
     */
    protected $sender;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $message;

    /**
     * @var bool
     */
    protected $isAccepted;

    /**
     * @var int
     */
    protected $studentId;

    /**
     * @var \DateTime
     */
    protected $sendAt;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return GuestBookMessage
     */
    public function setId( int $id ): GuestBookMessage
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getSender(): string
    {
        return $this->sender;
    }

    /**
     * @param string $sender
     * @return GuestBookMessage
     */
    public function setSender( string $sender ): GuestBookMessage
    {
        $this->sender = $sender;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return GuestBookMessage
     */
    public function setTitle( string $title ): GuestBookMessage
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     * @return GuestBookMessage
     */
    public function setMessage( string $message ): GuestBookMessage
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getIsAccepted(): bool
    {
        return $this->isAccepted;
    }

    /**
     * @param boolean $isAccepted
     * @return GuestBookMessage
     */
    public function setIsAccepted( bool $isAccepted ): GuestBookMessage
    {
        $this->isAccepted = $isAccepted;
        return $this;
    }

    /**
     * @return User
     */
    public function getStudentId(): int
    {
        return $this->studentId;
    }

    /**
     * @param User $user
     * @return GuestBookMessage
     */
    public function setStudentId( int $studentId ): GuestBookMessage
    {
        $this->studentId = $studentId;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getSendAt(): \DateTime
    {
        return $this->sendAt;
    }

    /**
     * @param \DateTime $sendAt
     */
    public function setSendAt( \DateTime $sendAt )
    {
        $this->sendAt = $sendAt;
    }

}