<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 04-01-2017 12:25
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace Tests\PortefolioCMS\Kernel\Database\Repository;


use StendenINF1B\PortfolioCMS\Kernel\Database\Entity\Student;
use StendenINF1B\PortfolioCMS\Kernel\Database\EntityManager;

class StudentRepositoryTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $entityManager = new EntityManager();
        $studentRepository = $entityManager->getRepository( 'Student' );

        $this->assertInstanceOf(
            '\\StendenINF1B\\PortfolioCMS\\Kernel\\Database\\Repository\\StudentRepository',
            $studentRepository
        );
    }

    public function testGetStudentById()
    {
        $entityManager = new EntityManager();
        $studentRepository = $entityManager->getRepository( 'Student' );

        $student = $studentRepository->getById( 1 );

        $this->assertInstanceOf(
            '\\StendenINF1B\\PortfolioCMS\\Kernel\\Database\\Entity\\Student',
            $student
        );
    }

    public function testGetAllStudents()
    {
        $entityManager = new EntityManager();
        $studentRepository = $entityManager->getRepository( 'Student' );

        $students = $studentRepository->getAllStudents();

        $this->assertInstanceOf(
            '\\StendenINF1B\\PortfolioCMS\\Kernel\\Database\\Helper\\EntityCollection',
            $students
        );
        $this->assertInstanceOf(
            '\\StendenINF1B\\PortfolioCMS\\Kernel\\Database\\Entity\\Student',
            $students->get( 1, null )
        );
    }

    public function testGetStudentsBy()
    {
        $entityManager = new EntityManager();
        $studentRepository = $entityManager->getRepository( 'Student' );

        $students = $studentRepository->getByCondition( 'active = :active', [ ':active' => 1 ] );

        $this->assertInstanceOf(
            '\\StendenINF1B\\PortfolioCMS\\Kernel\\Database\\Helper\\EntityCollection',
            $students
        );

        $this->assertInstanceOf(
            '\\StendenINF1B\\PortfolioCMS\\Kernel\\Database\\Entity\\Student',
            $students->get( 1, null )
        );

        $students = $studentRepository->getByCondition( 'active = :active', [ ':active' => 0 ] );

        $this->assertInstanceOf(
            '\\StendenINF1B\\PortfolioCMS\\Kernel\\Database\\Helper\\EntityCollection',
            $students
        );

        $this->assertCount( 0, $students );
    }

    public function testUpdateStudent(  )
    {
        $entityManager = new EntityManager();
        $studentRepository = $entityManager->getRepository( 'Student' );

        $student = $studentRepository->getById( 1 );

        if( $student->getLastIpAddress() === '127.0.0.1' )
        {
            $student->setLastIpAddress( '128.0.0.1' );
            $studentRepository->update( $student );

            $student = $studentRepository->getById( 1 );

            $this->assertEquals( '128.0.0.1', $student->getLastIpAddress() );
        }
        else
        {
            $student->setLastIpAddress( '127.0.0.1' );
            $studentRepository->update( $student );

            $student = $studentRepository->getById( 1 );

            $this->assertEquals( '127.0.0.1', $student->getLastIpAddress() );
        }

    }
/*
    public function testInsert(  )
    {
        $student = new Student();

        $student->setHashedPassword( password_hash( 'password', PASSWORD_BCRYPT ) );
        $student->setEmail( 'testInsert@phpunit.com' );
        $student->setLastIpAddress( '123.43.23.43' );
        $student->setFirstName( 'firstName' );
        $student->setLastName( 'lastName' );
        $student->setIsAdmin( FALSE );
        $student->setActive( TRUE );
        $student->setAddress( 'address' );
        $student->setZipCode( '3456hb' );
        $student->setLocation( 'location' );
        $student->setDateOfBirth( new \DateTime( '1995-06-30' ));
        $student->setStudentCode( 'sdfkj' );
        $student->setPhoneNumber( '061234567' );

        $entityManager = new EntityManager();
        $studentRepository = $entityManager->getRepository( 'Student' );

        $studentRepository->insert( $student );
    }
*/


}