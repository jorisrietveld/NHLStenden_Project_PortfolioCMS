<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 22-12-2016 06:00
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

abstract class User
{
    protected $id = 1;
    protected $hashedPassword = 'password';
    protected $accountCreated;
    protected $lastLogin;
    protected $email;
    protected $lastIpAddress;
    protected $firstName;
    protected $lastName;
    protected $active;

    public function __construct(  )
    {
        $this->accountCreated = new DateTime();
        $this->lastLogin = new DateTime();
    }
}

class Teacher extends User
{
    protected $isSLBer = false;
}

class Student extends User
{
    protected $street = 'cakeIsALieStreet';
    protected $address = 42;
    protected $zipCode = '2017HL';
    protected $location = 'Roswell';
    protected $dateOfBirth;
    protected $studentCode = '31415';
    protected $phoneNumber = '063141592653';

    public function __construct(  )
    {
        $this->dateOfBirth = new DateTime('30-06-1995');
        parent::__construct();
    }
}

class Portfolio
{

}