<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 22-12-2016 05:02
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Kernel\Database\Entity;


abstract class User
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