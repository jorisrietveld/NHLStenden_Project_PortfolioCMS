<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 22-12-2016 13:30
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Controller;

use StendenINF1B\PortfolioCMS\Kernel\BaseController;
use StendenINF1B\PortfolioCMS\Kernel\Database\Entity\DisplayStudent;
use StendenINF1B\PortfolioCMS\Kernel\Database\Entity\GuestBookMessage;
use StendenINF1B\PortfolioCMS\Kernel\Debug\Debug;
use StendenINF1B\PortfolioCMS\Kernel\Helper\ConfigLoader;
use StendenINF1B\PortfolioCMS\Kernel\Helper\Validation;
use StendenINF1B\PortfolioCMS\Kernel\Http\ParameterContainer;
use StendenINF1B\PortfolioCMS\Kernel\Http\Request;
use StendenINF1B\PortfolioCMS\Kernel\Http\Response;
use StendenINF1B\PortfolioCMS\Kernel\TemplateEngine\TemplateEngine;

class Portfolio extends BaseController
{
    use SiteHelper;

    const DEFAULT_PORTFOLIO_PAGE = 'index';

    public function __construct( TemplateEngine $templateEngine = NULL, ConfigLoader $configLoader = NULL )
    {
        parent::__construct( $templateEngine, $configLoader );

    }

    /**
     * This action is for handling the portfolio routes.
     *
     * @param Request|null $request
     * @param null         $studentName
     * @param null         $portfolioPageName
     * @return Response
     */
    public function index( Request $request, $studentName = NULL, $portfolioPageName = NULL )
    {
        if ( $studentName !== NULL )
        {
            if ( $request->getMethod() == 'POST' )
            {
                $feedback = $this->addGuestBookMessage( $request->getPostParams() );
                $feedbackType = $feedback[ 0 ];
                $feedback = $feedback[ 1 ];
            }

            if ( !$portfolioEntity = $this->getPortfolios()->getEntityWith( 'url', $studentName ) )
            {
                $this->redirect( '/404' );
            }

            $pages = $portfolioEntity->getPages();

            if ( $portfolioPageName !== NULL )
            {
                $portfolioPage = $pages->getEntityWith( 'url', '/' . $portfolioPageName );

                if ( $portfolioPage == NULL )
                {
                    return $this->redirect( '/404' );
                }
            }
            else
            {
                $portfolioPageName = self::DEFAULT_PORTFOLIO_PAGE;
            }

            if ( $portfolioEntity )
            {
                $theme = $portfolioEntity->getTheme();
                return $this->createResponse(
                    $theme->getDirectoryName() . ':' . $portfolioPageName, [
                        'title'              => $portfolioEntity->getTitle(),
                        'id'                 => $portfolioEntity->getId(),
                        'grade'              => $portfolioEntity->getGrade(),
                        'url'                => $portfolioEntity->getUrl(),
                        'student'            => new DisplayStudent( $portfolioEntity->getStudent() ),
                        'jobExperiences'     => $portfolioEntity->getJobExperience(),
                        'languages'          => $portfolioEntity->getLanguage(),
                        'trainings'          => $portfolioEntity->getTrainings(),
                        'slbAssignments'     => $portfolioEntity->getSlbAssignments(),
                        'images'             => $portfolioEntity->getImages(),
                        'skills'             => $portfolioEntity->getSkills(),
                        'hobbies'            => $portfolioEntity->getHobbies(),
                        'projects'           => $portfolioEntity->getProjects(),
                        'pages'              => $portfolioEntity->getPages(),
                        'httpRequest'        => $request,
                        'asset-path'         => $request->getBaseUri() . 'assets/' . $theme->getDirectoryName() . '/',
                        'portfoliosMetadata' => $this->getPortfoliosMetadata(),
                        'current-page'       => $portfolioPageName,
                        'portfolioMenuLinks' => $this->renderMenuLinks(),
                        'cv'                 => $portfolioEntity->getCv(),
                        'feedback'           => $feedback ?? '',
                        'feedback-type'      => $feedbackType ?? '',
                        'guestBookMessages'  => $portfolioEntity->getGuestBookMessages()->getEntitiesWith( 'isAccepted', TRUE ),
                    ]
                );
            }

        }
        else
        {
            // No name is set for the repository so redirect the user to home.
            return $this->redirect( '/home' );
        }
    }

    public function addGuestBookMessage( ParameterContainer $postParams )
    {
        $guestBookMessageRepository = $this->getEntityManager()->getRepository( 'GuestBookMessage' );

        $validationRules = [
            'message'   => 'required|min_length,5|max_length,500',
            'sender'    => 'required|min_length,3|max_length,100',
            'studentId' => 'required',
        ];

        if ( Validation::getInstance()->validatePostParameters( $postParams, $validationRules ) )
        {
            try
            {
                $guestBookMessageEntity = new GuestBookMessage();
                $guestBookMessageEntity->setStudentId( $postParams->getInt( 'studentId' ) );
                $guestBookMessageEntity->setIsAccepted( FALSE );
                $guestBookMessageEntity->setSender( $postParams->getString( 'sender' ) );
                $guestBookMessageEntity->setTitle( $postParams->getString( 'title', 'Geen titel' ) );
                $guestBookMessageEntity->setSendAt( new \DateTime() );
                $guestBookMessageEntity->setMessage( $postParams->getString( 'message' ) );

                $guestBookMessageRepository->insert( $guestBookMessageEntity );
                return [
                    'success',
                    'Het bericht is geplaats, en zal worden weergegeven wanneer hij toegestaan is door de beheerder.',
                ];
            }
            catch ( \Exception $exception )
            {
                Debug::addException( $exception );
                return [
                    'danger',
                    'Er is iets fout gegaan bij het opslaan van je bericht, probeer later opnieuw.',
                ];
            }
        }
        else
        {
            return [
                'danger',
                Validation::getInstance()->getReadableErrors(),
            ];
        }
    }

}