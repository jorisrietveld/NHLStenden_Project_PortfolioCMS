<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 10-01-2017 15:04
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Kernel\Database\Repository;


use StendenINF1B\PortfolioCMS\Kernel\Database\Entity\User;
use StendenINF1B\PortfolioCMS\Kernel\Database\Helper\EntityCollection;

trait UserHelper
{
    /**
     * Get an user by its email address.
     *
     * @param string $emailAddress
     * @return User
     */
    public function getByEmail( string $emailAddress ) : User
    {
        return $this->getOneByCondition( 'email = :whereEmail', [':whereEmail' => $emailAddress ]);
    }

    /**
     * Get all users by an last ip address.
     *
     * @param string $ipAddress
     * @return EntityCollection
     */
    public function getByLastIpAddress( string $ipAddress ) : EntityCollection
    {
        return $this->getByCondition( 'lastIpAddress = :whereLastIpAddress', [':whereLastIpAddress' => $ipAddress ]);
    }

    /**
     * Get all users that have been online since an specific date to now or some other date.
     *
     * @param \DateTime      $fromDate the start date to search.
     * @param \DateTime|null $until The end date to search.
     * @return mixed
     */
    public function getByLastOnlineFromDate( \DateTime $fromDate, \DateTime $until = NULL ) : EntityCollection
    {
        if( $until === NULL )
        {
            $until =  new \DateTime('NOW()');
        }

        $fromDate = $fromDate->format('Y-m-d H:i:s');
        $until = $until->format( 'Y-m-d H:i:s' );

        return $this->getByCondition( 'lastLogin BETWEEN :whereFromDate AND :whereUntilDate' );
    }
}