<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 06-01-2017 16:07
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Controller;


use StendenINF1B\PortfolioCMS\Kernel\BaseController;
use StendenINF1B\PortfolioCMS\Kernel\Http\Request;
use StendenINF1B\PortfolioCMS\Kernel\Http\Response;

class Authentication extends BaseController
{
    use SiteHelper;

    /**
     * This action is for handling the Login route.
     *
     * @param Request|null $request
     * @return Response
     */
    public function index( Request $request = null )
    {
        if ( $request->postParams->has( 'username' ) && $request->postParams->has( 'password' ) )
        {
            // todo handle login.
        }

        return new Response(
            $this->renderWebPage( 'site:login', [
                'portfolioMenuLinks' => $this->renderMenuLinks()
            ] ),
            Response::HTTP_STATUS_OK
        );
    }

    /**
     * This action if for handling the register route.
     *
     * @param Request|null $request
     * @return Response
     */
    public function register( Request $request = null )
    {
        if ( $request->postParams->has( 'email' ) &&
            $request->postParams->has( 'password' ) &&
            $request->postParams->has( 'passwordRepeat' ) &&
            $request->postParams->has( 'firstName' ) &&
            $request->postParams->has( 'lastName' ) &&
            $request->postParams->has( 'name' ) &&
            $request->postParams->has( 'name' )
        )
        {
            // todo write code to register the user.
        }
        else
        {
            // Not all fields are filled in so render with error message.
            return new Response(
                $this->renderWebPage( 'site:register', [
                    'message' => 'Je moet alle velden invullen.',
                ] ),
                Response::HTTP_STATUS_OK
            );
        }

        // Default response renders the register page
        return new Response(
            $this->renderWebPage( 'site:register' ),
            Response::HTTP_STATUS_OK
        );

    }
}