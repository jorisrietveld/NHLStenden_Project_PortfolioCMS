<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 09-01-2017 17:22
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Kernel\Database\Entity;

/**
 * Class DisplayStudent.
 * This is an helper entity to protect private information about an student for displaying it on an portfolio.
 *
 * @package StendenINF1B\PortfolioCMS\Kernel\Database\Entity
 */
class DisplayStudent
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $address;

    /**
     * @var string
     */
    protected $zipCode;

    /**
     * @var string
     */
    protected $location;

    /**
     * @var \DateTime
     */
    protected $dateOfBirth;

    /**
     * @var string
     */
    protected $studentCode;

    /**
     * @var string
     */
    protected $phoneNumber;

    /**
     * @var \DateTime
     */
    protected $accountCreated;

    /**
     * @var \DateTime
     */
    protected $lastLogin;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $lastIpAddress;

    /**
     * @var string
     */
    protected $firstName;

    /**
     * @var string
     */
    protected $lastName;

    /**
     * @var bool
     */
    protected $active;

    /**
     * @var bool
     */
    protected $isAdmin;

    public function __construct( Student $student )
    {
        $this->setId( $student->getId() )
            ->setAddress( $student->getAddress() )
            ->setZipCode( $student->getZipCode() )
            ->setLocation( $student->getLocation() )
            ->setDateOfBirth( $student->getDateOfBirth() )
            ->setStudentCode( $student->getStudentCode() )
            ->setPhoneNumber( $student->getPhoneNumber() )
            ->setAccountCreated( $student->getAccountCreated() )
            ->setLastIpAddress( $student->getLastIpAddress() )
            ->setLastLogin( $student->getLastLogin() )
            ->setFirstName( $student->getFirstName() )
            ->setLastName( $student->getLastName() )
            ->setActive( $student->getIsActive() )
            ->setIsAdmin( $student->getIsAdmin() )
            ->setEmail( $student->getEmail() );
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
     * @return DisplayStudent
     */
    public function setId( int $id ): DisplayStudent
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     * @return DisplayStudent
     */
    public function setAddress( string $address ): DisplayStudent
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return string
     */
    public function getZipCode(): string
    {
        return $this->zipCode;
    }

    /**
     * @param string $zipCode
     * @return DisplayStudent
     */
    public function setZipCode( string $zipCode ): DisplayStudent
    {
        $this->zipCode = $zipCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getLocation(): string
    {
        return $this->location;
    }

    /**
     * @param string $location
     * @return DisplayStudent
     */
    public function setLocation( string $location ): DisplayStudent
    {
        $this->location = $location;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDateOfBirth(): \DateTime
    {
        return $this->dateOfBirth;
    }

    /**
     * @param \DateTime $dateOfBirth
     * @return DisplayStudent
     */
    public function setDateOfBirth( \DateTime $dateOfBirth ): DisplayStudent
    {
        $this->dateOfBirth = $dateOfBirth;
        return $this;
    }

    /**
     * @return string
     */
    public function getStudentCode(): string
    {
        return $this->studentCode;
    }

    /**
     * @param string $studentCode
     * @return DisplayStudent
     */
    public function setStudentCode( string $studentCode ): DisplayStudent
    {
        $this->studentCode = $studentCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    /**
     * @param string $phoneNumber
     * @return DisplayStudent
     */
    public function setPhoneNumber( string $phoneNumber ): DisplayStudent
    {
        $this->phoneNumber = $phoneNumber;
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
     * @return DisplayStudent
     */
    public function setAccountCreated( \DateTime $accountCreated ): DisplayStudent
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
     * @return DisplayStudent
     */
    public function setLastLogin( \DateTime $lastLogin ): DisplayStudent
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
     * @return DisplayStudent
     */
    public function setEmail( string $email ): DisplayStudent
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
     * @return DisplayStudent
     */
    public function setLastIpAddress( string $lastIpAddress ): DisplayStudent
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
     * @return DisplayStudent
     */
    public function setFirstName( string $firstName ): DisplayStudent
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
     * @return DisplayStudent
     */
    public function setLastName( string $lastName ): DisplayStudent
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getActive(): bool
    {
        return $this->active;
    }

    /**
     * @param boolean $active
     * @return DisplayStudent
     */
    public function setActive( bool $active ): DisplayStudent
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
     * @return DisplayStudent
     */
    public function setIsAdmin( bool $isAdmin ): DisplayStudent
    {
        $this->isAdmin = $isAdmin;
        return $this;
    }

}