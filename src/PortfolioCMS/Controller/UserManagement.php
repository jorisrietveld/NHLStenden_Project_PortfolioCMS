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
use StendenINF1B\PortfolioCMS\Kernel\Database\Entity\Student;
use StendenINF1B\PortfolioCMS\Kernel\Database\Entity\Teacher;
use StendenINF1B\PortfolioCMS\Kernel\Database\Repository\StudentRepository;
use StendenINF1B\PortfolioCMS\Kernel\Database\Repository\TeacherRepository;
use StendenINF1B\PortfolioCMS\Kernel\Helper\ConfigLoader;
use StendenINF1B\PortfolioCMS\Kernel\Helper\Validate;
use StendenINF1B\PortfolioCMS\Kernel\Helper\Validation;
use StendenINF1B\PortfolioCMS\Kernel\Http\Request;
use StendenINF1B\PortfolioCMS\Kernel\Http\Response;
use StendenINF1B\PortfolioCMS\Kernel\TemplateEngine\TemplateEngine;

class UserManagement extends BaseController
{
    use SiteHelper;
    /**
     * @var array
     */
    protected $userFields = [
        'email'     => 'required|email',
        'firstName' => 'required|alpha_space|min_length,3|max_length,50',
        'lastName'  => 'required|alpha_space|min_length,3|max_length,50',
        'isAdmin'   => 'required',
    ];

    /**
     * @var array
     */
    protected $studentFields = [
        'address'     => 'required|alpha_space|min_length,3|max_length,50',
        'zipCode'     => 'required|zip_code',
        'dateOfBirth' => 'required|date,Y-m-d',
        'studentCode' => 'required|numeric',
        'phoneNumber' => 'required|phone_number',
    ];

    /**
     * @var array
     */
    protected $teacherFields = [
        'isSLBer' => 'required',
    ];

    /**
     * @var TeacherRepository
     */
    protected $teacherRepository;

    /**
     * @var StudentRepository
     */
    protected $studentRepository;

    /**
     * UserManagement constructor.
     *
     * @param TemplateEngine $templateEngine
     * @param ConfigLoader   $configLoader
     */
    public function __construct( TemplateEngine $templateEngine, ConfigLoader $configLoader )
    {
        parent::__construct( $templateEngine, $configLoader );

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
            'portfolio-meta-data' => $this->getPortfoliosMetadata(),
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
     * Page that shows an overview of all users for the route /admin/gebruikersOverzicht
     *
     * @param Request $request
     * @return Response
     */
    public function userOverview( Request $request )
    {
        $students = $this->studentRepository->getAll();
        $teachers = $this->teacherRepository->getAll();

        $users = $students->mergeWith( $teachers );

        return $this->createResponse( 'admin:gebruikersOverzicht', [
            'users' => $users,
        ] );
    }

    /**
     * Inserts an new student into the database.
     *
     * @param Request $request
     * @return Response
     */
    public function insertStudent( Request $request ) : Response
    {
        $postParams = $request->getPostParams();
        if ( Validation::getInstance()->validatePostParameters( $postParams, array_merge( $this->userFields, $this->studentFields ) ) && $request->getMethod() == 'POST' )
        {
            $newStudent = new Student();
            $newStudent->setHashedPassword( password_hash( $postParams->getString( 'password' ), PASSWORD_BCRYPT ) );
            $newStudent->setEmail( $postParams->getString( 'email' ) );
            $newStudent->setLastIpAddress( $request->getClientIp() );
            $newStudent->setFirstName( $postParams->getString( 'firstName' ) );
            $newStudent->setLastName( $postParams->getString( 'lastName' ) );
            $newStudent->setIsAdmin( $postParams->getBoolean( 'isAdmin' ) );
            $newStudent->setAddress( $postParams->getString( 'address' ) );
            $newStudent->setZipCode( $postParams->getString( 'zipCode' ) );
            $newStudent->setLocation( $postParams->getString( 'location' ) );
            $newStudent->setDateOfBirth( $postParams->getDateTime( 'dateOfBirth' ) );
            $newStudent->setStudentCode( $postParams->getString( 'studentCode' ) );
            $newStudent->setPhoneNumber( $postParams->getString( 'phoneNumber' ) );
            $newStudent->setLastIpAddress( $request->getClientIp() );
            $newStudent->setActive(  $postParams->getBoolean( 'isActive' ));

            // Insert the new student.
            $this->studentRepository->insert( $newStudent );

            $feedback = 'De student is toegevoegd.';
            $feedbackType = 'success';
        }
        elseif( $request->getMethod() === 'POST' )
        {
            $feedback = Validation::getInstance()->getReadableErrors();
            $feedbackType = 'danger';
        }

        return $this->createResponse( 'admin:addStudent', [
                'feedback' => $feedback ?? '',
                'feedback-type' => $feedbackType ?? '',
            ]
        );

    }

    /**
     * Method to insert an new teacher into the database.
     *
     * @param Request $request
     */
    public function insertTeacher( Request $request ) : Response
    {
        $postParams = $request->getPostParams();

        if ( Validation::getInstance()->validatePostParameters( $postParams, array_merge( $this->userFields, $this->teacherFields ) ) && $request->getMethod() === 'POST' )
        {
            $newTeacher = new Teacher();
            $newTeacher->setId( $postParams->getInt( 'id' ) );
            $newTeacher->setLastName( $postParams->getString( 'lastName' ) );
            $newTeacher->setFirstName( $postParams->getString( 'firstName' ) );
            $newTeacher->setEmail( $postParams->getString( 'email' ) );
            $newTeacher->setHashedPassword( password_hash( $postParams->get( 'password' ), PASSWORD_BCRYPT ) );
            $newTeacher->setIsSLBer( $postParams->getBoolean( 'isSlber' ) );
            $newTeacher->setIsAdmin( $postParams->getBoolean( 'isAdmin' ) );
            $newTeacher->setLastIpAddress( $request->getClientIp() );
            $newTeacher->setActive(  $postParams->getBoolean( 'isActive' ));

            $this->teacherRepository->insert( $newTeacher );
            $feedback = 'De docent is toegevoegd';
            $feedbackType = 'success';
        }
        elseif( $request->getMethod() === 'POST' )
        {
            $feedback = Validation::getInstance()->getReadableErrors();
            $feedbackType = 'danger';
        }

        return $this->createResponse( 'admin:addTeacher', [
                'feedback' => $feedback ?? '',
                'feedback-type' => $feedbackType ?? '',
            ]
        );

    }

    /**
     * Updates an student in the database.
     *
     * @param Request $request
     */
    public function editStudent( Request $request, string $id = '' ) : Response
    {
        if ( !$studentEntity = $this->studentRepository->getById( (int)$id ) )
        {
            $this->redirect( '/404' );
        }

        if ( !$this->isOwnOrAdmin( (int)$id ) )
        {
            $this->redirect( '/401' );
        }

        $postParams = $request->getPostParams();
        if ( Validation::getInstance()->validatePostParameters( $postParams, array_merge( $this->userFields, $this->studentFields ) ) && $request->getMethod() === 'POST' )
        {
            $feedback = 'Het account is aangepast.';
            $feedbackType = 'success';
            $studentEntity->setEmail( $postParams->getString( 'email' ) );
            $studentEntity->setFirstName( $postParams->getString( 'firstName' ) );
            $studentEntity->setLastName( $postParams->getString( 'lastName' ) );
            $studentEntity->setAddress( $postParams->getString( 'address' ) );
            $studentEntity->setZipCode( $postParams->getString( 'zipCode' ) );
            $studentEntity->setLocation( $postParams->getString( 'location' ) );
            $studentEntity->setDateOfBirth( $postParams->getDateTime( 'dateOfBirth' ) );
            $studentEntity->setStudentCode( $postParams->getString( 'studentCode' ) );
            $studentEntity->setPhoneNumber( $postParams->getString( 'phoneNumber' ) );

            if ( $_SESSION[ 'authorizationLevel' ] == AuthorizedUser::ADMIN )
            {
                $studentEntity->setIsAdmin( (bool)$postParams->get( 'isAdmin' ) );
            }

            if ( $postParams->has( 'password' ) && $postParams->has( 'passwordRepeat' ) )
            {
                if ( $newPassword = $this->updatePassword( $postParams->getString( 'password' ), $postParams->getString( 'passwordRepeat' ) ) )
                {
                    $studentEntity->setHashedPassword( $newPassword );
                }
                else
                {
                    $feedback .= '<br>Maar niet alles is geupdate: Het wachtwoord is incorrect.';
                    $feedbackType = 'warning';
                }
            }

            $studentEntity = $this->studentRepository->update( $studentEntity );
        }
        elseif( $request->getMethod() === 'POST' )
        {
            $feedback = Validation::getInstance()->getReadableErrors();
            $feedbackType = 'danger';
        }

        return $this->createResponse( 'admin:editStudent', [
                'student-data' => $studentEntity,
                'feedback'     => $feedback ?? '',
                'feedback-type' => $feedbackType ?? '',
            ]
        );

    }

    /**
     * Updates an teacher in the database.
     *
     * @param Request $request
     */
    public function editTeacher( Request $request, string $id = '' ) : Response
    {
        if ( !$teacherEntity = $this->teacherRepository->getById( (int)$id ) )
        {
            $this->redirect( '/404' );
        }

        if ( !$this->isOwnOrAdmin( (int)$id ) )
        {
            $this->redirect( '/401' );
        }

        $postParams = $request->getPostParams();

        if ( Validation::getInstance()->validatePostParameters( $postParams, array_merge( $this->userFields, $this->teacherFields ) )&& $request->getMethod() === 'POST'  )
        {
            $feedback = 'Het account is aangepast.';
            $feedbackType = 'success';

            $teacherEntity->setId( (int)$id );
            $teacherEntity->setLastName( $postParams->getString( 'lastName' ) );
            $teacherEntity->setFirstName( $postParams->getString( 'firstName' ) );
            $teacherEntity->setEmail( $postParams->getString( 'email' ) );

            if ( $_SESSION[ 'authorizationLevel' ] == AuthorizedUser::ADMIN )
            {
                $teacherEntity->setIsSLBer( $postParams->getBoolean( 'isSlber' ) );
                $teacherEntity->setIsAdmin( $postParams->getBoolean( 'isAdmin' ) );
            }

            if ( $postParams->has( 'password' ) && $postParams->has( 'passwordRepeat' ) )
            {
                if ( $newPassword = $this->updatePassword( $postParams->getString( 'password' ), $postParams->getString( 'passwordRepeat' ) ) )
                {
                    $teacherEntity->setHashedPassword( $newPassword );
                }
                else
                {
                    $feedback .= '<br>Maar niet alles is geupdate: Het wachtwoord is incorrect.';
                    $feedbackType = 'warning';
                }
            }
            // Update the teacher.
            $teacherEntity = $this->teacherRepository->update( $teacherEntity );
        }
        elseif( $request->getMethod() === 'POST' )
        {
            $feedback = Validation::getInstance()->getReadableErrors();
            $feedbackType = 'danger';
        }

        return $this->createResponse( 'admin:editTeacher', [
                'teacher-data' => $updatedTeacher ?? $teacherEntity,
                'feedback'     => $feedback ?? '',
                'feedback-type' => $feedbackType ?? '',
            ]
        );
    }

    /**
     * Deletes an student from the database.
     *
     * @param Request $request
     */
    public function deleteStudent( Request $request, string $id )
    {
        if ( !$studentEntity = $this->studentRepository->getById( (int)$id ) )
        {
            $this->redirect( '/404' );
        }

        if ( $_SESSION[ 'authorizationLevel' ] == AuthorizedUser::ADMIN )
        {
            $this->redirect( '/401' );
        }

        $postParams = $request->getPostParams();

        if ( $this->checkPostParams( $postParams, [ 'confirm' ] ) )
        {
            $this->studentRepository->delete( $postParams->getInt( 'id' ) );
        }
        $this->redirect( '/admin/gebruikersOverzicht' );
    }

    /**
     * Deletes an teacher from the database.
     *
     * @param Request $request
     */
    public function deleteTeacher( Request $request, string $id )
    {
        if ( !$teacherEntity = $this->teacherRepository->getById( (int)$id ) )
        {
            $this->redirect( '/404' );
        }

        if ( $_SESSION[ 'authorizationLevel' ] == AuthorizedUser::ADMIN )
        {
            $this->redirect( '/401' );
        }

        $postParams = $request->getPostParams();

        if ( $this->checkPostParams( $postParams, [ 'confirm' ] ) )
        {
            $this->studentRepository->delete( $postParams->getInt( 'id' ) );
        }
        $this->redirect( '/admin/gebruikersOverzicht' );
    }

    protected function updatePassword( string $password, string $secondPassword )
    {
        if ( Validate::password( $password, $secondPassword ) )
        {
            return password_hash( $password, PASSWORD_BCRYPT );
        }
        return FALSE;
    }

}
