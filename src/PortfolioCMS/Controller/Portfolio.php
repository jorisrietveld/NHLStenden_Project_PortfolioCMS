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
use StendenINF1B\PortfolioCMS\Kernel\Database\Entity\Student;
use StendenINF1B\PortfolioCMS\Kernel\Helper\ConfigLoader;
use StendenINF1B\PortfolioCMS\Kernel\Http\Request;
use StendenINF1B\PortfolioCMS\Kernel\Http\Response;
use StendenINF1B\PortfolioCMS\Kernel\TemplateEngine\TemplateEngine;

class Portfolio extends BaseController
{
    use SiteHelper;

    const DEFAULT_PORTFOLIO_PAGE = 'index';

    public function __construct( TemplateEngine $templateEngine = null, ConfigLoader $configLoader = null )
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
    public function index( Request $request = null, $studentName = null, $portfolioPageName = null )
    {
        if ( $studentName !== null )
        {
            $portfolioEntity = $this->getPortfolios()->getEntityWith( 'url', $studentName );
            if ( $portfolioEntity )
            {
                $portfolioPageName = $portfolioPageName ?? self::DEFAULT_PORTFOLIO_PAGE;
                $theme = $portfolioEntity->getTheme();

                $renderedOutput = $this->templateEngine->render(
                    $theme->getDirectoryName() . ':' . $portfolioPageName, [
                    'title' => $portfolioEntity->getTitle(),
                    'id' => $portfolioEntity->getId(),
                    'grade' => $portfolioEntity->getGrade(),
                    'url' => $portfolioEntity->getUrl(),
                    'student' => new DisplayStudent( $portfolioEntity->getStudent() ),
                    'jobExperiences' => $portfolioEntity->getJobExperience(),
                    'languages' => $portfolioEntity->getLanguage(),
                    'trainings' => $portfolioEntity->getTrainings(),
                    'slbAssignments' => $portfolioEntity->getSlbAssignments(),
                    'images' => $portfolioEntity->getImages(),
                    'skills' => $portfolioEntity->getSkills(),
                    'hobbies' => $portfolioEntity->getHobbies(),
                    'projects' => $portfolioEntity->getProjects(),
                    'pages' => $portfolioEntity->getPages(),
                ] );

                return new Response(
                    $renderedOutput,
                    Response::HTTP_STATUS_OK
                );
            }

        }
        else
        {
            // No name is set for the repository so redirect the user to home.
            return $this->redirect( '/home' );
        }

        return new Response( '<h1>No Portfolio found!</h1>', 200 );
    }

}