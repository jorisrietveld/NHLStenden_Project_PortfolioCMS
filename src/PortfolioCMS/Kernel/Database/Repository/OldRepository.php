<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 31-12-2016 09:15
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Kernel\Database\Repository;


use Doctrine\Instantiator\Exception\InvalidArgumentException;
use StendenINF1B\PortfolioCMS\Kernel\Database\Entity\EntityInterface;

class Repository
{
    const AND = 'AND';
    const OR = 'OR';
    const XOR = 'XOR';

    const EQUALS = '=';
    const EQUALS_NULL_SAVE = '<=>';
    const GREATER = '>';
    const GREATER_EQUALS = '>=';
    const LESS = '<';
    const LESS_EQUALS = '<=';
    const NOT = '!';
    const NOT_EQUALS = '!=';
    const IS = 'IS';
    const IS_NOT = 'IS NOT';
    const LIKE = 'LIKE';
    const NOT_LIKE = 'NOT LIKE';

    const IS_NOT_NULL = 'IS NOT NULL';
    const IS_NULL = 'IS NULL';


    // Valid logic gates for building queries.
    const VALID_LOGIC_GATES = [
        self:: AND,
        self:: OR,
        self:: XOR,
    ];

    const VALID_OPERATORS = [
        self::EQUALS,
        self::EQUALS_NULL_SAVE,
        self::GREATER,
        self::GREATER_EQUALS,
        self::LESS,
        self::LESS_EQUALS,
        self::NOT,
        self::NOT_EQUALS,
        self::IS,
        self::IS_NOT,
        self::LIKE,
        self::NOT_LIKE,
    ];

    protected $tableName;
    protected $tableFields;
    protected $connection;

    public function __construct( string $tableName, array $tableFields, $connection )
    {
        $this->tableName = $tableName;
        $this->tableFields = $tableFields;
        $this->connection = $connection;
    }

    public function findById( int $id, array $selectValues = [] ) : EntityInterface
    {
        $query = sprintf(
            'SELECT %s FROM %s WHERE id = :id',
            $this->buildSelectFields( $selectValues ),
            $this->tableName
        );

        $statement = $this->connection->prepare( $query );

        if( $statement->execute( [ 'id' => $id ] ) )
        {

        }
    }

    public function buildSelectFields( array $selectValues = [] ) : string
    {
        $selectValues = count( $selectValues ) > 0 ? $selectValues : $this->tableFields;

        // Add commas between the select fields and remove the last one.
        return rtrim( implode( ', ', $selectValues ), ', ' );
    }

    /**
     * Generates an complex where clause from an array.
     *
     * Examples:
     * To generate the where clause "WHERE id = :id"
     * $fields = [
     *      'id', 1
     * ];
     *
     * To Generate the where clause "WHERE id = :id AND name = :name"
     * $fields = [
     * [ 'id' => 1, 'AND ],
     *      [ 'name' => 'joris' ],
     * ]
     *
     * To generate the where clause "WHERE active IS NULL
     * $fields = [
     *      'active', 'IS NULL'
     * ]
     *
     * @param array $fields
     */
    public function buildWhereClause( array $fields ) : array
    {
        if ( count( $fields ) == 0 )
        {
            // No fields so return an empty string.
            return '';
        }

        $returnValue = [
            'query' => 'WHERE ',
            'params' => [],
        ];

        if ( !is_array( $fields[ 0 ] ) )
        {
            $test = $this->buildWhereClauseTest( $fields );
            $returnValue[ 'query' ] .= $test[ 'test' ];
            $returnValue[ 'params' ] = $test[ 'param' ];
        }
        else
        {
            $fieldCount = count( $fields );
            $iterationCounter = 1;

            foreach ($fields as $key => $value)
            {
                $logicOperator = ( $fieldCount > $iterationCounter ) ? ' AND ' : '';

                $test = $this->buildWhereClauseTest( $value );

                $returnValue[ 'query' ] .= $test[ 'test' ] . $logicOperator;
                $returnValue[ 'params' ] = array_merge( $returnValue[ 'params' ], $test[ 'param' ] );
            }
        }

        return $returnValue;
    }

    protected function buildWhereClauseTest( array $whereTestBits )
    {
        if ( count( $whereTestBits ) < 2 )
        {
            throw new InvalidArgumentException( 'Not enough arguments to build an where clause test.' );
        }

        $isValidOperatorAtIndexOne = in_array( $whereTestBits[ 1 ], self::VALID_OPERATORS, true );

        if ( $isValidOperatorAtIndexOne && !isset( $whereTestBits[ 2 ] ) )
        {
            throw new InvalidArgumentException( 'The second key is an comparison operator but third key is passed as value to bind.' );
        }

        $columnName = $whereTestBits[ 0 ];

        // Make special test when testing IS NULL or IS NOT NULL
        if ( $whereTestBits[ 1 ] === self::IS_NULL || $whereTestBits === self::IS_NOT_NULL )
        {
            return [
                'test' => sprintf( '%s %s', $columnName, $whereTestBits[ 1 ] ),
                'params' => [],
            ];
        }
        else
        {
            // Check whether the first param is an operator if not an equals operator is assumed.
            $comparisonOperator = $isValidOperatorAtIndexOne ? $whereTestBits[ 1 ] : self::EQUALS;

            // Check if an user defined operator was used or an assumed one.
            $param = $whereTestBits[ 2 ] ?? $whereTestBits[ 1 ];

            return [
                'test' => sprintf( '%s %s :%s', $columnName, $comparisonOperator, $columnName ),
                'params' => [ $columnName => $param ],
            ];
        }

    }
}