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
    use SiteHelper;

    /**
     * This action if for handling the home route.
     *
     * @param Request|null $request
     * @return Response
     */
    public function index( Request $request = null )
    {
        return new Response(
            $this->renderWebPage( 'site:home', [
                'portfolioMenuLinks' => $this->renderMenuLinks(),
            ] ),
            Response::HTTP_STATUS_OK
        );
    }
}