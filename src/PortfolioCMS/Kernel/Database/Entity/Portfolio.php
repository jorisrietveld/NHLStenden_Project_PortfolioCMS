<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 22-12-2016 05:31
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Kernel\Database\Entity;


class Portfolio
{
    protected $id;
    protected $theme; // One portfolio has One theme
    protected $title;
    protected $link;
    protected $grade;
    protected $jobExperience; // One portfolio has many or zero JobExperiences.
    protected $language; // One portfolio has many or zero Languages.
    protected $trainings; // One portfolio has many or zero Trainings.
    protected $slbAssignments; // One portfolio has many or zero SlbAssignments.
    protected $images; // One portfolio has many or zero Images.
    protected $skills; // One portfolio has many or zero Skills.
    protected $hobbies; // One portfolio has many or zero Hobbies.
}