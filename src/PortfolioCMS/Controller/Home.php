<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 09-12-2016 14:36
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Controller;

use StendenINF1B\PortfolioCMS\Kernel\BaseController;
use StendenINF1B\PortfolioCMS\Kernel\Http\Request;
use StendenINF1B\PortfolioCMS\Kernel\Http\Response;

class Home extends BaseController
{
    public function index( Request $request = NULL )
    {
        ob_start();
        dump( $request );
        $dumpData = ob_get_clean();

        return new Response(
            '<html>
                <head>
                    <title>Welcom op PortfolioCMS</title>
                </head>
                <body>
                    <h1>Welkom op PortfolioCMS</h1>
                    '.
                    $dumpData .
                    '
                </body>
            </html>',
            Response::HTTP_STATUS_OK
        );
    }
}