<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 18-01-2017 20:53
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Controller;

use StendenINF1B\PortfolioCMS\Kernel\BaseController;
use StendenINF1B\PortfolioCMS\Kernel\Database\Repository\PortfolioRepository;
use StendenINF1B\PortfolioCMS\Kernel\Database\Repository\ProjectRepository;
use StendenINF1B\PortfolioCMS\Kernel\Database\Repository\StudentRepository;
use StendenINF1B\PortfolioCMS\Kernel\Helper\ConfigLoader;
use StendenINF1B\PortfolioCMS\Kernel\Http\Request;
use StendenINF1B\PortfolioCMS\Kernel\Http\Response;
use StendenINF1B\PortfolioCMS\Kernel\TemplateEngine\TemplateEngine;

class GradesManagement extends BaseController
{
    use SiteHelper;

    /**
     * @var ProjectRepository
     */
    protected $projectsRepository;

    /**
     * @var PortfolioRepository
     */
    protected $portfolioRepository;

    /**
     * @var StudentRepository
     */
    protected $studentRepository;

    /**
     * BaseController constructor for initiating the base controller.
     *
     * @param TemplateEngine|null $templateEngine
     * @param ConfigLoader|null   $configLoader
     */
    public function __construct( $templateEngine, $configLoader )
    {
        parent::__construct( $templateEngine, $configLoader );

        $this->projectsRepository = $this->getEntityManager()->getRepository( 'Project' );
        $this->portfolioRepository = $this->getEntityManager()->getRepository( 'Portfolio' );
        $this->studentRepository = $this->getEntityManager()->getRepository( 'Student' );
    }

    /**
     * This method shows an table with the users grade for the route /admin/cijferAdministratie/{id}
     *
     * @param Request $request
     * @param string  $id
     * @return Response
     */
    public function gradeManagement( Request $request, string $userId ): Response
    {
        $portfolioEntity = $this->portfolioRepository->getByUserId( (int)$userId );
        $projectsEntities = $this->projectsRepository->getGradesByUserId( (int)$userId );

        if( $portfolioEntity->getId() == 0 )
        {
            $this->redirect( '/404' );
        }

        $gradesArray = [];
        $gradesArray[] = [
            'name' => 'Digitaal Portfolio',
            'grade' => $portfolioEntity->getGrade(),
        ];
        foreach ( $projectsEntities as $resultSet )
        {
            $gradesArray[] = [
                'name' => $resultSet->getString( 'name' ),
                'grade' => $resultSet->getFloat( 'grade' ),
            ];
        }

        return $this->createResponse(
            'admin:cijferregistratie', [
                'asset-path' => $this->application->getRequest()->getBaseUri() . 'assets/admin/',
                'grade-data' => $gradesArray,
                'student' => $this->studentRepository->getById( (int)$userId ),
                'httpRequest'         => $this->application->getRequest(),
                'portfolio-meta-data' => $this->getPortfoliosMetadata(),
            ]
        );
    }

    /**
     * This method shows an list with all the users and redirects to the method gradeManagement. for the route /admin/gradesOverview.
     *
     * @param Request $request
     * @return Response
     */
    public function gradeOverview( Request $request ): Response
    {
        return $this->createResponse(
            'admin:cijferOverzicht', [
                'asset-path'  => $this->application->getRequest()->getBaseUri() . 'assets/admin/',
                'grades-data' => $this->getPortfoliosMetadata(),
            ]
        );
    }
}