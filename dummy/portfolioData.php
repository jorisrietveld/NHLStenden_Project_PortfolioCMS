<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 22-12-2016 06:00
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

abstract class user
{
    protected $id;
    protected $hashedPassword;
    protected $accountCreated;
    protected $lastLogin;
    protected $email;
    protected $lastIpAddress;
    protected $firstName;
    protected $lastName;
    protected $active;
}

class teacher extends user
{
    protected $isSLBer = false;
}

class student extends user
{
    protected $street = 'cakeIsALieStreet';
    protected $address = 42;
    protected $zipCode = '2017HL';
    protected $location = 'Roswell';
    protected $dateOfBirth;
    protected $studentCode = '31415';
    protected $phoneNumber = '063141592653';
}

class Portfolio
{

}