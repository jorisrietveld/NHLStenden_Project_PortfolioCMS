<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 10-01-2017 14:45
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Controller;

use StendenINF1B\PortfolioCMS\Kernel\Authorization\User as AuthorizedUser;
use StendenINF1B\PortfolioCMS\Kernel\BaseController;
use StendenINF1B\PortfolioCMS\Kernel\Database\Entity\DisplayStudent;
use StendenINF1B\PortfolioCMS\Kernel\Database\Entity\Hobby;
use StendenINF1B\PortfolioCMS\Kernel\Database\Entity\Portfolio;
use StendenINF1B\PortfolioCMS\Kernel\Database\Entity\Skill;
use StendenINF1B\PortfolioCMS\Kernel\Database\Repository\HobbyRepository;
use StendenINF1B\PortfolioCMS\Kernel\Database\Repository\ImageRepository;
use StendenINF1B\PortfolioCMS\Kernel\Database\Repository\JobExperienceRepository;
use StendenINF1B\PortfolioCMS\Kernel\Database\Repository\LanguageRepository;
use StendenINF1B\PortfolioCMS\Kernel\Database\Repository\ProjectRepository;
use StendenINF1B\PortfolioCMS\Kernel\Database\Repository\SkillRepository;
use StendenINF1B\PortfolioCMS\Kernel\Database\Repository\SLBAssignmentRepository;
use StendenINF1B\PortfolioCMS\Kernel\Database\Repository\TrainingRepository;
use StendenINF1B\PortfolioCMS\Kernel\Helper\ConfigLoader;
use StendenINF1B\PortfolioCMS\Kernel\Http\ParameterContainer;
use StendenINF1B\PortfolioCMS\Kernel\Http\Request;
use StendenINF1B\PortfolioCMS\Kernel\Http\Response;
use StendenINF1B\PortfolioCMS\Kernel\TemplateEngine\TemplateEngine;

class PortfolioManagement extends BaseController
{
    use SiteHelper;
    /**
     * The require fields to update or insert an portfolio.
     *
     * @var array
     */
    protected $requiredPortfolioFields = [
        'title',
        'url',
        'themeId',
        'userId',
    ];

    /**
     * The required fields to update or insert an skill.
     *
     * @var array
     */
    protected $requiredSkillFields = [
        'name',
        'levelOfExperience',
    ];

    /**
     * The required fields to update or insert an skill.
     *
     * @var array
     */
    protected $requiredTrainingFields = [
        'title',
        'institution',
        'location',
        'description',
        'obtainedCertificate',
        'currentTraining',
    ];

    /**
     * The required fields to update or insert an hobby.
     *
     * @var array
     */
    protected $requiredHobbyFields = [
        'name',
    ];

    /**
     * The required fields to update or insert an language.
     *
     * @var array
     */
    protected $requiredLanguageFields = [
        'language',
        'level',
        'isNative',
    ];

    /**
     * The required fields to update or insert an job experience.
     *
     * @var array
     */
    protected $requiredJobExperienceFields = [
        'location',
        'description',
        'isInternship',
    ];

    /**
     * The required fields to update or insert an uploaded file.
     *
     * @var array
     */
    protected $requiredUploadedFileFields = [
        'fileName',
        'mimeType',
        'filePath',
    ];

    /**
     * The required fields to update or insert an skill.
     *
     * @var array
     */
    protected $requiredSlbAssignmentFields = [
        'name',
    ];

    /**
     * The required fields to update or insert an skill.
     *
     * @var array
     */
    protected $requiredImageFields = [
        'name',
        'type',
    ];

    /**
     * The required fields to update or insert an skill.
     *
     * @var array
     */
    protected $requiredProjectFields = [
        'name',
        'description',
        'link',
        'thumbnailImageId',
    ];

    /**
     * This can be used to fetch JobExperience entities from the database.
     *
     * @var JobExperienceRepository
     */
    protected $jobExperienceRepository;

    /**
     * This can be used to fetch Language entities from the database.
     *
     * @var LanguageRepository
     */
    protected $languageRepository;

    /**
     * This can be used to fetch training entities from the database.
     *
     * @var TrainingRepository
     */
    protected $trainingRepository;

    /**
     * This can be used to fetch SlbAssignment entities from the database.
     *
     * @var SLBAssignmentRepository
     */
    protected $slbAssignmentRepository;

    /**
     * This can be used to fetch Image entities from the database.
     *
     * @var ImageRepository
     */
    protected $imageRepository;

    /**
     * This can be used to fetch Skill entities from the database.
     *
     * @var SkillRepository
     */
    protected $skillRepository;

    /**
     * This can be used to fetch Hobby entities from the database.
     *
     * @var HobbyRepository
     */
    protected $hobbyRepository;

    /**
     * This can be used to fetch Project entities from the database.
     *
     * @var ProjectRepository
     */
    protected $projectRepository;

    /**
     * BaseController constructor for initiating the portfolio controller.
     *
     * @param TemplateEngine|null $templateEngine
     * @param ConfigLoader|null   $configLoader
     */
    public function __construct( $templateEngine, $configLoader )
    {
        parent::__construct( $templateEngine, $configLoader );
        $this->portfolioRepository = $this->getEntityManager()->getRepository( 'Portfolio' );
        $this->jobExperienceRepository = $this->getEntityManager()->getRepository( 'JobExperience' );
        $this->languageRepository = $this->getEntityManager()->getRepository( 'Language' );
        $this->trainingRepository = $this->getEntityManager()->getRepository( 'Training' );
        $this->slbAssignmentRepository = $this->getEntityManager()->getRepository( 'SLBAssignment' );
        $this->imageRepository = $this->getEntityManager()->getRepository( 'Image' );
        $this->skillRepository = $this->getEntityManager()->getRepository( 'Skill' );
        $this->hobbyRepository = $this->getEntityManager()->getRepository( 'Hobby' );
        $this->projectRepository = $this->getEntityManager()->getRepository( 'Project' );
    }

    /**
     * Shortcut to return an response.
     *
     * @param string $webPage
     * @param array  $context
     * @param int    $httpCode
     * @return Response
     */
    public function createResponse( string $webPage, array $context, $httpCode = Response::HTTP_STATUS_OK ) : Response
    {
        $context = array_merge( $context, [
            'asset-path'  => $this->application->getRequest()->getBaseUri() . 'assets/admin/',
            'httpRequest' => $this->application->getRequest(),
        ] );

        return parent::createResponse( $webPage, $context, $httpCode );
    }

    /**
     * Check for the edit methods if it the user is administrator or if it is the students own portfolio data.
     *
     * @param $id
     * @return bool
     */
    public function isOwnOrAdmin( $id )
    {
        return ( $_SESSION[ 'authorizationLevel' ] == AuthorizedUser::ADMIN || $_SESSION[ 'userId' ] == $id );
    }

    /**
     * Check if all required post parameters are send in an request.
     *
     * @param ParameterContainer $postParams
     * @param array              $requiredPostFields
     * @return bool
     */
    public function hasRequiredPostFields( ParameterContainer $postParams, array $requiredPostFields )
    {
        return count( array_diff_assoc( (array)$postParams, $this->requiredPortfolioFields ) ) != 0;
    }

    /**
     * This method renders an portfolio overview page for route /admin/portfolioOverview/{id}.
     *
     * @param Request $request
     * @param string  $id
     * @return Response
     */
    public function portfolio( Request $request, string $id ): Response
    {
        $postParams = $request->getPostParams();

        if( $request->getMethod() === 'POST' )
        {
            // todo write code to handle the form submission
        }

        if(!$portfolioEntity = $this->portfolioRepository->getByUserId( (int)$id ) )
        {
            $this->redirect( '/404' );
        }

        return $this->createResponse(
            'admin:portfolio', [
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
                'httpRequest' => $request,
            ]
        );
    }

    /**
     * This method renders an over view page of all portfolios for the route /admin/portfoliosOverview.
     *
     * @param Request $request
     * @param string  $id
     * @return Response
     */
    public function portfolioOverview( Request $request ) : Response
    {
        return $this->createResponse(
            'admin:portfolioOverzicht', [
                'portfolios-data' => $this->getPortfoliosMetadata(),
            ]
        );
    }

    public function addPortfolio( Request $request ) : Response
    {
        $postParams = $request->getPostParams();

        if ( $this->checkPostParams( $postParams, $this->requiredPortfolioFields ) )
        {
            $themeRepository = $this->getEntityManager()->getRepository( 'Theme' );
            $studentRepository = $this->getEntityManager()->getRepository( 'Student' );
            $portfolioRepository = $this->getEntityManager()->getRepository( 'Portfolio' );

            $newPortfolio = new Portfolio();
            $newPortfolio->setTitle( (string)$postParams->get( 'title' ) );
            $newPortfolio->setUrl( (string)$postParams->get( 'url' ) );
            $newPortfolio->setTheme( $themeRepository->getById( (int)$postParams->get( 'themeId' ) ) );
            $newPortfolio->setStudent( $studentRepository->getById( (int)$postParams->get( 'userId' ) ) );

            $portfolioRepository->insert( $newPortfolio );
        }

        return $this->createResponse(
            'admin:addPortfolio', [

            ]
        );
    }

    /**
     * This method updates an skill in the database for the route /admin/editSkill/{id}.
     *
     * @param Request $request
     * @param string  $skillId
     * @return Response
     */
    public function editSkill( Request $request, string $skillId ): Response
    {
        $postParams = $request->getPostParams();

        if( $request->getMethod() === 'POST' )
        {
            // todo write code to handle the form submission
        }

        if( !$skillEntity = $this->skillRepository->getById( (int)$skillId ) )
        {
            $this->redirect( '/404' );
        }

        return $this->createResponse(
            'admin:editSkill', [
                'skill-data' => $skillEntity,
            ]
        );
    }

    /**
     * This method updates an training in the database for the route /admin/editTraining/{id}.
     *
     * @param Request $request
     * @param string  $trainingId
     * @return Response
     */
    public function editTraining( Request $request, string $trainingId ): Response
    {
        $postParams = $request->getPostParams();

        if( $request->getMethod() === 'POST' )
        {
            // todo write code to handle the form submission
        }

        if( !$trainingEntity = $this->trainingRepository->getById( (int)$trainingId ) )
        {
            $this->redirect( '/404' );
        }

        return $this->createResponse(
            'admin:editTraining', [
                'training-data' => $trainingEntity,
            ]
        );
    }

    /**
     * This method updates an hobby in the database for the route /admin/editHobby/{id}.
     *
     * @param Request $request
     * @param string  $hobbyId
     * @return Response
     */
    public function editHobby( Request $request, string $hobbyId ): Response
    {
        $postParams = $request->getPostParams();

        if( $request->getMethod() === 'POST' )
        {
            // todo write code to handle the form submission
        }

        if( !$hobbyEntity = $this->hobbyRepository->getById( (int)$hobbyId ) )
        {
            $this->redirect( '/404' );
        }

        return $this->createResponse(
            'admin:editHobby', [
                'hobby-data' => $hobbyEntity,
            ]
        );
    }

    /**
     * This method updates an language in the database for the route /admin/editLanguage/{id}.
     *
     * @param Request $request
     * @param string  $languageId
     * @return Response
     */
    public function editLanguage( Request $request, string $languageId ): Response
    {
        $postParams = $request->getPostParams();

        if( $request->getMethod() === 'POST' )
        {
            // todo write code to handle the form submission
        }

        if( !$languageEntity = $this->languageRepository->getById( (int)$languageId ) )
        {
            $this->redirect( '/404' );
        }

        return $this->createResponse(
            'admin:editLanguage', [
                'language-data' => $languageEntity,
            ]
        );
    }

    /**
     * This method updates an slb assignment in the database for the route /admin/editSlbAssignment/{id}.
     *
     * @param Request $request
     * @param string  $slbAssignmentId
     * @return Response
     */
    public function editSlbAssignment( Request $request, string $slbAssignmentId ): Response
    {
        $postParams = $request->getPostParams();

        if( $request->getMethod() === 'POST' )
        {
            // todo write code to handle the form submission
        }

        if( !$slbAssignmentEntity = $this->slbAssignmentRepository->getById( (int)$slbAssignmentId ) )
        {
            $this->redirect( '/404' );
        }

        return $this->createResponse(
            'admin:editSlbAssignment', [
                'slbAssignment-data' => $slbAssignmentEntity,
            ]
        );
    }

    /**
     * This method updates an image in the database for the route /admin/editImage/{id}.
     *
     * @param Request $request
     * @param string  $imageId
     * @return Response
     */
    public function editImage( Request $request, string $imageId ): Response
    {
        $postParams = $request->getPostParams();

        if( $request->getMethod() === 'POST' )
        {
            // todo write code to handle the form submission
        }

        if( !$imageEntity = $this->imageRepository->getById( (int)$imageId ) )
        {
            $this->redirect( '/404' );
        }

        return $this->createResponse(
            'admin:editImage', [
                'image-data' => $imageEntity,
            ]
        );
    }

    /**
     * This method updates an image in the database for the route /admin/editProject/{id}.
     *
     * @param Request $request
     * @param string  $projectId
     * @return Response
     */
    public function editProject( Request $request, string $projectId ): Response
    {
        $postParams = $request->getPostParams();

        if( $request->getMethod() === 'POST' )
        {
            // todo write code to handle the form submission
        }

        if( !$projectEntity = $this->projectRepository->getById( (int)$projectId ) )
        {
            $this->redirect( '/404' );
        }


        return $this->createResponse(
            'admin:editProject', [
                'project-data' => $projectEntity,
            ]
        );
    }

    /**
     * This method adds an skill in the database for the route /admin/addSkill/{id}.
     *
     * @param Request $request
     * @param string  $skillId
     * @return Response
     */
    public function addSkill( Request $request ): Response
    {
        return $this->createResponse(
            'admin:addSkill', [

            ]
        );
    }

    /**
     * This method adds an training in the database for the route /admin/addTraining/{id}.
     *
     * @param Request $request
     * @param string  $trainingId
     * @return Response
     */
    public function addTraining( Request $request ): Response
    {
        return $this->createResponse(
            'admin:addTraining', [

            ]
        );
    }

    /**
     * This method adds an hobby in the database for the route /admin/addHobby/{id}.
     *
     * @param Request $request
     * @param string  $hobbyId
     * @return Response
     */
    public function addHobby( Request $request ): Response
    {
        return $this->createResponse(
            'admin:addHobby', [

            ]
        );
    }

    /**
     * This method adds an language in the database for the route /admin/addLanguage/{id}.
     *
     * @param Request $request
     * @param string  $languageId
     * @return Response
     */
    public function addLanguage( Request $request ): Response
    {
        return $this->createResponse(
            'admin:addLanguage', [

            ]
        );
    }

    /**
     * This method adds an slb assignment in the database for the route /admin/addSlbAssignment/{id}.
     *
     * @param Request $request
     * @param string  $slbAssignmentId
     * @return Response
     */
    public function addSlbAssignment( Request $request ): Response
    {
        return $this->createResponse(
            'admin:addSlbAssignment', [

            ]
        );
    }

    /**
     * This method adds an image in the database for the route /admin/addImage/{id}.
     *
     * @param Request $request
     * @param string  $imageId
     * @return Response
     */
    public function addImage( Request $request ): Response
    {
        return $this->createResponse(
            'admin:addImage', [

            ]
        );
    }

    /**
     * This method adds an image in the database for the route /admin/addProject/{id}.
     *
     * @param Request $request
     * @param string  $projectId
     * @return Response
     */
    public function addProject( Request $request ): Response
    {
        return $this->createResponse(
            'admin:addProject', [

            ]
        );
    }
}
