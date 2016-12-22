<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 10-12-2016 04:24
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace Tests\PortfolioCMS\Kernel\Http;

use StendenINF1B\PortfolioCMS\Kernel\Helper\ParameterContainer;

class ParameterContainerTest extends \PHPUnit_Framework_TestCase
{
    public $testData = [ 'foo' => 'bar' ];

    public function testConstructor()
    {
        $this->testAll();
    }

    public function testAll()
    {
        $container = new ParameterContainer( $this->testData );

        $this->assertEquals( $this->testData, $container->all(), '->all( ) gets all get input' );
    }

    public function testKeys()
    {
        $container = new ParameterContainer( [ 'foo' => 'bar' ] );

        $this->assertEquals( [ 'foo' ], $container->keys() );
    }

    public function testAdd()
    {
        $container = new ParameterContainer( $this->testData );
        $container->add( [ 'bar' => 'bas' ] );

        $this->assertEquals( [
            'foo' => 'bar',
            'bar' => 'bas'
        ], $container->all() );
    }

    public function testRemove()
    {
        $container = new ParameterContainer( $this->testData );
        $container->add( [ 'bar' => 'bas' ] );

        $this->assertEquals( [
            'foo' => 'bar',
            'bar' => 'bas'
        ], $container->all() );
        $container->remove( 'bar' );

        $this->assertEquals( [ 'foo' => 'bar' ], $container->all() );
    }

    public function testReplace()
    {
        $container = new ParameterContainer( $this->testData );
        $container->replace( [ 'FOO' => 'BAR' ] );

        $this->assertEquals( [ 'FOO' => 'BAR' ], $container->all(), '->replace() replaces the input with the argument' );

        $this->assertFalse( $container->has( 'foo' ), '->replace() overrides previously set the input' );
    }

    public function testGet()
    {
        $container = new ParameterContainer( [ 'foo' => 'bar' ] );

        $this->assertEquals( 'bar', $container->get( 'foo' ), '->get() gets the value of a parameter' );

        $this->assertEquals( 'default', $container->get( 'unknown', 'default' ), '->get() returns second argument as default if a parameter is not defined' );

        $this->assertNull( $container->get( 'null', null ), '->get() returns null if null is set' );
    }

    public function testGetDoesNotUseDeepByDefault()
    {
        $container = new ParameterContainer( [ 'foo' => [ 'bar' => 'moo' ] ] );
        $this->assertNull( $container->get( 'foo[bar]' ) );
    }

    public function testSet()
    {
        $container = new ParameterContainer();
        $container->set( 'foo', 'bar' );

        $this->assertEquals( 'bar', $container->get( 'foo' ), '->set() sets the value of parameter' );

        $container->set( 'foo', 'baz' );
        $this->assertEquals( 'baz', $container->get( 'foo' ), '->set() overrides previously set parameter' );
    }

    public function testHas()
    {
        $container = new ParameterContainer( $this->testData );

        $this->assertTrue( $container->has( 'foo' ), '->has() returns true if a parameter is defined' );

        $this->assertFalse( $container->has( 'unknown' ), '->has() return false if a parameter is not defined' );
    }

    public function testGetInt()
    {
        $container = new ParameterContainer( [ 'digits' => '0123' ] );

        $this->assertEquals( 123, $container->getInt( 'digits' ), '->getInt() gets a value of parameter as integer' );

        $this->assertEquals( 0, $container->getInt( 'unknown' ), '->getInt() returns zero if a parameter is not defined' );
    }

    public function testFilter()
    {
        $container = new ParameterContainer( [
            'digits' => '0123ab',
            'email' => 'example@example.com',
            'url' => 'http://example.com/foo',
            'dec' => '256',
            'hex' => '0x100',
            'array' => [ 'bang' ],
        ] );

        // Test filter when the key doesn't exist
        $this->assertEmpty(
            $container->filter( 'nokey' ),
            '->filter() should return empty by default if no key is found'
        );

        // Test filter only numbers.
        $this->assertEquals( '0123',
            $container->filter(
                'digits',
                '',
                FILTER_SANITIZE_NUMBER_INT
            ),
            '->filter() gets a value of parameter as integer filtering out invalid characters'
        );

        // Test filter valid email
        $this->assertEquals( 'example@example.com',
            $container->filter(
                'email',
                '',
                FILTER_VALIDATE_EMAIL
            ),
            '->filter() gets a value of parameter as email'
        );

        // Test filter valid url with path required using an array as argument.
        $this->assertEquals( 'http://example.com/foo',
            $container->filter(
                'url',
                '',
                FILTER_VALIDATE_URL, [
                    'flags' => FILTER_FLAG_PATH_REQUIRED
                ]
            ), '->filter() gets a value of parameter as URL with a path'
        );

        // Test filter valid url with path required using an constant as argument
        $this->assertEquals( 'http://example.com/foo',
            $container->filter(
                'url',
                '',
                FILTER_VALIDATE_URL,
                FILTER_FLAG_PATH_REQUIRED
            ),
            '->filter() gets a value of parameter as URL with a path'
        );

        // Test filter validate integer in range.
        $this->assertFalse(
            $container->filter( 'dec', '', FILTER_VALIDATE_INT, [
                'flags' => FILTER_FLAG_ALLOW_HEX,
                'options' => [
                    'min_range' => 1,
                    'max_range' => 0xff,
                ],
            ] ),
            '->filter() gets a value of parameter as integer between boundaries'
        );

        // Test filter validate hex in range
        $this->assertFalse(
            $container->filter( 'hex', '', FILTER_VALIDATE_INT, [
                'flags' => FILTER_FLAG_ALLOW_HEX,
                'options' => [
                    'min_range' => 1,
                    'max_range' => 0xff,
                ],
            ] ),
            '->filter() gets a value of parameter as integer between boundaries'
        );

        // Test filter array.
        $this->assertEquals( [ 'bang' ],
            $container->filter(
                'array',
                ''
            ),
            '->filter() gets a value of parameter as an array'
        );
    }

    public function testGetIterator()
    {
        $parameters = [
            'foo' => 'bar',
            'hello' => 'world'
        ];

        $container = new ParameterContainer( $parameters );

        $i = 0;
        foreach ($container as $key => $val)
        {
            ++$i;
            $this->assertEquals( $parameters[ $key ], $val );
        }
        // Check if it iterated properly.
        $this->assertEquals( count( $parameters ), $i );
    }

    public function testCount()
    {
        $parameters = [
            'foo' => 'bar',
            'hello' => 'world'
        ];

        $container = new ParameterContainer( $parameters );

        $this->assertEquals( count( $parameters ), count( $container ) );
    }

    public function testGetBoolean()
    {
        $parameters = [
            'string_true' => 'true',
            'string_false' => 'false',
        ];

        $container = new ParameterContainer( $parameters );

        $this->assertTrue( $container->getBoolean( 'string_true' ), '->getBoolean() gets the string true as boolean true' );

        $this->assertFalse( $container->getBoolean( 'string_false' ), '->getBoolean() gets the string false as boolean false' );

        $this->assertFalse( $container->getBoolean( 'unknown' ), '->getBoolean() returns false if a parameter is not defined' );
    }

    public function testArrayAccess()
    {
        $container = new ParameterContainer( [ 'foo' => 'bar' ] );

        // Test array access on the parameter container.
        $this->assertEquals( 'bar',
            $container[ 'foo' ],
            '[ key ] returns $parameterContainer->parameters[ key ] ' );

        $container[ 'bob' ] = 'value';

        $this->assertEquals( 'value',
            $container[ 'bob' ],
            '[ bob ] returns $parameterContainer->parameters[ value ] '
        );

        $container[] = 'someValue';

        $this->assertEquals( 'someValue',
            $container[ 0 ],
            '[ 0 ] returns $parameterContainer->parameters[ someValue ] '
        );

        unset( $container[ 0 ] );

        $this->assertEmpty( $container[ 0 ], '[0] is unset from the container' );
    }
}