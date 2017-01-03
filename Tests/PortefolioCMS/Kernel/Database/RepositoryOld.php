<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 31-12-2016 10:03
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace Tests\PortefolioCMS\Kernel\Database;


use StendenINF1B\PortfolioCMS\Kernel\Database\Repository\Repository;

class RepositoryTest extends \PHPUnit_Framework_TestCase
{
    public function testSelectValues()
    {
        $repository = new Repository( 'foobar', [
            'id',
            'name',
            'age'
        ] );

        // Test select *
        $this->assertEquals(
            'id, name, age',
            $repository->generateQuerySelectFields()
        );

        // Test select id, foo, bar
        $this->assertEquals(
            'id, foo, bar',
            $repository->generateQuerySelectFields( [
                'id',
                'foo',
                'bar'
            ] )
        );

    }

    public function testGenerateWhereEqualsClause()
    {
        $repository = new Repository( 'foobar', [
            'id',
            'name',
            'age'
        ] );

        $whereArray = [
            'query' => 'WHERE id=:id AND name=:name',
            'params' => [
                ':id' => 1,
                ':name' => 'bob marley'
            ]
        ];
        // Test generate an where clause with 2 parameters
        $this->assertEquals(
            $whereArray,
            $repository->generateWhereClause( [
                'id' => 1,
                'name' => 'bob marley'
            ] )
        );

        $whereArray = [
            'query' => 'WHERE id=:id',
            'params' => [
                ':id' => 1
            ]
        ];

        // Test generate an where clause with 1 parameter
        $this->assertEquals(
            $whereArray,
            $repository->generateWhereClause( [
                'id' => 1,
            ] )
        );


    }
}