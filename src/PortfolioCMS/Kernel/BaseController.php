<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 09-12-2016 15:17
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Kernel;


abstract class BaseController
{
    public function getTemplate(  )
    {
        
    }

    public function renderWebPage( string $name, array $context = [] ) : string
    {
        return 'todo implement renderer';
    }

    abstract public function index();
}