<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 22-12-2016 13:56
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Controller;


use StendenINF1B\PortfolioCMS\Kernel\BaseController;
use StendenINF1B\PortfolioCMS\Kernel\Database\Entity\Student;
use StendenINF1B\PortfolioCMS\Kernel\Http\Request;
use StendenINF1B\PortfolioCMS\Kernel\Http\Response;

class Admin extends BaseController
{
    public function index( Request $request )
    {
        return new Response(
            $this->renderWebPage( 'admin:overzicht', [
                'request-uri' => $request->getBaseUri(),
            ] ),
            Response::HTTP_STATUS_OK
        );
    }

    public function portfolio( Request $request )
    {
        return new Response(
            $this->renderWebPage( 'admin:portfolio', [
                'request-uri' => $request->getBaseUri(),
            ] ),
            Response::HTTP_STATUS_OK
        );
    }

    public function thema( Request $request )
    {
        return new Response(
            $this->renderWebPage( 'admin:thema', [
                'request-uri' => $request->getBaseUri(),
            ] ),
            Response::HTTP_STATUS_OK
        );
    }

    public function cijferregistratie( Request $request )
    {
        return new Response(
            $this->renderWebPage( 'admin:cijferregistratie', [
                'request-uri' => $request->getBaseUri(),
            ] ),
            Response::HTTP_STATUS_OK
        );
    }
}