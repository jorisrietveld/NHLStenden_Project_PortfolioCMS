<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 16-09-2016 15:11
 */
declare(strict_types = 1);

namespace StendenINF1B\PortfolioCMS\Kernel\Exception;


class FileNotFoundException extends \Exception
{
    public function __construct($message = '', $code = 0, \Exception $previous = NULL)
    {
        parent::__construct($message, $code, $previous);
    }
}