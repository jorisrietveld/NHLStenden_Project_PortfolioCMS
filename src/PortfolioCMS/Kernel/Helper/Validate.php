<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 17-01-2017 17:26
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Kernel\Helper;

class Validate
{
    const PASSWORD_LENGTH_MIN = 8;
    const PASSWORD_LENGTH_MAX = -1;

    const STRING_LENGTH_MIN = -1;
    const STRING_LENGTH_MAX = -1;

    /**
     * Checks an password on certain conditions based on the options passed.
     *
     * @param string $password
     * @param        $passwordRepeat
     * @param array  $options
     * @return bool
     */
    public static function password( string $password, $passwordRepeat, $options = [] ) : bool
    {
        $check = [
            'length' => [
            'min' => $options['length']['min'] ?? self::PASSWORD_LENGTH_MIN,
            'max' => $options['length']['max'] ?? self::PASSWORD_LENGTH_MAX,
            ],
        ];
        return ( $password !== $passwordRepeat ) || ( self::string( $password, $check ));
    }

    /**
     * Checks if it is an valid email address.
     *
     * @param string $email
     * @return bool
     */
    public static function email( string $email ) : bool
    {
        return (bool)filter_var( $email, FILTER_VALIDATE_EMAIL );
    }

    /**
     * Checks an string on certain conditions based on the options passed.
     *
     * @param string $string
     * @param array  $options
     * @return bool
     */
    public static function string( string $string = '', $options = [] ) : bool
    {
        $strLen = strlen( $string );
        $strLenMin = $options['length']['min'] ?? self::STRING_LENGTH_MIN;
        $strLanMax = $options['length']['max'] ?? self::STRING_LENGTH_MAX;
        return ( $strLenMin <= $strLen && $strLenMin !== -1 ) OR ( $strLanMax >= $strLen && $strLanMax !== -1 );
    }
}