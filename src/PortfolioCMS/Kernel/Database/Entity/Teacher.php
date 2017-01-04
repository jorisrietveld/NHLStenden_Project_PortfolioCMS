<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 22-12-2016 05:02
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Kernel\Database\Entity;


class Teacher extends User implements EntityInterface
{
    /**
     * @var bool
     */
    protected $isSLBer;

    /**
     * @return boolean
     */
    public function isIsSLBer(): bool
    {
        return $this->isSLBer;
    }

    /**
     * @param boolean $isSLBer
     * @return Teacher
     */
    public function setIsSLBer( bool $isSLBer ): Teacher
    {
        $this->isSLBer = $isSLBer;
        return $this;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return User
     */
    public function setId( int $id ): User
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getHashedPassword(): string
    {
        return $this->hashedPassword;
    }

    /**
     * @param string $hashedPassword
     * @return User
     */
    public function setHashedPassword( string $hashedPassword ): User
    {
        $this->hashedPassword = $hashedPassword;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getAccountCreated(): \DateTime
    {
        return $this->accountCreated;
    }

    /**
     * @param \DateTime $accountCreated
     * @return User
     */
    public function setAccountCreated( \DateTime $accountCreated ): User
    {
        $this->accountCreated = $accountCreated;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getLastLogin(): \DateTime
    {
        return $this->lastLogin;
    }

    /**
     * @param \DateTime $lastLogin
     * @return User
     */
    public function setLastLogin( \DateTime $lastLogin ): User
    {
        $this->lastLogin = $lastLogin;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return User
     */
    public function setEmail( string $email ): User
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastIpAddress(): string
    {
        return $this->lastIpAddress;
    }

    /**
     * @param string $lastIpAddress
     * @return User
     */
    public function setLastIpAddress( string $lastIpAddress ): User
    {
        $this->lastIpAddress = $lastIpAddress;
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     * @return User
     */
    public function setFirstName( string $firstName ): User
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     * @return User
     */
    public function setLastName( string $lastName ): User
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getIsActive(): bool
    {
        return $this->active;
    }

    /**
     * @param boolean $active
     * @return User
     */
    public function setActive( bool $active ): User
    {
        $this->active = $active;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getIsAdmin(): bool
    {
        return $this->isAdmin;
    }

    /**
     * @param boolean $isAdmin
     */
    public function setIsAdmin( bool $isAdmin )
    {
        $this->isAdmin = $isAdmin;
    }





}