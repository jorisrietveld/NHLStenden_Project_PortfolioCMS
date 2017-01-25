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
use StendenINF1B\PortfolioCMS\Kernel\Database\Entity\Image;
use StendenINF1B\PortfolioCMS\Kernel\Database\Entity\JobExperience;
use StendenINF1B\PortfolioCMS\Kernel\Database\Entity\Language;
use StendenINF1B\PortfolioCMS\Kernel\Database\Entity\Portfolio;
use StendenINF1B\PortfolioCMS\Kernel\Database\Entity\Project;
use StendenINF1B\PortfolioCMS\Kernel\Database\Entity\Skill;
use StendenINF1B\PortfolioCMS\Kernel\Database\Entity\SLBAssignment;
use StendenINF1B\PortfolioCMS\Kernel\Database\Entity\Training;
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
use StendenINF1B\PortfolioCMS\Kernel\Debug\Debug;
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
        'title'   => 'required|alpha_space|max_length,40|min_length,3',
        'url'     => 'required|max_length,40|min_length,3',
        'themeId' => 'required|integer',
        'userId'  => 'required|integer',
    ];

    /**
     * The required fields to update or insert an skill.
     *
     * @var array
     */
    protected $skillFields = [
        'name'              => 'required|alpha_space|min_length,3|max_length,40',
        'levelOfExperience' => 'required|numeric',
    ];

    /**
     * The required fields to update or insert an skill.
     *
     * @var array
     */
    protected $trainingFields = [
        'title'               => 'required|alpha_space|min_length,3|max_length,40',
        'institution'         => 'required|alpha_space|min_length,3|max_length,40',
        'location'            => 'required|alpha_space|min_length,3|max_length,40',
        'description'         => 'required|alpha_space|min_length,3|max_length,40',
        'obtainedCertificate' => 'required|boolean',
        'currentTraining'     => 'required|boolean',
    ];

    /**
     * The required fields to update or insert an hobby.
     *
     * @var array
     */
    protected $hobbyFields = [
        'name' => 'required|alpha_space|min_length,3|max_length,40',
    ];

    /**
     * The required fields to update or insert an language.
     *
     * @var array
     */
    protected $languageFields = [
        'language' => 'required|alpha_space|min_length,3|max_length,40',
        'level'    => 'required|numeric',
        'isNative' => 'required|boolean',
    ];

    /**
     * The required fields to update or insert an job experience.
     *
     * @var array
     */
    protected $jobExperienceFields = [
        'location'     => 'required|alpha_space|min_length,3|max_length,40',
        'description'  => 'required|alpha_space|min_length,3',
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
        'name' => 'required|alpha_space|min_length,3|max_length,40',
    ];

    /**
     * The required fields to update or insert an skill.
     *
     * @var array
     */
    protected $imageFields = [
        'name' => 'required|alpha_space|min_length,3|max_length,40',
        'type' => 'required|alpha_space|min_length,3|max_length,40',
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
    public function isOwnOrAdmin( int $portfolioId )
    {
        $portfolioEntity = $this->portfolioRepository->getById( $portfolioId );
        return $_SESSION[ 'authorizationLevel' ] == AuthorizedUser::ADMIN || $portfolioEntity->getStudent()->getId() === $_SESSION[ 'userId' ];
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

        if ( !$this->isOwnOrAdmin( $portfolioEntity->getId() ) )
        {
            $this->redirect( '401' );
        }

        if ( $request->getMethod() === 'POST' )
        {
            if ( Validation::getInstance()->validatePostParameters( $postParams, $this->portfolioFields ) )
            {
                try
                {
                    $portfolioEntity->setTitle( $postParams->getString( 'title' ) );
                    $portfolioEntity->setUrl( $postParams->getString( 'url' ) );
                    $portfolioEntity->setTheme( $this->themeRepository->getById( $postParams->getInt( 'themeId' ) ) );

                    $this->portfolioRepository->update( $portfolioEntity );

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
            else
            {
                $feedback = Validation::getInstance()->getReadableErrors();
                $feedbackType = 'danger';
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
                'feedback-type'  => $feedbackType ?? '',
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

        if ( Validation::getInstance()->validatePostParameters( $postParams, $this->portfolioFields ) && $request->getMethod() === 'POST' )
        {
            try
            {
                $newPortfolio = new Portfolio();
                $newPortfolio->setTitle( $postParams->getString( 'title' ) );
                $newPortfolio->setUrl( $postParams->getString( 'url' ) );
                $newPortfolio->setTheme( $this->themeRepository->getById( $postParams->getInt( 'themeId' ) ) );
                $newPortfolio->setStudent( $this->studentRepository->getById( (int)$postParams->get( 'userId' ) ) );

                $this->portfolioRepository->insert( $newPortfolio );

                $feedback = 'Het portfolio is toegevoegd.';
                $feedbackType = 'success';
            }
            catch ( \Exception $exception )
            {
                Debug::addException( $exception );
                $feedback = 'Er is iets fout gegaan, probeer later opnieuw.';
                $feedbackType = 'danger';
            }
        }
        else
        {
            $feedback = Validation::getInstance()->getReadableErrors();
            $feedbackType = 'danger';
        }

        return $this->createResponse(
            'admin:addPortfolio', [
                'feedback'      => $feedback ?? '',
                'feedback-type' => $feedbackType ?? '',
                'themes' => $this->themeRepository->getAll(),
                'students' => $this->studentRepository->getAll(),
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

        if ( !$this->isOwnOrAdmin( $skillEntity->getPortfolioId() ) )
        {
            $this->redirect( '401' );
        }

        if ( Validation::getInstance()->validatePostParameters( $postParams, $this->skillFields ) && $request->getMethod() === 'POST' )
        {
            try
            {
                $skillEntity->setName( $postParams->getString( 'name' ) );
                $skillEntity->setLevelOfExperience( $postParams->getInt( 'levelOfExperience' ) );

                $this->skillRepository->update( $skillEntity );

                $feedback = 'De vaardigheid is aangepast.';
                $feedbackType = 'success';
            }
            catch ( \Exception $exception )
            {
                Debug::addException( $exception );
                $feedback = 'Er is iets fout gegaan probeer later opnieuw.';
                $feedbackType = 'danger';
            }
        }
        else
        {
            $feedback = Validation::getInstance()->getReadableErrors();
            $feedbackType = 'danger';
        }

        return $this->createResponse(
            'admin:editSkill', [
                'skill-data'    => $skillEntity,
                'feedback'      => $feedback ?? '',
                'feedback-type' => $feedbackType ?? '',
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

        if ( !$this->isOwnOrAdmin( $trainingEntity->getPortfolioId() ) )
        {
            $this->redirect( '401' );
        }

        if ( Validation::getInstance()->validatePostParameters( $postParams, $this->trainingFields ) && $request->getMethod() === 'POST' )
        {
            try
            {
                $trainingEntity->setLocation( $postParams->getString( 'location' ) );
                $trainingEntity->setDescription( $postParams->getString( 'description' ) );
                $trainingEntity->setCurrentTraining( $postParams->getBoolean( 'currentTraining' ) );
                $trainingEntity->setFinishedAt( $postParams->getDateTime( 'finishedAt' ) );
                $trainingEntity->setInstitution( $postParams->getString( 'institution' ) );
                $trainingEntity->setObtainedCertificate( $postParams->getBoolean( 'obtainedCertificate' ) );
                $trainingEntity->setTitle( $postParams->getString( 'title' ) );

                $this->trainingRepository->update( $trainingEntity );

                $feedback = 'De opleiding is aangepast.';
                $feedbackType = 'success';
            }
            catch ( \Exception $exception )
            {
                Debug::addException( $exception );
                $feedback = 'Er is iets fout gegaan probeer later opnieuw.';
                $feedbackType = 'danger';
            }
        }
        else
        {
            $feedback = Validation::getInstance()->getReadableErrors();
            $feedbackType = 'danger';
        }

        return $this->createResponse(
            'admin:editTraining', [
                'training-data' => $trainingEntity,
                'feedback'      => $feedback ?? '',
                'feedback-type' => $feedbackType ?? '',
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

        if ( !$this->isOwnOrAdmin( $hobbyEntity->getPortfolioId() ) )
        {
            $this->redirect( '401' );
        }

        if ( Validation::getInstance()->validatePostParameters( $postParams, $this->hobbyFields ) && $request->getMethod() === 'POST' )
        {
            try
            {
                $hobbyEntity->setName( $postParams->getString( 'name' ) );

                $this->hobbyRepository->update( $hobbyEntity );

                $feedback = 'De hobby is aangepast.';
                $feedbackType = 'success';
            }
            catch ( \Exception $exception )
            {
                Debug::addException( $exception );
                $feedback = 'Er is iets fout gegaan probeer later opnieuw.';
                $feedbackType = 'danger';
            }
        }
        else
        {
            $feedback = Validation::getInstance()->getReadableErrors();
            $feedbackType = 'danger';
        }

        return $this->createResponse(
            'admin:editHobby', [
                'hobby-data'    => $hobbyEntity,
                'feedback'      => $feedback ?? '',
                'feedback-type' => $feedbackType ?? '',
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

        if ( !$this->isOwnOrAdmin( $languageEntity->getPortfolioId() ) )
        {
            $this->redirect( '401' );
        }

        if ( Validation::getInstance()->validatePostParameters( $postParams, $this->languageFields ) && $request->getMethod() === 'POST' )
        {
            try
            {
                $languageEntity->setIsNative( $postParams->getBoolean( 'isNative' ) );
                $languageEntity->setLanguage( $postParams->getString( 'language' ) );
                $languageEntity->setLevel( $postParams->getInt( 'level' ) );

                $this->languageRepository->update( $languageEntity );

                $feedback = 'De taal is aangepast.';
                $feedbackType = 'success';
            }
            catch ( \Exception $exception )
            {
                Debug::addException( $exception );
                $feedback = 'Er is iets fout gegaan probeer later opnieuw.';
                $feedbackType = 'danger';
            }
        }
        else
        {
            $feedback = Validation::getInstance()->getReadableErrors();
            $feedbackType = 'danger';
        }

        return $this->createResponse(
            'admin:editLanguage', [
                'language-data' => $languageEntity,
                'feedback'      => $feedback ?? '',
                'feedback-type' => $feedbackType ?? '',
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

        if ( !$this->isOwnOrAdmin( $slbAssignmentEntity->getPortfolioId() ) )
        {
            $this->redirect( '401' );
        }

        if ( Validation::getInstance()->validatePostParameters( $postParams, $this->slbAssignmentFields ) && $request->getMethod() === 'POST' )
        {
            try
            {
                $slbAssignmentEntity->setName( $postParams->getString( 'name' ) );
                //$slbAssignmentEntity->setFileName(  );
                // todo add code for fileupload.
                $slbAssignmentEntity->setFilePath( WEB_ROOT . 'files' . DIR_SEP );
                $slbAssignmentEntity->setMimeType( 'pdf' );

                $this->slbAssignmentRepository->insert( $slbAssignmentEntity );

                $feedback = 'De slb opdracht is aangepast.';
                $feedbackType = 'success';
            }
            catch ( \Exception $exception )
            {
                Debug::addException( $exception );
                $feedback = 'Er is iets fout gegaan probeer later opnieuw.';
                $feedbackType = 'danger';
            }
        }
        else
        {
            $feedback = Validation::getInstance()->getReadableErrors();
            $feedbackType = 'danger';
        }

        return $this->createResponse(
            'admin:editSlbAssignment', [
                'slbAssignment-data' => $slbAssignmentEntity,
                'feedback'           => $feedback ?? '',
                'feedback-type'      => $feedbackType ?? '',
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

        if ( !$this->isOwnOrAdmin( $imageEntity->getPortfolioId() ) )
        {
            $this->redirect( '401' );
        }

        if ( Validation::getInstance()->validatePostParameters( $postParams, $this->imageFields ) && $request->getMethod() === 'POST' )
        {
            try
            {
                $image->setDescription( $postParams->getString( 'description' ) );
                $image->setMimeType( 'jpg' );
                $image->setOrder( $postParams->getInt( 'order' ) );
                $image->setType( $postParams->getString( 'type' ) );

                $this->imageRepository->update( $image );
                $feedback = 'De afbeelding is aangepast.';
                $feedbackType = 'success';
            }
            catch ( \Exception $exception )
            {
                Debug::addException( $exception );
                $feedback = 'Er is iets fout gegaan probeer later opnieuw.';
                $feedbackType = 'danger';
            }
        }
        else
        {
            $feedback = Validation::getInstance()->getReadableErrors();
            $feedbackType = 'danger';
        }

        return $this->createResponse(
            'admin:editImage', [
                'image-data'    => $imageEntity,
                'feedback'      => $feedback ?? '',
                'feedback-type' => $feedbackType ?? '',
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

        if ( !$this->isOwnOrAdmin( $projectEntity->getPortfolioId() ) )
        {
            $this->redirect( '401' );
        }

        if ( Validation::getInstance()->validatePostParameters( $postParams, $this->projectFields ) && $request->getMethod() === 'POST' )
        {
            try
            {
                $projectEntity->setName( $postParams->getString( 'name' ) );
                $projectEntity->setDescription( $postParams->getString( 'description' ) );
                $projectEntity->setImage( $this->imageRepository->getById( $postParams->getInt( 'imageId' ) ) );
                $projectEntity->setLink( $postParams->getString( 'link' ) );

                $this->projectRepository->update( $projectEntity );

                $feedback = 'Het project is aangepast.';
                $feedbackType = 'success';
            }
            catch ( \Exception $exception )
            {
                Debug::addException( $exception );
                $feedback = 'Er is iets fout gegaan probeer later opnieuw.';
                $feedbackType = 'danger';
            }
        }
        else
        {
            $feedback = Validation::getInstance()->getReadableErrors();
            $feedbackType = 'danger';
        }

        return $this->createResponse(
            'admin:editProject', [
                'project-data'  => $projectEntity,
                'feedback'      => $feedback ?? '',
                'feedback-type' => $feedbackType ?? '',
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

        if ( !$this->isOwnOrAdmin( $jobExperienceEntity->getPortfolioId() ) )
        {
            $this->redirect( '401' );
        }

        if ( Validation::getInstance()->validatePostParameters( $postParams, $this->jobExperienceFields ) && $request->getMethod() === 'POST' )
        {
            try
            {
                $jobExperienceEntity->setDescription( $postParams->getString( 'description' ) );
                $jobExperienceEntity->setEndedAt( $postParams->getDateTime( 'endedAt' ) );
                $jobExperienceEntity->setIsInternship( $postParams->getBoolean( 'isInternship' ) );
                $jobExperienceEntity->setLocation( $postParams->getString( 'location' ) );
                $jobExperienceEntity->setStartedAt( $postParams->getDateTime( 'startedAt' ) );

                $this->jobExperienceRepository->insert( $jobExperienceEntity );
                $feedback = 'De werk ervaring is aangepast.';
                $feedbackType = 'success';
            }
            catch ( \Exception $exception )
            {
                Debug::addException( $exception );
                $feedback = 'Er is iets fout gegaan probeer later opnieuw.';
                $feedbackType = 'danger';
            }
        }
        else
        {
            $feedback = Validation::getInstance()->getReadableErrors();
            $feedbackType = 'danger';
        }

        return $this->createResponse(
            'admin:editJobExperience', [
                'project-data'  => $jobExperienceEntity,
                'feedback'      => $feedback ?? '',
                'feedback-type' => $feedbackType ?? '',
            ]
        );
    }

    /**
     * This method inserts an JobExperience in the database for the route /admin/addJobExperience/{$portfolioId}.
     *
     * @param Request $request
     * @param string  $jobExperienceId
     * @return Response
     */
    public function addJobExperience( Request $request, string $portfolioId ): Response
    {
        if ( !$this->isOwnOrAdmin( (int)$portfolioId ) )
        {
            $this->redirect( '/401' );
        }

        $postParams = $request->getPostParams();

        if ( Validation::getInstance()->validatePostParameters( $postParams, $this->jobExperienceFields ) && $request->getMethod() === 'POST' )
        {
            try
            {
                $jobExperienceEntity = new JobExperience();
                $jobExperienceEntity->setDescription( $postParams->getString( 'description' ) );
                $jobExperienceEntity->setEndedAt( $postParams->getDateTime( 'endedAt' ) );
                $jobExperienceEntity->setPortfolioId( (int)$portfolioId );
                $jobExperienceEntity->setIsInternship( $postParams->getBoolean( 'isInternship' ) );
                $jobExperienceEntity->setLocation( $postParams->getString( 'location' ) );
                $jobExperienceEntity->setStartedAt( $postParams->getDateTime( 'startedAt' ) );

                $this->jobExperienceRepository->insert( $jobExperienceEntity );
                $feedback = 'De werk ervaring is toegevoegd.';
                $feedbackType = 'success';
            }
            catch ( \Exception $exception )
            {
                Debug::addException( $exception );
                $feedback = 'Er is iets fout gegaan probeer later opnieuw.';
                $feedbackType = 'danger';
            }
        }
        elseif( $request->getMethod() === 'POST' )
        {
            $feedback = Validation::getInstance()->getReadableErrors();
            $feedbackType = 'danger';
        }

        return $this->createResponse(
            'admin:addJobExperience', [
                'feedback'      => $feedback ?? '',
                'feedback-type' => $feedbackType ?? '',
            ]
        );
    }

    /**
     * This method adds an skill in the database for the route /admin/addSkill.
     *
     * @param Request $request
     * @return Response
     */
    public function addSkill( Request $request, string $portfolioId ): Response
    {
        if ( !$this->isOwnOrAdmin( (int)$portfolioId ) )
        {
            $this->redirect( '/401' );
        }

        $postParams = $request->getPostParams();

        if ( Validation::getInstance()->validatePostParameters( $postParams, $this->skillFields ) && $request->getMethod() === 'POST' )
        {
            try
            {
                $skillEntity = new Skill();
                $skillEntity->setPortfolioId( $postParams->getInt( 'portfolioId' ) );
                $skillEntity->setName( $postParams->getString( 'name' ) );
                $skillEntity->setLevelOfExperience( $postParams->getInt( 'levelOfExperience' ) );

                $this->skillRepository->insert( $skillEntity );

                $feedback = 'De vaardigheid is toegevoegd.';
                $feedbackType = 'success';
            }
            catch ( \Exception $exception )
            {
                Debug::addException( $exception );
                $feedback = 'Er is iets fout gegaan probeer later opnieuw.';
                $feedbackType = 'danger';
            }
        }
        else
        {
            $feedback = Validation::getInstance()->getReadableErrors();
            $feedbackType = 'danger';
        }

        return $this->createResponse(
            'admin:addSkill', [
                'feedback'      => $feedback ?? '',
                'feedback-type' => $feedbackType ?? '',
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
    public function addTraining( Request $request, string $portfolioId ): Response
    {
        if ( !$this->isOwnOrAdmin( (int)$portfolioId ) )
        {
            $this->redirect( '/401' );
        }

        $postParams = $request->getPostParams();

        if ( Validation::getInstance()->validatePostParameters( $postParams, $this->trainingFields ) && $request->getMethod() === 'POST' )
        {
            try
            {
                $trainingEntity = new Training();
                $trainingEntity->setLocation( $postParams->getString( 'location' ) );
                $trainingEntity->setPortfolioId( (int)$portfolioId );
                $trainingEntity->setDescription( $postParams->getString( 'description' ) );
                $trainingEntity->setCurrentTraining( $postParams->getBoolean( 'currentTraining' ) );
                $trainingEntity->setFinishedAt( $postParams->getDateTime( 'finishedAt' ) );
                $trainingEntity->setStatedAt( $postParams->getDateTime( 'startedAt' ));
                $trainingEntity->setInstitution( $postParams->getString( 'institution' ) );
                $trainingEntity->setObtainedCertificate( $postParams->getBoolean( 'obtainedCertificate' ) );
                $trainingEntity->setTitle( $postParams->getString( 'title' ) );

                $this->trainingRepository->insert( $trainingEntity );

                $feedback = 'De opleiding is toegevoegd.';
                $feedbackType = 'success';
            }
            catch ( \Exception $exception )
            {
                Debug::addException( $exception );
                $feedback = 'Er is iets fout gegaan probeer later opnieuw.';
                $feedbackType = 'danger';
            }
        }
        elseif( $request->getMethod() === 'POST' )
        {
            $feedback = Validation::getInstance()->getReadableErrors();
            $feedbackType = 'danger';
        }

        return $this->createResponse(
            'admin:addTraining', [
                'feedback'      => $feedback ?? '',
                'feedback-type' => $feedbackType ?? '',
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
    public function addHobby( Request $request, string $portfolioId ): Response
    {
        if ( !$this->isOwnOrAdmin( (int)$portfolioId ) )
        {
            $this->redirect( '/401' );
        }

        $postParams = $request->getPostParams();

        if ( Validation::getInstance()->validatePostParameters( $postParams, $this->hobbyFields ) && $request->getMethod() === 'POST' )
        {
            try
            {
                $hobbyEntity = new Hobby();
                $hobbyEntity->setName( $postParams->getString( 'name' ) );
                $hobbyEntity->setPortfolio( (int)$portfolioId );

                $this->hobbyRepository->insert( $hobbyEntity );

                $feedback = 'De hobby is toegevoegd.';
                $feedbackType = 'success';
            }
            catch ( \Exception $exception )
            {
                Debug::addException( $exception );
                $feedback = 'Er is iets fout gegaan probeer later opnieuw.';
                $feedbackType = 'danger';
            }
        }
        elseif( $request->getMethod() === 'POST' )
        {
            $feedback = Validation::getInstance()->getReadableErrors();
            $feedbackType = 'danger';
        }

        return $this->createResponse(
            'admin:addHobby', [
                'feedback'      => $feedback ?? '',
                'feedback-type' => $feedbackType ?? '',
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
    public function addLanguage( Request $request, string $portfolioId ): Response
    {
        if ( !$this->isOwnOrAdmin( (int)$portfolioId ) )
        {
            $this->redirect( '/401' );
        }

        $postParams = $request->getPostParams();

        if ( Validation::getInstance()->validatePostParameters( $postParams, $this->trainingFields ) && $request->getMethod() === 'POST' )
        {
            try
            {
                $languageEntity = new Language();
                $languageEntity->setIsNative( $postParams->getBoolean( 'isNative' ) );
                $languageEntity->setLanguage( $postParams->getString( 'language' ) );
                $languageEntity->setLevel( $postParams->getInt( 'level' ) );
                $languageEntity->setPortfolioId( (int)$portfolioId );

                $this->languageRepository->insert( $languageEntity );

                $feedback = 'De taal is toegevoegd.';
                $feedbackType = 'success';
            }
            catch ( \Exception $exception )
            {
                Debug::addException( $exception );
                $feedback = 'Er is iets fout gegaan probeer later opnieuw.';
                $feedbackType = 'danger';
            }
        }
        elseif( $request->getMethod() === 'POST' )
        {
            $feedback = Validation::getInstance()->getReadableErrors();
            $feedbackType = 'danger';
        }

        return $this->createResponse(
            'admin:addLanguage', [
                'feedback'      => $feedback ?? '',
                'feedback-type' => $feedbackType ?? '',
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
    public function addSlbAssignment( Request $request, string $portfolioId ): Response
    {
        if ( !$this->isOwnOrAdmin( (int)$portfolioId ) )
        {
            $this->redirect( '/401' );
        }

        $postParams = $request->getPostParams();

        if ( Validation::getInstance()->validatePostParameters( $postParams, $this->trainingFields ) && $request->getMethod() === 'POST' )
        {
            try
            {
                $slbAssignmentEntity = new SLBAssignment();
                $slbAssignmentEntity->setName( $postParams->getString( 'name' ) );
                //$slbAssignmentEntity->setFileName(  );
                // todo add code for fileupload.
                $slbAssignmentEntity->setFilePath( WEB_ROOT . 'files' . DIR_SEP );
                $slbAssignmentEntity->setMimeType( 'pdf' );

                $this->slbAssignmentRepository->insert( $slbAssignmentEntity );
                $feedback = 'De slb opdracht is toegevoegd.';
                $feedbackType = 'success';
            }
            catch ( \Exception $exception )
            {
                Debug::addException( $exception );
                $feedback = 'Er is iets fout gegaan probeer later opnieuw.';
                $feedbackType = 'danger';
            }
        }
        elseif( $request->getMethod() === 'POST' )
        {
            $feedback = Validation::getInstance()->getReadableErrors();
            $feedbackType = 'danger';
        }

        return $this->createResponse(
            'admin:addSlbAssignment', [
                'feedback'      => $feedback ?? '',
                'feedback-type' => $feedbackType ?? '',
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
    public function addImage( Request $request, string $portfolioId ): Response
    {
        if ( !$this->isOwnOrAdmin( (int)$portfolioId ) )
        {
            $this->redirect( '/401' );
        }

        $postParams = $request->getPostParams();

        if ( Validation::getInstance()->validatePostParameters( $postParams, $this->trainingFields ) && $request->getMethod() === 'POST' )
        {
            try
            {
                $image = new Image();
                $image->setPortfolioId( (int)$portfolioId );
                $image->setDescription( $postParams->getString( 'description' ) );
                $image->setMimeType( 'jpg' );
                $image->setFileName( 'somefile' );
                $image->setOrder( $postParams->getInt( 'order' ) );
                $image->setType( $postParams->getString( 'type' ) );

                $this->imageRepository->insert( $image );

                $feedback = 'De afbeelding is toegevoegd.';
                $feedbackType = 'success';
            }
            catch ( \Exception $exception )
            {
                Debug::addException( $exception );
                $feedback = 'Er is iets fout gegaan probeer later opnieuw.';
                $feedbackType = 'danger';
            }
        }
        elseif( $request->getMethod() === 'POST' )
        {
            $feedback = Validation::getInstance()->getReadableErrors();
            $feedbackType = 'danger';
        }

        return $this->createResponse(
            'admin:addImage', [
                'feedback'      => $feedback ?? '',
                'feedback-type' => $feedbackType ?? '',
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
    public function addProject( Request $request, string $portfolioId ): Response
    {
        if ( !$this->isOwnOrAdmin( (int)$portfolioId ) )
        {
            $this->redirect( '/401' );
        }

        $postParams = $request->getPostParams();

        if ( Validation::getInstance()->validatePostParameters( $postParams, $this->trainingFields ) && $request->getMethod() === 'POST' )
        {
            try
            {
                $projectEntity = new Project();
                $projectEntity->setName( $postParams->getString( 'name' ) );
                $projectEntity->setDescription( $postParams->getString( 'description' ) );
                $projectEntity->setImage( $this->imageRepository->getById( $postParams->getInt( 'imageId' ) ) );
                $projectEntity->setLink( $postParams->getString( 'link' ) );
                $projectEntity->setPortfolioId( (int)$portfolioId );

                $this->projectRepository->insert( $projectEntity );
                $feedback = 'Het project is toegevoegd.';
                $feedbackType = 'success';
            }
            catch ( \Exception $exception )
            {
                Debug::addException( $exception );
                $feedback = 'Er is iets fout gegaan probeer later opnieuw.';
                $feedbackType = 'danger';
            }
        }
        elseif( $request->getMethod() === 'POST' )
        {
            $feedback = Validation::getInstance()->getReadableErrors();
            $feedbackType = 'danger';
        }

        return $this->createResponse(
            'admin:addProject', [
                'feedback'      => $feedback ?? '',
                'feedback-type' => $feedbackType ?? '',
                'images'        => $this->imageRepository->findByCondition( 'WHERE portfolioId = :wherePortfolioId', [ ':wherePortfolioId' => (int)$portfolioId ] ),
            ]
        );
    }
}
