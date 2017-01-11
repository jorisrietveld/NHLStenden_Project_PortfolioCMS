<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 22-12-2016 13:56
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Controller;


use StendenINF1B\PortfolioCMS\Kernel\BaseController;
use StendenINF1B\PortfolioCMS\Kernel\Database\Entity\Student;
use StendenINF1B\PortfolioCMS\Kernel\Http\Request;
use StendenINF1B\PortfolioCMS\Kernel\Http\Response;

class Admin extends BaseController 
{
    public function index( Request $request )
    {
        ob_start();
        dump($request);
        return new Response( '<h1>Admin page</h1>'.ob_get_clean(), 200 );
    }

    public function insertStudent( Request $request )
    {
        $postParams = $request->getPostParams();

        if ( $postParams->has( 'password' ) &&
            $postParams->has( 'email' ) &&
            $postParams->has( 'firstName' ) &&
            $postParams->has( 'lastName' ) &&
            $postParams->has( 'isAdmin' ) &&
            $postParams->has( 'address' ) &&
            $postParams->has( 'zipCode' ) &&
            $postParams->has( 'location' ) &&
            $postParams->has( 'dateOfBirth' ) &&
            $postParams->has( 'studentCode' ) &&
            $postParams->has( 'phoneNumber' )
        ){
            $student = new Student();
            $student->setHashedPassword( password_hash( $postParams->get( 'password' ), PASSWORD_BCRYPT ) );
            $student->setEmail( (string)$postParams->get('email') );
            $student->setLastIpAddress( $request->getClientIp() );
            $student->setFirstName( (string)$postParams->get( 'firstName' ) );
            $student->setLastName( (string)$postParams->get( 'lastName' ) );
            $student->setIsAdmin( (bool)$postParams->get( 'isAdmin' ) );
            $student->setAddress( (string)$postParams->get( 'address' ) );
            $student->setZipCode( (string)$postParams->get( 'zipCode' ) );
            $student->setLocation( (string)$postParams->get( 'location' ) );
            $student->setDateOfBirth( new \DateTime( $postParams->get( 'dateOfBirth' )) );
            $student->setStudentCode( (string)$postParams->get( 'studentCode' ) );
            $student->setPhoneNumber( (string)$postParams->get( 'phoneNumber' ) );

            $studentRepo = $this->getEntityManager()->getRepository( 'Student' );
            $studentRepo->insert( $student );
        }
        else
        {
            //
        }
    }


}