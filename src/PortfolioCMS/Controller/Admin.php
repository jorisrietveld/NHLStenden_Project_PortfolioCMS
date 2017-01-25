<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 22-12-2016 13:56
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Controller;

use StendenINF1B\PortfolioCMS\Kernel\BaseController;
use StendenINF1B\PortfolioCMS\Kernel\Http\Request;

class Admin extends BaseController
{

    public function index( Request $request )
    {
        return $this->createResponse( 'admin:overzicht', [
            'asset-path' => $request->getBaseUri() . 'assets/admin/',
        ] );
    }

    public function add_user( Request $request )
    {
        return $this->createResponse( 'admin:add_user', [
            'asset-path' => $request->getBaseUri() . 'assets/admin/',
        ] );
    }

    public function edit_user( Request $request )
    {
        return $this->createResponse( 'admin:edit_user', [
            'asset-path' => $request->getBaseUri() . 'assets/admin/',
        ] );
    }

    public function portfolio( Request $request )
    {
        return $this->createResponse( 'admin:portfolio', [
            'asset-path' => $request->getBaseUri() . 'assets/admin/',
        ] );
    }

    public function thema( Request $request )
    {
        return $this->createResponse( 'admin:thema', [
            'asset-path' => $request->getBaseUri() . 'assets/admin/',
        ] );

    }

    public function cijferregistratie( Request $request )
    {
        return $this->createResponse( 'admin:cijferregistratie', [
            'asset-path' => $request->getBaseUri() . 'assets/admin/',
        ] );

    }
}