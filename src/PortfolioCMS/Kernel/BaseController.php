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
use StendenINF1B\PortfolioCMS\Kernel\TemplateEngine\TemplateEngine;

abstract class BaseController
{
    protected static $entityManager;
    protected $templateEngine;
    protected $configLoader;

    public function __construct( TemplateEngine $templateEngine = NULL, ConfigLoader $configLoader = NULL )
    {
        $this->configLoader = $configLoader ?? new ConfigLoader( CONFIG_FILE );
        $this->templateEngine = $configLoader ?? new TemplateEngine( $this->configLoader );
    }

    public function loadEntityManager(  )
    {
        self::$entityManager = $entityManager ?? new EntityManager();
    }

    public function getEntityManager(  )
    {
        self::$entityManager = self::$entityManager ?? $this->loadEntityManager();
        return self::$entityManager;
    }

    public function getTemplateEngine(  )
    {
        return $this->templateEngine;
    }

    public function getConfigLoader(  )
    {
        return $this->configLoader;
    }

    public function renderWebPage( string $name, array $context = [] ) : string
    {
        return $this->templateEngine->render( $name, $context );
    }

    abstract public function index();
}