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
    public function index( Request $request = NULL )
    {
        ob_start();
        dump($request);
        return new Response( '<h1>Admin page</h1>'.ob_get_clean(), 200 );
    }

    public function insertStudent( Request $request = NULL )
    {
        $student = new Student();
        $student->setHashedPassword(   );
        $student->setEmail( $request->getPostParams()->get('email') );
        $student->setAccountCreated( );
        $student->setLastLogin(  );
        $student->setLastIpAddress(  );
        $student->setFirstName(  );
        $student->setLastName( );
        $student->setIsAdmin( );
        $student->setActive( );
        $student->setAddress( );
        $student->setZipCode( );
        $student->setLocation( );
        $student->setDateOfBirth( );
        $student->setStudentCode( );
        $student->setPhoneNumber( );

        $studentRepo = $this->getEntityManager()->getRepository( 'Student' );
        $studentRepo->insert( $student );
    }


}