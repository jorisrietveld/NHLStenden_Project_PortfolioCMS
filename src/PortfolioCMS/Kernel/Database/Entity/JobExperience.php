<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 22-12-2016 05:45
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Kernel\Database\Entity;


class JobExperience
{
    protected $id;
    protected $location;
    protected $startedAt;
    protected $endedAt;
    protected $description;
    protected $isInternship;
    protected $portfolio; // One JobExperience has one portfolio
}