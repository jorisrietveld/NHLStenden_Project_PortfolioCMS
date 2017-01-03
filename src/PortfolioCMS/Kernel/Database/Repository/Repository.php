<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 02-01-2017 17:43
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Kernel\Database\Repository;


use StendenINF1B\PortfolioCMS\Kernel\Database\Entity\EntityInterface;
use StendenINF1B\PortfolioCMS\Kernel\Database\EntityManager;
use StendenINF1B\PortfolioCMS\Kernel\Database\Helper\EntityCollection;

abstract class Repository
{
    protected $connection;
    protected $entityManager;

    public function __construct( EntityManager $entityManager )
    {
        $this->entityManager =$entityManager;
        $this->connection = $entityManager->getConnectionManager()->getConnection()->getPdo();
    }

    abstract public function getById( int $id ) : EntityInterface;

    abstract public function getByCondition( $whereClause, $params ) : EntityCollection;

    abstract public function getOneByCondition( $whereClause, $params ) : EntityInterface;

    abstract public function insert( EntityInterface $entity );

    abstract public function update( EntityInterface $entity );

    abstract public function delete( int $id );
}