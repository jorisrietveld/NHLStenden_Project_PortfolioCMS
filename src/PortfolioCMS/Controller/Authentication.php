<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 06-01-2017 16:07
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Controller;


use StendenINF1B\PortfolioCMS\Kernel\Authorization\User;
use StendenINF1B\PortfolioCMS\Kernel\BaseController;
use StendenINF1B\PortfolioCMS\Kernel\Http\Request;
use StendenINF1B\PortfolioCMS\Kernel\Http\Response;
use StendenINF1B\PortfolioCMS\Kernel\Authorization\User as AuthorizedUser;

class Authentication extends BaseController
{
    use SiteHelper;

    const ANONYMOUS_USER = 0;
    const STUDENT = 1;
    const TEACHER = 2;
    const SLB_TEACHER = 3;
    const ADMIN = 4;

    /**
     * This action is for handling the Login route.
     *
     * @param Request|null $request
     * @return Response
     */
    public function index( Request $request )
    {
        if ( $request->postParams->has( 'email' ) && $request->postParams->has( 'password' ) )
        {
            if( $this->validateUser(
                (string)$request->getPostParams()->get( 'email' ),
                (string)$request->getPostParams()->get( 'password' )
            )){
                // User authenticated so redirect to admin page.
                return $this->redirect( '/admin/overzicht' );
            }
            else
            {
                // Not an valid user so give feedback.
                return new Response(
                    $this->renderWebPage( 'site:login', [
                        'portfolioMenuLinks' => $this->renderMenuLinks(),
                        'login-feedback' => 'De combinatie van wachtwoord gebruikersnaam is niet gevonden in onze database.',
                        'request-uri' => $request->getBaseUri(),
                    ] ),
                    Response::HTTP_STATUS_OK
                );
            }
        }
        // Normal login request so render the login page.
        return new Response(
            $this->renderWebPage( 'site:login', [
                'portfolioMenuLinks' => $this->renderMenuLinks(),
                'request-uri' => $request->getBaseUri(),
                'login-feedback' => password_hash('admin@146.185.141.142', PASSWORD_BCRYPT),
            ] ),
            Response::HTTP_STATUS_OK
        );
    }

    public function logout( Request $request )
    {
        // Destroy the session and remove the session cookie.
        $_SESSION = [];
        $cookieParams = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $cookieParams["path"],
            $cookieParams["domain"],
            $cookieParams["secure"],
            $cookieParams["httponly"]
        );
        session_destroy();

        return $this->redirect( '/login' );
    }

    protected function validateUser( string $email, string $password )
    {
        $teacherRepository = $this->getEntityManager()->getRepository( 'Teacher' );
        $studentRepository = $this->getEntityManager()->getRepository( 'Student' );

        $user = $studentRepository->getByEmail( $email );

        // Check if the user is found in the database.
        if( $user->getId() < 1 )
        {
            return false;
        }

        // Check the inputted passwoord with the stored hash.
        if( !password_verify( $password, $user->getHashedPassword() ))
        {
            return false;
        }

        $_SESSION['userId'] = $user->getId();

        if( $user->getIsAdmin() )
        {
            $_SESSION['authorizationLevel'] = AuthorizedUser::ADMIN;
        }
        else
        {
            $student = $studentRepository->getById();
            $teacher = $teacherRepository->getById();

            if( $student->getId() == $user->getId() )
            {
                $_SESSION['authorizationLevel'] = AuthorizedUser::STUDENT;
            }
            elseif ( $teacher->getIsSLBer() )
            {
                $_SESSION['authorizationLevel'] = AuthorizedUser::SLB_TEACHER;
            }
            else
            {
                $_SESSION['authorizationLevel'] = AuthorizedUser::TEACHER;
            }
        }
        return true;
    }
}