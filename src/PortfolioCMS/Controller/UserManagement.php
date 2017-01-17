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
use StendenINF1B\PortfolioCMS\Kernel\Http\Request;
use StendenINF1B\PortfolioCMS\Kernel\Http\Response;
use StendenINF1B\PortfolioCMS\Kernel\TemplateEngine\TemplateEngine;

class UserManagement extends BaseController
{
    /**
     * @var array
     */
    protected $requiredUserFields = [
        'email',
        'firstName',
        'lastName',
        'isAdmin',
    ];

    /**
     * @var array
     */
    protected $requiredStudentFields = [
        'address',
        'zipCode',
        'dateOfBirth',
        'studentCode',
        'phoneNumber',
    ];

    /**
     * @var array
     */
    protected $requiredTeacherFields = [
        'isSLBer',
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

    public function userOverview( Request $request )
    {
        $students = $this->studentRepository->getAll();
        $teachers = $this->teacherRepository->getAll();

        $users = $students->mergeWith( $teachers );

        return $this->createResponse( 'admin:gebruikersOverzicht', [
            'asset-path' => $request->getBaseUri() . 'assets/admin/',
            'users'      => $users,
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

        if ( $this->checkPostParams( $postParams, array_merge( $this->requiredUserFields, $this->requiredStudentFields ) ) )
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

            // Insert the new student.
            $this->studentRepository->insert( $newStudent );

            return $this->createResponse( 'admin:addStudent', [
                    'asset-path' => $request->getBaseUri() . 'assets/admin/',
                ]
            );
        }
        else
        {
            return $this->createResponse( 'admin:addStudent', [
                    'asset-path' => $request->getBaseUri() . 'assets/admin/',
                ]
            );
        }
    }

    /**
     * Method to insert an new teacher into the database.
     *
     * @param Request $request
     */
    public function insertTeacher( Request $request ) : Response
    {
        $postParams = $request->getPostParams();

        if ( $this->checkPostParams( $postParams, array_merge( $this->requiredUserFields, $this->requiredTeacherFields ) ) )
        {
            $newTeacher = new Teacher();
            $newTeacher->setId( $postParams->getInt( 'id' ) );
            $newTeacher->setLastName( $postParams->getString( 'lastName' ) );
            $newTeacher->setFirstName( $postParams->getString( 'firstName' ) );
            $newTeacher->setEmail( $postParams->getString( 'email' ) );
            $newTeacher->setHashedPassword( password_hash( $postParams->get( 'password' ), PASSWORD_BCRYPT ) );
            $newTeacher->setIsSLBer( $postParams->getBoolean( 'isSlber' ) );
            $newTeacher->setIsAdmin( $postParams->getBoolean( 'isAdmin' ) );

            $this->teacherRepository->insert( $newTeacher );

            return $this->createResponse( 'admin:addTeacher', [
                    'asset-path' => $request->getBaseUri() . 'assets/admin/',
                ]
            );
        }
        else
        {
            return $this->createResponse( 'admin:addTeacher', [
                    'asset-path' => $request->getBaseUri() . 'assets/admin/',
                ]
            );
        }
    }

    /**
     * Updates an student in the database.
     *
     * @param Request $request
     */
    public function editStudent( Request $request, string $id = '' ) : Response
    {
        // Check if the user is allowed to edit the account.
        if( $id != $_SESSION['userId'] && $_SESSION['authorizationLevel'] !== AuthorizedUser::ADMIN  )
        {
            $this->redirect( '/401' );
        }

        $currentStudent = $this->studentRepository->getById( (int)$id );
        $postParams = $request->getPostParams();

        if ( $this->checkPostParams( $postParams, array_merge( $this->requiredUserFields, $this->requiredStudentFields, [ 'id' ] ) ) )
        {
            $feedback = 'Het account is aangepast.';

            $updatedStudent = new Student();
            $updatedStudent->setId( $postParams->getInt( 'id' ) );
            $updatedStudent->setEmail( $postParams->getString( 'email' ) );
            $updatedStudent->setFirstName( $postParams->getString( 'firstName' ) );
            $updatedStudent->setLastName( $postParams->getString( 'lastName' ) );
            $updatedStudent->setAddress( $postParams->getString( 'address' ) );
            $updatedStudent->setZipCode( $postParams->getString( 'zipCode' ) );
            $updatedStudent->setLocation( $postParams->getString( 'location' ) );
            $updatedStudent->setDateOfBirth( $postParams->getDateTime( 'dateOfBirth' ) );
            $updatedStudent->setStudentCode( $postParams->getString( 'studentCode' ) );
            $updatedStudent->setPhoneNumber( $postParams->getString( 'phoneNumber' ) );

            if ( $_SESSION[ 'authorizationLevel' ] == AuthorizedUser::ADMIN )
            {
                $updatedStudent->setIsAdmin( $postParams->getBoolean( 'isAdmin' ) );
            }

            if ( $postParams->has( 'password' ) && $postParams->has( 'passwordRepeat' ) )
            {
                if ( $newPassword = $this->updatePassword( $postParams->getString( 'password' ), $postParams->getString( 'passwordRepeat' ) ) )
                {
                    $updatedStudent->setHashedPassword( $newPassword );
                }
                else
                {
                    $feedback = 'Het wachtwoord is incorrect.';
                }
            }

            $updatedStudent = $this->studentRepository->update( $updatedStudent );

            return $this->createResponse( 'admin:editStudent', [
                    'asset-path'   => $request->getBaseUri() . 'assets/admin/',
                    'student-data' => $updatedStudent,
                    'feedback'     => $feedback,
                ]
            );
        }

        return $this->createResponse( 'admin:editStudent', [
                'asset-path'   => $request->getBaseUri() . 'assets/admin/',
                'student-data' => ( $currentStudent->getId() !== 0 ) ? $currentStudent : NULL,
                'feedback'     => ( $currentStudent->getId() !== 0 ) ? '' : 'De student bestaat niet.',
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
        // Check if the user is allowed to edit the account.
        if( $id != $_SESSION['userId'] && $_SESSION['authorizationLevel'] !== AuthorizedUser::ADMIN  )
        {
            $this->redirect( '/401' );
        }

        $currentTeacher = $this->teacherRepository->getById( (int)$id );
        $postParams = $request->getPostParams();

        if ( $this->checkPostParams( $postParams, array_merge( $this->requiredUserFields, $this->requiredTeacherFields, [ 'id' ] ) ) )
        {
            $feedback = 'Het account is aangepast.';
            $updatedTeacher = new Teacher();
            $updatedTeacher->setId( $postParams->getInt( 'id' ) );
            $updatedTeacher->setLastName( $postParams->getString( 'lastName' ) );
            $updatedTeacher->setFirstName( $postParams->getString( 'firstName' ) );
            $updatedTeacher->setEmail( $postParams->getString( 'email' ) );

            if ( $_SESSION[ 'authorizationLevel' ] == AuthorizedUser::ADMIN )
            {
                $updatedTeacher->setIsSLBer( $postParams->getBoolean( 'isSlber' ) );
                $updatedTeacher->setIsAdmin( $postParams->getBoolean( 'isAdmin' ) );
            }

            if ( $postParams->has( 'password' ) && $postParams->has( 'passwordRepeat' ) )
            {
                if ( $newPassword = $this->updatePassword( $postParams->getString( 'password' ), $postParams->getString( 'passwordRepeat' ) ) )
                {
                    $updatedTeacher->setHashedPassword( $newPassword );
                }
                else
                {
                    $feedback = 'Het wachtwoord is incorrect.';
                }
            }

            // Update the teacher.
            $updatedTeacher = $this->teacherRepository->update( $updatedTeacher );

            return $this->createResponse( 'admin:editTeacher', [
                    'asset-path' => $request->getBaseUri() . 'assets/admin/',
                    'teacher-data' => $updatedTeacher,
                    'feedback'     => $feedback,
                ]
            );
        }

        return $this->createResponse( 'admin:editTeacher', [
                'asset-path' => $request->getBaseUri() . 'assets/admin/',
                'teacher-data' => $currentTeacher,
                'feedback'     => ( $currentTeacher->getId() !== 0 ) ? '' : 'De student bestaat niet.',
            ]
        );
    }

    /**
     * Deletes an student from the database.
     *
     * @param Request $request
     */
    public function deleteStudent( Request $request ) : Response
    {
        $postParams = $request->getPostParams();

        if ( $this->checkPostParams( $postParams, [ 'id' ] ) )
        {
            $this->studentRepository->delete( $postParams->getInt( 'id' ) );

            return new Response(
                $this->renderWebPage(
                    '', [

                    ]
                )
            );
        }

        return new Response(
            $this->renderWebPage(
                '', [

                ]
            )
        );
    }

    /**
     * Deletes an teacher from the database.
     *
     * @param Request $request
     */
    public function deleteTeacher( Request $request ) : Response
    {
        $postParams = $request->getPostParams();

        if ( $this->checkPostParams( $postParams, [ 'id' ] ) )
        {
            $this->teacherRepository->delete( $postParams->getInt( 'id' ) );

            return new Response(
                $this->renderWebPage(
                    '', [

                    ]
                )
            );
        }

        return new Response(
            $this->renderWebPage(
                '', [

                ]
            )
        );
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
