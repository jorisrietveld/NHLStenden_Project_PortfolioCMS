<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 22-12-2016 05:02
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Kernel\Database\Entity;


class Student extends User
{
    protected $street;
    protected $address;
    protected $zipCode;
    protected $location;
    protected $dateOfBirth;
    protected $studentCode;
    protected $phoneNumber;
}