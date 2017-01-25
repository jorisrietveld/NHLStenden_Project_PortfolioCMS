<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 09-12-2016 15:17
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Kernel;

use StendenINF1B\PortfolioCMS\Kernel\Database\EntityManager;
use StendenINF1B\PortfolioCMS\Kernel\Helper\ConfigLoader;
use StendenINF1B\PortfolioCMS\Kernel\Http\ParameterContainer;
use StendenINF1B\PortfolioCMS\Kernel\Http\Response;
use StendenINF1B\PortfolioCMS\Kernel\TemplateEngine\TemplateEngine;

/**
 * Class BaseController
 *
 * @package StendenINF1B\PortfolioCMS\Kernel
 */
abstract class BaseController
{
    /**
     * This holds the entity manager for communication with the database.
     *
     * @var EntityManager
     */
    protected static $entityManager;

    /**
     * This holds the template engine for rendering web pages.
     *
     * @var TemplateEngine
     */
    protected $templateEngine;

    /**
     * This holds the Configuration loader with global configuration.
     *
     * @var ConfigLoader
     */
    protected $configLoader;

    /**
     * This holds the application kernel.
     *
     * @var ApplicationKernel
     */
    protected $application;

    /**
     * BaseController constructor for initiating the base controller.
     *
     * @param TemplateEngine|null $templateEngine
     * @param ConfigLoader|null   $configLoader
     */
    public function __construct( TemplateEngine $templateEngine = NULL, ConfigLoader $configLoader = NULL )
    {
        $this->configLoader = $configLoader ?? new ConfigLoader( CONFIG_FILE );
        $this->templateEngine = $templateEngine ?? new TemplateEngine( $this->configLoader );
    }

    /**
     * Sets the application kernel.
     *
     * @param ApplicationKernel $applicationKernel
     */
    public function setApplication( ApplicationKernel $applicationKernel )
    {
        $this->application = $applicationKernel;
    }

    /**
     * Returnes the entity manager for communication with the database.
     *
     * @return EntityManager
     */
    public function getEntityManager()
    {
        self::$entityManager = self::$entityManager ?? new EntityManager();
        return self::$entityManager;
    }

    /**
     * Gets the template engine for rendering web pages.
     *
     * @return ConfigLoader|TemplateEngine
     */
    public function getTemplateEngine()
    {
        return $this->templateEngine;
    }

    /**
     * Retunes the ConfigLoader that contains global configuration.
     *
     * @return ConfigLoader
     */
    public function getConfigLoader()
    {
        return $this->configLoader;
    }

    /**
     * @param string $name
     * @param array  $context
     * @return string
     */
    public function renderWebPage( string $name, array $context = [] ) : string
    {
        return $this->templateEngine->render( $name, $context );
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
        return new Response(
            $this->renderWebPage(
                $webPage,
                array_merge( $context, [
                    'request-uri' => $this->application->getRequest()->getBaseUri(),
                    'lib-path'    => $this->application->getRequest()->getBaseUri() . 'libs/',
                ] ) ),
            $httpCode
        );
    }

    /**
     * Redirect the user to an different route.
     *
     * @param string $toRoute
     */
    public function redirect( string $toRoute )
    {
        header( 'Location: ' . $toRoute );
        //return $this->application->handleFromRoute( $toRoute );
    }

    public function validatePostParams()
    {

    }

    /**
     * @param ParameterContainer $postParams
     * @param array              $requiredFields
     * @return bool
     */
    protected function checkPostParams( ParameterContainer $postParams, array $requiredFields ) : bool
    {
        foreach ($requiredFields as $requiredField)
        {
            if ( !$postParams->has( $requiredField ) )
            {
                return FALSE;
            }
        }
        return TRUE;
    }

    // TODO remove this abstract method from all children where its not necessary.
    //abstract public function index( Request $request );
}