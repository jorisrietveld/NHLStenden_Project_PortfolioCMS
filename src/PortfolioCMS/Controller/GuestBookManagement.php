<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 28-01-2017 17:49
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Controller;

use StendenINF1B\PortfolioCMS\Kernel\Authorization\User as AuthorizedUser;
use StendenINF1B\PortfolioCMS\Kernel\BaseController;
use StendenINF1B\PortfolioCMS\Kernel\Database\Repository\GuestBookMessageRepository;
use StendenINF1B\PortfolioCMS\Kernel\Database\Repository\PortfolioRepository;
use StendenINF1B\PortfolioCMS\Kernel\Helper\ConfigLoader;
use StendenINF1B\PortfolioCMS\Kernel\Helper\Validation;
use StendenINF1B\PortfolioCMS\Kernel\Http\Request;
use StendenINF1B\PortfolioCMS\Kernel\TemplateEngine\TemplateEngine;

class GuestBookManagement extends BaseController
{
    /**
     * Trait with some simple helper functions.
     */
    use SiteHelper;

    /**
     * This holds the repository for communicating with the database.
     *
     * @var GuestBookMessageRepository
     */
    protected $guestBookRepository;

    /**
     * This hols the repository for communicating with the database.
     *
     * @var PortfolioRepository
     */
    protected $portfolioRepository;

    protected $guestBookMessageFields = [
        'isAccepted'  => 'required|boolean',
        'messageId' => 'required',
    ];

    /**
     * BaseController constructor for initiating the base controller.
     *
     * @param TemplateEngine|null $templateEngine
     * @param ConfigLoader|null   $configLoader
     */
    public function __construct( $templateEngine, $configLoader )
    {
        parent::__construct( $templateEngine, $configLoader );
        $this->guestBookRepository = $this->getEntityManager()->getRepository( 'GuestBookMessage' );
    }

    /**
     * @param string $name
     * @param array  $context
     * @return string
     */
    public function renderWebPage( string $name, array $context = [] ) : string
    {
        $context = array_merge( $context, [
            'asset-path'  => $this->application->getRequest()->getBaseUri() . 'assets/admin/',
            'httpRequest' => $this->application->getRequest(),
        ] );
        return parent::renderWebPage( $name, $context );
    }

    /**
     * Check for the edit methods if it the user is administrator or if it is the students own portfolio data.
     *
     * @param $id
     * @return bool
     */
    public function isOwnOrAdmin( int $portfolioId )
    {
        $portfolioEntity = $this->portfolioRepository->getById( $portfolioId );
        return $_SESSION[ 'authorizationLevel' ] == AuthorizedUser::ADMIN || $portfolioEntity->getStudent()->getId() === $_SESSION[ 'userId' ];
    }

    /**
     * @return \StendenINF1B\PortfolioCMS\Kernel\Http\Response
     */
    public function guestBookOverview( Request $request )
    {
        return $this->createResponse(
            'admin:guestBookOverview', [
                'portfolio-meta-data' => $this->getPortfoliosMetadata(),
            ]
        );
    }

    /**
     * This manages the guest book messages for an portfolio for the route: .
     *
     * @param Request $request
     * @param string  $portfolioId
     */
    public function guestBookManagement( Request $request, string $userId )
    {
        return $this->createResponse(
            'admin:moderateGuestBook', [
            ]
        );
    }
}