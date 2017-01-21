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
use StendenINF1B\PortfolioCMS\Kernel\Database\Entity\Portfolio;
use StendenINF1B\PortfolioCMS\Kernel\Database\Entity\Skill;
use StendenINF1B\PortfolioCMS\Kernel\Database\Repository\HobbyRepository;
use StendenINF1B\PortfolioCMS\Kernel\Database\Repository\ImageRepository;
use StendenINF1B\PortfolioCMS\Kernel\Database\Repository\JobExperienceRepository;
use StendenINF1B\PortfolioCMS\Kernel\Database\Repository\LanguageRepository;
use StendenINF1B\PortfolioCMS\Kernel\Database\Repository\ProjectRepository;
use StendenINF1B\PortfolioCMS\Kernel\Database\Repository\SkillRepository;
use StendenINF1B\PortfolioCMS\Kernel\Database\Repository\SLBAssignmentRepository;
use StendenINF1B\PortfolioCMS\Kernel\Database\Repository\StudentRepository;
use StendenINF1B\PortfolioCMS\Kernel\Database\Repository\TeacherRepository;
use StendenINF1B\PortfolioCMS\Kernel\Database\Repository\ThemeRepository;
use StendenINF1B\PortfolioCMS\Kernel\Database\Repository\TrainingRepository;
use StendenINF1B\PortfolioCMS\Kernel\Helper\ConfigLoader;
use StendenINF1B\PortfolioCMS\Kernel\Helper\Validation;
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
    protected $portfolioFields = [
        'title'   => 'required|alpha_space|max_length=40|min_length=3',
        'url'     => 'required|valid_url|max_length=40|min_length=3',
        'themeId' => 'required|integer',
        'userId'  => 'required|integer',
    ];

    /**
     * The required fields to update or insert an skill.
     *
     * @var array
     */
    protected $skillFields = [
        'name'              => 'required|alpha_space|min_length 3|max_length 40',
        'levelOfExperience' => 'required|numeric',
    ];

    /**
     * The required fields to update or insert an skill.
     *
     * @var array
     */
    protected $trainingFields = [
        'title'               => 'required|alpha_space|min_length 3|max_length 40',
        'institution'         => 'required|alpha_space|min_length 3|max_length 40',
        'location'            => 'required|alpha_space|min_length 3|max_length 40',
        'description'         => 'required|alpha_space|min_length 3|max_length 40',
        'obtainedCertificate' => 'required|boolean',
        'currentTraining'     => 'required|boolean',
    ];

    /**
     * The required fields to update or insert an hobby.
     *
     * @var array
     */
    protected $hobbyFields = [
        'name' => 'required|alpha_space|min_length 3|max_length 40',
    ];

    /**
     * The required fields to update or insert an language.
     *
     * @var array
     */
    protected $languageFields = [
        'language' => 'required|alpha_space|min_length 3|max_length 40',
        'level'    => 'required|numeric',
        'isNative' => 'required|boolean',
    ];

    /**
     * The required fields to update or insert an job experience.
     *
     * @var array
     */
    protected $jobExperienceFields = [
        'location'     => 'required|alpha_space|min_length 3|max_length 40',
        'description'  => 'required|alpha_space|min_length 3',
        'isInternship' => 'required|boolean',
    ];

    /**
     * The required fields to update or insert an uploaded file.
     *
     * @var array
     */
    protected $uploadedFileFields = [
        'fileName' => 'required',
        'mimeType' => 'required',
        'filePath' => 'required',
    ];

    /**
     * The required fields to update or insert an skill.
     *
     * @var array
     */
    protected $slbAssignmentFields = [
        'name' => 'required|alpha_space|min_length 3|max_length 40',
    ];

    /**
     * The required fields to update or insert an skill.
     *
     * @var array
     */
    protected $imageFields = [
        'name' => 'required|alpha_space|min_length 3|max_length 40',
        'type' => 'required|alpha_space|min_length 3|max_length 40',
    ];

    /**
     * The required fields to update or insert an skill.
     *
     * @var array
     */
    protected $projectFields = [
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
     * This can be used to fetch Theme entities from the database.
     *
     * @var ThemeRepository
     */
    protected $themeRepository;

    /**
     * This can be used to fetch Theme entities from the database.
     *
     * @var StudentRepository
     */
    protected $studentRepository;

    /**
     * This can be used to fetch Teacher entities from the database.
     *
     * @var TeacherRepository
     */
    protected $teacherRepository;

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
        $this->themeRepository = $this->getEntityManager()->getRepository( 'Theme' );
        $this->studentRepository = $this->getEntityManager()->getRepository( 'Student' );
        $this->teacherRepository = $this->getEntityManager()->getRepository( 'Teacher' );
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
     * This method renders an portfolio overview page for route /admin/portfolioOverview/{id}.
     *
     * @param Request $request
     * @param string  $id
     * @return Response
     */
    public function portfolio( Request $request, string $id ): Response
    {
        $postParams = $request->getPostParams();

        if ( !$portfolioEntity = $this->portfolioRepository->getByUserId( (int)$id ) )
        {
            $this->redirect( '/404' );
        }

        if ( !$this->isOwnOrAdmin( $id ) )
        {
            $this->redirect( '401' );
        }

        if ( $request->getMethod() === 'POST' )
        {
            if ( Validation::getInstance()->validatePostParameters( $postParams, $this->portfolioFields ) )
            {
                $updatedPortfolio = new Portfolio();
                $updatedPortfolio->setTitle( $postParams->getString( 'title' ) );
                $updatedPortfolio->setUrl( $postParams->getString( 'url' ) );
                $updatedPortfolio->setTheme( $this->themeRepository->getById( $postParams->getInt( 'themeId' ) ) );
                $updatedPortfolio->setStudent( $this->studentRepository->getById( (int)$postParams->get( 'userId' ) ) );

                $this->portfolioRepository->update( $updatedPortfolio );

                $feedback = 'De wijzegingen zijn opgeslagen.';
            }
            else
            {
                $feedback = Validation::getInstance()->getReadableErrors();
            }

        }

        return $this->createResponse(
            'admin:portfolio', [
                'title'          => $portfolioEntity->getTitle(),
                'id'             => $portfolioEntity->getId(),
                'grade'          => $portfolioEntity->getGrade(),
                'url'            => $portfolioEntity->getUrl(),
                'student'        => new DisplayStudent( $portfolioEntity->getStudent() ),
                'jobExperiences' => $portfolioEntity->getJobExperience(),
                'languages'      => $portfolioEntity->getLanguage(),
                'trainings'      => $portfolioEntity->getTrainings(),
                'slbAssignments' => $portfolioEntity->getSlbAssignments(),
                'images'         => $portfolioEntity->getImages(),
                'skills'         => $portfolioEntity->getSkills(),
                'hobbies'        => $portfolioEntity->getHobbies(),
                'projects'       => $portfolioEntity->getProjects(),
                'pages'          => $portfolioEntity->getPages(),
                'httpRequest'    => $request,
                'feedback'       => $feedback ?? '',
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

    /**
     * This method adds an new portfolio to the database for the route /admin/addPortfolio.
     *
     * @param Request $request
     * @return Response
     */
    public function addPortfolio( Request $request ) : Response
    {
        $postParams = $request->getPostParams();

        if ( Validation::getInstance()->validatePostParameters( $postParams, $this->portfolioFields ) && $request->getMethod() === 'POST')
        {
            $newPortfolio = new Portfolio();
            $newPortfolio->setTitle( $postParams->getString( 'title' ) );
            $newPortfolio->setUrl( $postParams->getString( 'url' ) );
            $newPortfolio->setTheme( $this->themeRepository->getById( $postParams->getInt( 'themeId' ) ) );
            $newPortfolio->setStudent( $this->studentRepository->getById( (int)$postParams->get( 'userId' ) ) );

            $this->portfolioRepository->insert( $newPortfolio );

            $feedback = 'Het portfolio is toegevoegd.';
        }
        else
        {
            $feedback = Validation::getInstance()->getReadableErrors();
        }

        return $this->createResponse(
            'admin:addPortfolio', [
                'feedback' => $feedback ?? '',
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

        if ( !$skillEntity = $this->skillRepository->getById( (int)$skillId ) )
        {
            $this->redirect( '404' );
        }

        if ( !$this->isOwnOrAdmin( $skillId ) )
        {
            $this->redirect( '401' );
        }

        if ( Validation::getInstance()->validatePostParameters( $postParams, $this->skillFields ) && $request->getMethod() === 'POST')
        {
            $updatedSkill = new Skill();
        }
        else
        {
            $feedback = Validation::getInstance()->getReadableErrors();
        }

        if ( !$skillEntity = $this->skillRepository->getById( (int)$skillId ) )
        {
            $this->redirect( '/404' );
        }

        return $this->createResponse(
            'admin:editSkill', [
                'skill-data' => $skillEntity,
                'feedback'   => $feedback ?? '',
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

        if ( !$trainingEntity = $this->trainingRepository->getById( (int)$trainingId ) )
        {
            $this->redirect( '404' );
        }

        if ( !$this->isOwnOrAdmin( $trainingId ) )
        {
            $this->redirect( '401' );
        }

        if ( Validation::getInstance()->validatePostParameters( $postParams, $this->trainingFields ) && $request->getMethod() === 'POST')
        {

        }
        else
        {
            $feedback = Validation::getInstance()->getReadableErrors();
        }

        return $this->createResponse(
            'admin:editTraining', [
                'training-data' => $trainingEntity,
                'feedback'      => $feedback ?? '',
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

        if ( !$hobbyEntity = $this->hobbyRepository->getById( (int)$hobbyId ) )
        {
            $this->redirect( '404' );
        }

        if ( !$this->isOwnOrAdmin( $hobbyId ) )
        {
            $this->redirect( '401' );
        }

        if ( Validation::getInstance()->validatePostParameters( $postParams, $this->hobbyFields ) && $request->getMethod() === 'POST')
        {

        }
        else
        {
            $feedback = Validation::getInstance()->getReadableErrors();
        }

        return $this->createResponse(
            'admin:editHobby', [
                'hobby-data' => $hobbyEntity,
                'feedback'   => $feedback ?? '',
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

        if ( !$languageEntity = $this->languageRepository->getById( (int)$languageId ) )
        {
            $this->redirect( '404' );
        }

        if ( !$this->isOwnOrAdmin( $languageId ) )
        {
            $this->redirect( '401' );
        }

        if ( Validation::getInstance()->validatePostParameters( $postParams, $this->languageFields ) && $request->getMethod() === 'POST')
        {

        }
        else
        {
            $feedback = Validation::getInstance()->getReadableErrors();
        }

        return $this->createResponse(
            'admin:editLanguage', [
                'language-data' => $languageEntity,
                'feedback'      => $feedback ?? '',
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

        if ( !$slbAssignmentEntity = $this->slbAssignmentRepository->getById( (int)$slbAssignmentId ) )
        {
            $this->redirect( '404' );
        }

        if ( !$this->isOwnOrAdmin( $slbAssignmentId ) )
        {
            $this->redirect( '401' );
        }

        if ( Validation::getInstance()->validatePostParameters( $postParams, $this->slbAssignmentFields ) && $request->getMethod() === 'POST')
        {

        }
        else
        {
            $feedback = Validation::getInstance()->getReadableErrors();
        }

        return $this->createResponse(
            'admin:editSlbAssignment', [
                'slbAssignment-data' => $slbAssignmentEntity,
                'feedback'           => $feedback ?? '',
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

        if ( !$imageEntity = $this->imageRepository->getById( (int)$imageId ) )
        {
            $this->redirect( '404' );
        }

        if ( !$this->isOwnOrAdmin( $imageId ) )
        {
            $this->redirect( '401' );
        }

        if ( Validation::getInstance()->validatePostParameters( $postParams, $this->imageFields ) && $request->getMethod() === 'POST')
        {

        }
        else
        {
            $feedback = Validation::getInstance()->getReadableErrors();
        }

        return $this->createResponse(
            'admin:editImage', [
                'image-data' => $imageEntity,
                'feedback'   => $feedback ?? '',
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

        if ( !$projectEntity = $this->projectRepository->getById( (int)$projectId ) )
        {
            $this->redirect( '404' );
        }

        if ( !$this->isOwnOrAdmin( $projectId ) )
        {
            $this->redirect( '401' );
        }

        if ( Validation::getInstance()->validatePostParameters( $postParams, $this->projectFields ) && $request->getMethod() === 'POST')
        {

        }
        else
        {
            $feedback = Validation::getInstance()->getReadableErrors();
        }

        return $this->createResponse(
            'admin:editProject', [
                'project-data' => $projectEntity,
                'feedback'     => $feedback ?? '',
            ]
        );
    }

    /**
     * This method updates an JobExperience in the database for the route /admin/editJobExperience/{id}.
     *
     * @param Request $request
     * @param string  $jobExperienceId
     * @return Response
     */
    public function editJobExperience( Request $request, string $jobExperienceId ): Response
    {
        $postParams = $request->getPostParams();

        if ( !$jobExperienceEntity = $this->jobExperienceRepository->getById( (int)$jobExperienceId ) )
        {
            $this->redirect( '404' );
        }

        if ( !$this->isOwnOrAdmin( $jobExperienceId ) )
        {
            $this->redirect( '401' );
        }

        if ( Validation::getInstance()->validatePostParameters( $postParams, $this->jobExperienceFields ) && $request->getMethod() === 'POST' )
        {

        }
        else
        {
            $feedback = Validation::getInstance()->getReadableErrors();
        }

        return $this->createResponse(
            'admin:editJobExperience', [
                'project-data' => $jobExperienceEntity,
                'feedback'     => $feedback ?? '',
            ]
        );
    }

    /**
     * This method inserts an JobExperience in the database for the route /admin/addJobExperience.
     *
     * @param Request $request
     * @param string  $jobExperienceId
     * @return Response
     */
    public function addJobExperience( Request $request ): Response
    {
        $postParams = $request->getPostParams();

        if ( Validation::getInstance()->validatePostParameters( $postParams, $this->jobExperienceFields ) && $request->getMethod() === 'POST')
        {

        }
        else
        {
            $feedback = Validation::getInstance()->getReadableErrors();
        }

        return $this->createResponse(
            'admin:addJobExperience', [
                'feedback' => $feedback ?? '',
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
        $postParams = $request->getPostParams();

        if ( Validation::getInstance()->validatePostParameters( $postParams, $this->skillFields ) && $request->getMethod() === 'POST')
        {

        }
        else
        {
            $feedback = Validation::getInstance()->getReadableErrors();
        }

        return $this->createResponse(
            'admin:addSkill', [
                'feedback'       => $feedback ?? '',
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
        $postParams = $request->getPostParams();

        if ( Validation::getInstance()->validatePostParameters( $postParams, $this->trainingFields ) && $request->getMethod() === 'POST')
        {

        }
        else
        {
            $feedback = Validation::getInstance()->getReadableErrors();
        }

        return $this->createResponse(
            'admin:addTraining', [
                'feedback'       => $feedback ?? '',
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
        $postParams = $request->getPostParams();

        if ( Validation::getInstance()->validatePostParameters( $postParams, $this->trainingFields ) && $request->getMethod() === 'POST')
        {

        }
        else
        {
            $feedback = Validation::getInstance()->getReadableErrors();
        }

        return $this->createResponse(
            'admin:addHobby', [
                'feedback'       => $feedback ?? '',
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
        $postParams = $request->getPostParams();

        if ( Validation::getInstance()->validatePostParameters( $postParams, $this->trainingFields ) && $request->getMethod() === 'POST')
        {

        }
        else
        {
            $feedback = Validation::getInstance()->getReadableErrors();
        }

        return $this->createResponse(
            'admin:addLanguage', [
                'feedback'       => $feedback ?? '',
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
        $postParams = $request->getPostParams();

        if ( Validation::getInstance()->validatePostParameters( $postParams, $this->trainingFields ) && $request->getMethod() === 'POST')
        {

        }
        else
        {
            $feedback = Validation::getInstance()->getReadableErrors();
        }

        return $this->createResponse(
            'admin:addSlbAssignment', [
                'feedback'       => $feedback ?? '',
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
        $postParams = $request->getPostParams();

        if ( Validation::getInstance()->validatePostParameters( $postParams, $this->trainingFields ) && $request->getMethod() === 'POST')
        {

        }
        else
        {
            $feedback = Validation::getInstance()->getReadableErrors();
        }

        return $this->createResponse(
            'admin:addImage', [
                'feedback'       => $feedback ?? '',
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
        $postParams = $request->getPostParams();

        if ( Validation::getInstance()->validatePostParameters( $postParams, $this->trainingFields ) && $request->getMethod() === 'POST')
        {

        }
        else
        {
            $feedback = Validation::getInstance()->getReadableErrors();
        }

        return $this->createResponse(
            'admin:addProject', [
                'feedback'       => $feedback ?? '',
            ]
        );
    }
}
