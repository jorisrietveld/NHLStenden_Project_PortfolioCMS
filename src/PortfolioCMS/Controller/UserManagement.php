<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 10-01-2017 14:45
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Controller;


use StendenINF1B\PortfolioCMS\Kernel\BaseController;
use StendenINF1B\PortfolioCMS\Kernel\Database\Entity\Student;
use StendenINF1B\PortfolioCMS\Kernel\Database\Entity\Teacher;
use StendenINF1B\PortfolioCMS\Kernel\Database\Repository\StudentRepository;
use StendenINF1B\PortfolioCMS\Kernel\Database\Repository\TeacherRepository;
use StendenINF1B\PortfolioCMS\Kernel\Helper\ConfigLoader;
use StendenINF1B\PortfolioCMS\Kernel\Http\Request;
use StendenINF1B\PortfolioCMS\Kernel\Http\Response;
use StendenINF1B\PortfolioCMS\Kernel\TemplateEngine\TemplateEngine;

class UserManagement extends BaseController
{
    /**
     * @var array
     */
    protected $requiredUserFields = [
        'password',
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
        'isSLBer'
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

    public function index( Request $request )
    {

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

            return new Response(
                $this->renderWebPage(
                    '', [

                    ]
                )
            );

        }
        else
        {
            //
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

            return new Response(
                $this->renderWebPage(
                    '', [

                    ]
                )
            );
        }
        else
        {

        }
    }

    /**
     * Updates an student in the database.
     *
     * @param Request $request
     */
    public function editStudent( Request $request ) : Response
    {
        $postParams = $request->getPostParams();

        if ( $this->checkPostParams( $postParams, array_merge( $this->requiredUserFields, $this->requiredStudentFields, [ 'id' ] ) ) )
        {
            $updatedStudent = new Student();
            $updatedStudent->setId( $postParams->getInt( 'id' ) );
            $updatedStudent->setHashedPassword( password_hash( $postParams->getString( 'password' ), PASSWORD_BCRYPT ) );
            $updatedStudent->setEmail( $postParams->getString( 'email' ) );
            $updatedStudent->setLastIpAddress( $request->getClientIp() );
            $updatedStudent->setFirstName( $postParams->getString( 'firstName' ) );
            $updatedStudent->setLastName( $postParams->getString( 'lastName' ) );
            $updatedStudent->setIsAdmin( $postParams->getBoolean( 'isAdmin' ) );
            $updatedStudent->setAddress( $postParams->getString( 'address' ) );
            $updatedStudent->setZipCode( $postParams->getString( 'zipCode' ) );
            $updatedStudent->setLocation( $postParams->getString( 'location' ) );
            $updatedStudent->setDateOfBirth( $postParams->getDateTime( 'dateOfBirth' ) );
            $updatedStudent->setStudentCode( $postParams->getString( 'studentCode' ) );
            $updatedStudent->setPhoneNumber( $postParams->getString( 'phoneNumber' ) );

            $this->studentRepository->update( $updatedStudent );
        }

    }

    /**
     * Updates an teacher in the database.
     *
     * @param Request $request
     */
    public function editTeacher( Request $request ) : Response
    {
        $postParams = $request->getPostParams();

        if ( $this->checkPostParams( $postParams, array_merge( $this->requiredUserFields, $this->requiredTeacherFields, [ 'id' ] ) ) )
        {
            $updatedTeacher = new Teacher();
            $updatedTeacher->setId( $postParams->getInt( 'id' ) );
            $updatedTeacher->setLastName( $postParams->getString( 'lastName' ) );
            $updatedTeacher->setFirstName( $postParams->getString( 'firstName' ) );
            $updatedTeacher->setEmail( $postParams->getString( 'email' ) );
            $updatedTeacher->setHashedPassword( password_hash( $postParams->get( 'password' ), PASSWORD_BCRYPT ) );
            $updatedTeacher->setIsSLBer( $postParams->getBoolean( 'isSlber' ) );
            $updatedTeacher->setIsAdmin( $postParams->getBoolean( 'isAdmin' ) );

            $this->teacherRepository->update( $updatedTeacher );
        }
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
        }
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
        }
    }

}
