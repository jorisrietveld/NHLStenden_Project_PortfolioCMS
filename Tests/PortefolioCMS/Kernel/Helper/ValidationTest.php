<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 21-01-2017 16:43
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace Tests\PortefolioCMS\Kernel\Helper;

use StendenINF1B\PortfolioCMS\Kernel\Helper\Validation;
use StendenINF1B\PortfolioCMS\Kernel\Http\ParameterContainer;

class ValidationTest extends \PHPUnit_Framework_TestCase
{
    public function testValidation()
    {
        $postParams = new ParameterContainer( [
            'email'    => 'test@test.com',
            'username' => 'jorisrietveld',
            'tel'      => '0615118905',
            'password' => 'joris',
            'zipCode' => '1345 BV',
        ] );

        $rules = [
            'email' => 'required|email',
            'username' => 'required|alpha_numeric|min_length,0|max_length,50',
            'tel' => 'required|phone_number',
            'password' => 'required',
            'zipCode' => 'zip_code',
        ];

        $this->assertTrue( Validation::getInstance()->validatePostParameters( $postParams, $rules ) );
    }

    public function testFailedValidation()
    {
        $postParams = new ParameterContainer( [
            'email'    => 'test@test.com',
            'username' => 'jorisrietveld',
            'tel'      => '0615118905',
            'password' => '',
            'zipCode' => '1345 BV',
        ] );

        $rules = [
            'email' => 'required|email',
            'username' => 'required|alpha_numeric|min_length,0|max_length,50',
            'tel' => 'required|phone_number',
            'password' => 'required',
            'zipCode' => 'zip_code',
        ];

        $this->assertFalse( Validation::getInstance()->validatePostParameters( $postParams, $rules ) );
    }

    public function testRequiredValidation()
    {
        $postParams = new ParameterContainer( [
            'email'    => 'test@test.com',
            'username' => 'jorisrietveld',
            'tel'      => '0615118905',
            'password' => 'joris',
            'zipCode' => '1234MN',
        ] );

        $rules = [
            'email' => 'required|email',
            'username' => 'required|alpha_numeric|min_length,0|max_length,50',
            'tel' => 'required|phone_number',
            'password' => 'required',
            'zipCode' => 'zipcode',
        ];

        $this->assertTrue( Validation::getInstance()->validatePostParameters( $postParams, $rules ) );
    }
}