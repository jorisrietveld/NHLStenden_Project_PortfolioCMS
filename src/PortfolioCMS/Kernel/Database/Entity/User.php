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
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $hashedPassword;

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
}