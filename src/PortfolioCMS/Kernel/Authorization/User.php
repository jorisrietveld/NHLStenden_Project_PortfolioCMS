<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 05-01-2017 16:12
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Kernel\Authorization;


class User
{
    const ANONYMOUS_USER = 0;
    const STUDENT = 1;
    const TEACHER = 2;
    const SLB_TEACHER = 3;
    const ADMIN = 4;
}