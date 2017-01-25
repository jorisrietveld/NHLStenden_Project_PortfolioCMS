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
     * This action is for handling the home route.
     *
     * @return Response
     */
    public function index( Request $request ) : Response
    {
        return $this->createResponse(
            'site:home', [
            'portfolioMenuLinks' => $this->renderMenuLinks(),
            'asset-path'         => $request->getBaseUri() . 'assets/site/',
        ] );
    }

    /**
     * This action is for handling the contact route.
     *
     * @return Response
     */
    public function contact( Request $request ) : Response
    {
        return $this->createResponse(
            'site:contact', [
            'portfolioMenuLinks' => $this->renderMenuLinks(),
            'asset-path'         => $request->getBaseUri() . 'assets/site/',
        ] );
    }
}