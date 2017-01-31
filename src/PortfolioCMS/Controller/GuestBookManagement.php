<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 28-01-2017 17:49
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Controller;

use Doctrine\Instantiator\Exception\InvalidArgumentException;
use StendenINF1B\PortfolioCMS\Kernel\Authorization\User as AuthorizedUser;
use StendenINF1B\PortfolioCMS\Kernel\BaseController;
use StendenINF1B\PortfolioCMS\Kernel\Database\Repository\GuestBookMessageRepository;
use StendenINF1B\PortfolioCMS\Kernel\Database\Repository\PortfolioRepository;
use StendenINF1B\PortfolioCMS\Kernel\Database\Repository\StudentRepository;
use StendenINF1B\PortfolioCMS\Kernel\Debug\Debug;
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

    /**
     * This holds the student repository for fetching student data from the database.
     *
     * @var StudentRepository
     */
    protected $studentRepository;

    /**
     * This holds the rules for validating guestbook message data.
     *
     * @var array
     */
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
        $this->studentRepository = $this->getEntityManager()->getRepository( 'Student' );
        $this->portfolioRepository = $this->getEntityManager()->getRepository( 'Portfolio' );
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
    public function isOwnOrAdmin( int $userId )
    {
        $portfolioEntity = $this->portfolioRepository->getByUserId( $userId );
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
        $studentEntity = $this->studentRepository->getById( (int)$userId );

        if( $studentEntity->getId() == 0 )
        {
            $this->redirect( '/404' );
        }

        if( !$this->isOwnOrAdmin( (int)$userId ))
        {
            $this->redirect( '/401' );
        }

        $postParams = $request->getPostParams();

        $guestBookMessageCollection = $this->guestBookRepository->getByUserId( (int)$userId );

        if( Validation::getInstance()->validatePostParameters( $postParams, $this->guestBookMessageFields ) && $request->getMethod() === 'POST' )
        {
            try
            {
                $guestBookMessageEntity = $guestBookMessageCollection->getEntityWith( 'id', $postParams->getInt( 'messageId' ) );

                if( !$guestBookMessageEntity )
                {
                    throw new InvalidArgumentException('There is no guestbook message with the supplied id: ' . $postParams->getInt('messageId') );
                }

                // Check if the user is owner of the guest book message.
                if( $guestBookMessageEntity->getId() != $postParams->getInt('messageId') )
                {
                    $this->redirect( '/401' );
                }

                $guestBookMessageEntity->setIsAccepted( $postParams->getBoolean( 'isAccepted' ));

                $this->guestBookRepository->update( $guestBookMessageEntity );

                $feedback = 'De wijzegingen zijn opgeslagen.';
                $feedbackType = 'success';
            }
            catch ( \Exception $exception )
            {
                Debug::addException( $exception );
                $feedback = 'Er is iets fout gegaan, probeer later opnieuw.';
                $feedbackType = 'danger';
            }
        }
        elseif( $request->getMethod() === 'POST' )
        {
            $feedback = Validation::getInstance()->getReadableErrors();
            $feedbackType = 'danger';
        }

        return $this->createResponse(
            'admin:moderateGuestBook', [
                'student' => $studentEntity,
                'guestBookMessages' => $guestBookMessageCollection,
                'feedback' => $feedback ?? '',
                'feedback-type' => $feedbackType ?? '',
                'portfolio-meta-data' => $this->getPortfoliosMetadata(),
            ]
        );
    }
}