<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 18-01-2017 20:53
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Controller;

use StendenINF1B\PortfolioCMS\Kernel\BaseController;
use StendenINF1B\PortfolioCMS\Kernel\Http\Request;

class GradesManagement extends BaseController
{
    /**
     * This method shows an table with the users grade for the route /admin/cijferAdministratie/{id}
     * @param Request $request
     * @param string  $id
     */
    public function gradeManagement( Request $request, string $id )
    {

    }

    /**
     * This method shows an list with all the users and redirects to the method gradeManagement. for the route /admin/gradesOverview.
     *
     * @param Request $request
     */
    public function gradeOverview( Request $request )
    {

    }
}