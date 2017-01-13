<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 10-01-2017 14:45
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Controller;


use StendenINF1B\PortfolioCMS\Kernel\BaseController;
use StendenINF1B\PortfolioCMS\Kernel\Database\Entity\Teacher;
use StendenINF1B\PortfolioCMS\Kernel\Database\Entity\Student;
use StendenINF1B\PortfolioCMS\Kernel\Http\Request;
use StendenINF1B\PortfolioCMS\Kernel\Http\Response;

class UserManagement extends BaseController 
{
    protected $requiredInsertUserFields = [
        'password',
        'email',
        'firstName',
        'lastName',
        'isAdmin',
    ];

    protected $requiredInsertStudentFields = [
        'address',
        'zipCode',
        'dateOfBirth',
        'studentCode',
        'phoneNumber',
    ];

    protected $requiredInsertTeacherFields = [
        'isSLBer'
    ];

    public function index( Request $request )
    {
        
    }

    /**
     * Inserts an new student into the database.
     *
     * @param Request $request
     * @return Response
     */
    public function insertStudent( Request $request )
    {
        $postParams = $request->getPostParams();

        if ( $this->checkPostParams( $postParams, array_merge( $this->requiredInsertUserFields, $this->requiredInsertStudentFields ) ) )
        {
            $studentRepo = $this->getEntityManager()->getRepository( 'Student' );
            $newStudent = new Student();

            $newStudent->setHashedPassword( password_hash( $postParams->get( 'password' ), PASSWORD_BCRYPT ) );
            $newStudent->setEmail( (string)$postParams->get( 'email' ) );
            $newStudent->setLastIpAddress( $request->getClientIp() );
            $newStudent->setFirstName( (string)$postParams->get( 'firstName' ) );
            $newStudent->setLastName( (string)$postParams->get( 'lastName' ) );
            $newStudent->setIsAdmin( (bool)$postParams->get( 'isAdmin' ) );
            $newStudent->setAddress( (string)$postParams->get( 'address' ) );
            $newStudent->setZipCode( (string)$postParams->get( 'zipCode' ) );
            $newStudent->setLocation( (string)$postParams->get( 'location' ) );
            $newStudent->setDateOfBirth( new \DateTime( $postParams->get( 'dateOfBirth' ) ) );
            $newStudent->setStudentCode( (string)$postParams->get( 'studentCode' ) );
            $newStudent->setPhoneNumber( (string)$postParams->get( 'phoneNumber' ) );

            // Insert the new student.
            $studentRepo->insert( $newStudent );

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
    protected function insertTeacher( Request $request )
    {
        $postParams =  $request->getPostParams();

        if ( $this->checkPostParams( $postParams, array_merge( $this->requiredInsertUserFields, $this->requiredInsertTeacherFields ) ) )
        {
            $teacherRepo = $this->getEntityManager()->getRepository( 'Teacher' );

            $newTeacher =  new Teacher();
            $newTeacher->setLastName( (string)$postParams->get( 'lastName' ) );
            $newTeacher->setFirstName( (string)$postParams->get('firstName' ) );
            $newTeacher->setEmail( (string)$postParams->get( 'email' ));
            $newTeacher->setHashedPassword( password_hash( $postParams->get('password'), PASSWORD_BCRYPT ));
            $newTeacher->setIsSLBer( (bool) $postParams->get('isSlber') );
            $newTeacher->setIsAdmin( (bool)  $postParams->get( 'isAdmin' ) );

            $teacherRepo->insert( $newTeacher );

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
}
