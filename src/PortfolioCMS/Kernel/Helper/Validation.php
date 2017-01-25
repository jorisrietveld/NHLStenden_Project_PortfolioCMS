<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 20-01-2017 18:29
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Kernel\Helper;

use StendenINF1B\PortfolioCMS\Kernel\Exception\ValidationException;
use StendenINF1B\PortfolioCMS\Kernel\Http\ParameterContainer as PostContainer;

class Validation
{
    /**
     * This holds an static instance of this class for singleton access.
     *
     * @var Validation
     */
    protected static $instance = NULL;

    /**
     * This holds the errors that occurred during validation.
     *
     * @var array
     */
    protected $errors = [];

    /**
     * This holds an array with error messages that can be displayed to the user.
     *
     * @var array
     */
    protected $humanReadableErrors = [];

    /**
     * Singleton access to this class.
     *
     * @return Validation
     */
    public static function getInstance() : Validation
    {
        if ( self::$instance === NULL )
        {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Validates post parameters.
     *
     * @param ParameterContainer $postFields
     * @param array              $validationRuleSet
     * @return bool
     */
    public function validatePostParameters( PostContainer $postFields, array $validationRuleSet ) : bool
    {
        $this->errors = [];
        $this->humanReadableErrors = [];

        foreach ($validationRuleSet as $validationFieldName => $validationRules)
        {
            $validationRules = explode( '|', $validationRules );

            if ( in_array( 'required', $validationRules, FALSE ) )
            {
                // Iterate through all rules.
                foreach ($validationRules as $validationRule)
                {
                    $arguments = [];

                    // If the validation rule has arguments.
                    if ( FALSE !== strpos( $validationRule, ',' ) )
                    {
                        $validationRule = explode( ',', $validationRule );
                        $arguments = array_slice( $validationRule, 1, count( $validationRule ) - 1 );
                        $validationRule = $validationRule[ 0 ];
                    }

                    // Translate the validation rule to an method name in this class.
                    $validationRuleName = 'validate' . implode( array_map( 'ucfirst', explode( '_', $validationRule ) ) );

                    if ( is_callable( [
                        $this,
                        $validationRuleName,
                    ] ) )
                    {
                        // Call the rule.
                        $this->{$validationRuleName}( $validationFieldName, $postFields->getString( $validationFieldName ), ...$arguments );
                    }
                    else
                    {
                        throw new ValidationException( sprintf( 'The rule %s is not an valid validation rule.', $validationRule ) );
                    }
                }

            }
        }
        return count( $this->errors ) === 0;
    }

    /**
     * Adds an new error to the error property.
     *
     * @param string $fieldName
     * @param string $input
     * @param string $method
     * @param array  $arguments
     */
    public function addError( string $fieldName, string $input, string $method, array $arguments = [] )
    {
        $this->errors[] = [
            'field'     => $fieldName,
            'input'     => $input,
            'method'    => $method,
            'arguments' => $arguments,
        ];
    }

    /**
     * Get the errors that occurred during validation.
     *
     * @return mixed
     */
    public function getErrors()
    {
        return $this->getErrors();
    }

    /**
     * Gets the user fiendly error messages.
     *
     * @return array
     */
    public function getReadableErrors()
    {
        foreach ($this->errors as $error)
        {
            switch ( $error[ 'method' ] )
            {
                case 'StendenINF1B\PortfolioCMS\Kernel\Helper\Validation::validateRequired':
                    $this->humanReadableErrors[] = sprintf( 'U heeft het veld %s niet ingevuld.', $error[ 'field' ] );
                    break;

                case 'StendenINF1B\PortfolioCMS\Kernel\Helper\Validation::validateMinLength':
                    $this->humanReadableErrors[] = sprintf( 'Het veld %s moet minimaal %s characters lang zijn.', $error[ 'field' ], $error[ 'arguments' ][ 'min_length' ] );
                    break;

                case 'StendenINF1B\PortfolioCMS\Kernel\Helper\Validation::validateMaxLength':
                    $this->humanReadableErrors[] = sprintf( 'Het veld %s mag maar %s characters lang zijn.', $error[ 'field' ], $error[ 'arguments' ][ 'max_length' ] );
                    break;
                default:
                    $this->humanReadableErrors[] = sprintf( 'Het veld %s is incorrect ingevuld', $error[ 'field' ] );
                    break;
            }
        }
        return implode( '<br/>', $this->humanReadableErrors );
    }

    /**
     * Checks if an input is not empty.
     *
     * @param string $fieldName
     * @param string $input
     */
    public function validateRequired( string $fieldName, string $input )
    {
        if ( strlen( $input ) === 0 )
        {
            $this->addError( $fieldName, $input, __METHOD__ );
        }
    }

    /**
     * Validates if an input only contains letters.
     *
     * @param string $fieldName
     * @param string $input
     */
    public function validateAlpha( string $fieldName, string $input )
    {
        if ( preg_match( '/^([a-z])+$/i', $input ) == 0 )
        {
            $this->addError( $fieldName, $input, __METHOD__ );
        }
    }

    /**
     * Validate if an input only contains letters or numbers.
     *
     * @param string $fieldName
     * @param string $input
     */
    public function validateAlphaNumeric( string $fieldName, string $input )
    {
        if ( preg_match( '/^([a-z0-9])+$/i', $input ) == 0 )
        {
            $this->addError( $fieldName, $input, __METHOD__ );
        }
    }

    /**
     * Validate if an input only contains letters, numbers or dashes/underscores.
     *
     * @param string $fieldName
     * @param string $input
     */
    public function validateAlphaDash( string $fieldName, string $input )
    {
        if ( preg_match( '/^([a-z0-9-_])+$/i', $input ) == 0 )
        {
            $this->addError( $fieldName, $input, __METHOD__ );
        }
    }

    /**
     * Validates if an input only contains letters, numbers or spaces.
     *
     * @param string $fieldName
     * @param string $input
     */
    public function validateAlphaSpace( string $fieldName, string $input )
    {
        if ( preg_match( '/^([a-z0-9\s])+$/i', $input ) == 0 )
        {
            $this->addError( $fieldName, $input, __METHOD__ );
        }
    }

    /**
     * Validates if an value is numeric.
     *
     * @param string $fieldName
     * @param string $input
     */
    public function validateNumeric( string $fieldName, string $input )
    {
        if ( !is_numeric( $input ) )
        {
            $this->addError( $fieldName, $input, __METHOD__ );
        }
    }

    /**
     * Validates if an input is an whole number.
     *
     * @param string $fieldName
     * @param string $input
     */
    public function validateInteger( string $fieldName, string $input )
    {
        if ( filter_var( $input, FILTER_VALIDATE_INT ) === FALSE )
        {
            $this->addError( $fieldName, $input, __METHOD__ );
        }
    }

    /**
     * Validates if an input is an floating point number.
     *
     * @param string $fieldName
     * @param string $input
     */
    public function validateFloat( string $fieldName, string $input )
    {
        if ( filter_var( $input, FILTER_VALIDATE_FLOAT ) === FALSE )
        {
            $this->addError( $fieldName, $input, __METHOD__ );
        }
    }

    /**
     * Validates if an input is an boolean.
     *
     * @param string $fieldName
     * @param string $input
     */
    public function validateBoolean( string $fieldName, string $input )
    {
        if ( (bool)$input == $input )
        {
            return;
        }

        if ( filter_var( $input, FILTER_VALIDATE_BOOLEAN ) === FALSE )
        {
            $this->addError( $fieldName, $input, __METHOD__ );
        }
    }

    /**
     * Validates if an input is under an certain length.
     *
     * @param string $fieldName
     * @param string $input
     * @param string $maxLength
     */
    public function validateMaxLength( string $fieldName, string $input, string $maxLength = '' )
    {
        if ( strlen( $maxLength ) == 0 || $maxLength == 0 )
        {
            return;
        }

        if ( strlen( $input ) > $maxLength )
        {
            $this->addError( $fieldName, $input, __METHOD__, [ 'max_length' => $maxLength ] );
        }
    }

    /**
     * Validates if an input has an certain length.
     *
     * @param string $fieldName
     * @param string $input
     * @param string $minLength
     */
    public function validateMinLength( string $fieldName, string $input, string $minLength = '' )
    {
        if ( strlen( $minLength ) == 0 || $minLength == 0 )
        {
            return;
        }

        if ( strlen( $input ) < $minLength )
        {
            $this->addError( $fieldName, $input, __METHOD__, [ 'min_length' => $minLength ] );
        }
    }

    /**
     * Validate if an input is smaller than an minimum value.
     *
     * @param string $fieldName
     * @param string $input
     * @param string $minValue
     */
    public function validateMinNumeric( string $fieldName, string $input, string $minValue = '' )
    {
        if ( $input < $minValue )
        {
            $this->addError( $fieldName, $input, __METHOD__, [ 'min' => $minValue ] );
        }

    }

    /**
     * Validates if an input is larger than an maximum value.
     *
     * @param string $fieldName
     * @param string $input
     * @param string $maxValue
     */
    public function validateMaxNumeric( string $fieldName, string $input, string $maxValue = '' )
    {
        if ( $input > $maxValue )
        {
            $this->addError( $fieldName, $input, __METHOD__, [ 'max' => $maxValue ] );
        }
    }

    /**
     * Validates if an input is an valid IPv4 or IPv6 address.
     *
     * @param string $fieldName
     * @param string $input
     */
    public function validateIp( string $fieldName, string $input )
    {
        if ( filter_var( $input, FILTER_VALIDATE_IP ) === FALSE )
        {
            $this->addError( $fieldName, $input, __METHOD__ );
        }
    }

    /**
     * Validates if an input is an valid IPv4 address.
     *
     * @param string $fieldName
     * @param string $input
     */
    public function validateIpv4( string $fieldName, string $input )
    {
        if ( filter_var( $input, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 ) === FALSE )
        {
            $this->addError( $fieldName, $input, __METHOD__ );
        }
    }

    /**
     * Validates if an input is an valid IPv6 address.
     *
     * @param string $fieldName
     * @param string $input
     */
    public function validateIpv6( string $fieldName, string $input )
    {
        if ( filter_var( $input, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6 ) === FALSE )
        {
            $this->addError( $fieldName, $input, __METHOD__ );
        }
    }

    /**
     * Validates if an input contains an certain item.
     *
     * @param string $fieldName
     * @param string $input
     * @param string $item
     */
    public function validateContains( string $fieldName, string $input, string $item )
    {
        if ( strpos( $input, $item ) !== FALSE )
        {
            $this->addError( $fieldName, $input, __METHOD__, [ 'contains' => $item ] );
        }
    }

    /**
     * Validates if an input does not contain an certain item.
     *
     * @param string $fieldName
     * @param string $input
     * @param string $item
     */
    public function validateDoesNotContain( string $fieldName, string $input, string $item )
    {
        if ( strpos( $input, $item ) )
        {
            $this->addError( $fieldName, $input, __METHOD__, [ 'contains' => $item ] );
        }
    }

    /**
     * Validates if an input contains an valid phone number.
     *
     * @param string $fieldName
     * @param string $input
     */
    public function validatePhoneNumber( string $fieldName, string $input )
    {
        if ( !preg_match( '/^(\d[\s-]?)?[\(\[\s-]{0,2}?\d{3}[\)\]\s-]{0,2}?\d{3}[\s-]?\d{4}$/i', $input ) )
        {
            $this->addError( $fieldName, $input, __METHOD__ );
        }
    }

    /**
     * Validates if an input is an valid email address.
     *
     * @param string $fieldName
     * @param string $input
     */
    public function validateEmail( string $fieldName, string $input )
    {
        if ( !filter_var( $input, FILTER_VALIDATE_EMAIL ) )
        {
            $this->addError( $fieldName, $input, __METHOD__ );
        }
    }

    /**
     * Validates if an input is an valid dutch zip code.
     *
     * @param string $fieldName
     * @param string $input
     */
    public function validateZipCode( string $fieldName, string $input )
    {
        if ( !preg_match( '/^\A[1-9]\d{3}\s?[a-zA-Z]{2}\Z$/i', $input ) )
        {
            $this->addError( $fieldName, $input, __METHOD__ );
        }
    }

    /**
     * Validates if an password includes certain required characters.
     *
     * @param string $fieldName
     * @param string $input
     * @param        $requiredCharacters
     */
    public function validatePassword( string $fieldName, string $input, $requiredCharacters )
    {
        if ( !preg_match( "/^([{$requiredCharacters}]+)$/i", $input ) )
        {
            $this->addError( $fieldName, $input, __METHOD__, [ 'requiredCharacters' => $requiredCharacters ] );
        }
    }

    /**
     * Validates if an input is an valid date.
     *
     * @param string $fieldName
     * @param string $input
     */
    public function validateDate( string $fieldName, string $input, $format = 'Y-m-d' )
    {
        $date = \DateTime::createFromFormat( $format, $input );
        if ( !$date || $date->format( $format ) !== $input )
        {
            $this->addError( $fieldName, $input, __METHOD__, [ 'format' => $format ] );
        }
    }

    /**
     * Validates if an input is an valid time.
     *
     * @param string $fieldName
     * @param string $input
     * @param string $format
     */
    public function validateTime( string $fieldName, string $input, $format = 'H:i' )
    {
        $date = \DateTime::createFromFormat( $format, $input );

        if ( !$date || $date->format( $format ) !== $input )
        {
            $this->addError( $fieldName, $input, __METHOD__, [ 'format' => $format ] );
        }
    }

    /**
     * Validates if an input is an valid datetime.
     *
     * @param string $fieldName
     * @param string $input
     * @param string $format
     */
    public function validateDateTime( string $fieldName, string $input, $format = 'Y-m-d H:i' )
    {
        $date = \DateTime::createFromFormat( $format, $input );

        if ( !$date || $date->format( $format ) !== $input )
        {
            $this->addError( $fieldName, $input, __METHOD__, [ 'format' => $format ] );
        }
    }

    /**
     * Filters an string so it is xxs save.
     *
     * @param string $fieldName
     * @param string $input
     */
    public function filterXXS( string $fieldName, string $input )
    {
        return filter_var( $input, FILTER_SANITIZE_STRING );
    }

    public function validateEnum( $fieldName, string $input )
    {
        $args = func_get_args();
        unset( $args[ 0 ], $args[ 1 ] );

        if ( !in_array( $input, $args ) )
        {
            $this->addError( $fieldName, $input, __METHOD__, [ 'args' => $args ] );
        }
    }
}