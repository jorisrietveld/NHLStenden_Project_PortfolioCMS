<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 22-12-2016 17:22
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Kernel\Database;


interface EntityMangerInterface
{
    public function find( $entityName, $withAttributes = [], $limit = NULL );

    public function findOne( $entityName, $withAttributes = [] );

    public function getRepository();


}