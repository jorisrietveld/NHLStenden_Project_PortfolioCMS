<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 22-12-2016 05:31
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Kernel\Database\Entity;

use StendenINF1B\PortfolioCMS\Kernel\Database\Helper\EntityCollection;

class Portfolio implements EntityInterface
{
    /**
     * @var int
     */
    protected $id = 0;

    /**
     * @var Theme
     */
    protected $theme; // One portfolio has One theme

    /**
     * @var string
     */
    protected $title;

    /**
     * @var float
     */
    protected $grade;

    /**
     * @var string
     */
    protected $url;

    /**
     * @var Student
     */
    protected $student;

    /**
     * @var EntityCollection
     */
    protected $jobExperience; // (N:M) One portfolio has many or zero JobExperiences.

    /**
     * @var EntityCollection
     */
    protected $language; // (N:M) One portfolio has many or zero Languages.

    /**
     * @var EntityCollection
     */
    protected $trainings; // (N:M) One portfolio has many or zero Trainings.

    /**
     * @var EntityCollection
     */
    protected $slbAssignments; // (N:M) One portfolio has many or zero SlbAssignments.

    /**
     * @var EntityCollection
     */
    protected $images; // (N:M) One portfolio has many or zero Images.

    /**
     * @var EntityCollection
     */
    protected $skills; // (N:M) One portfolio has many or zero Skills.

    /**
     * @var EntityCollection
     */
    protected $hobbies; // (N:M) One portfolio has many or zero Hobbies.

    /**
     * @var EntityCollection
     */
    protected $pages; // (N:M) One portfolio has manny or zero Pages.

    /**
     * @var EntityCollection
     */
    protected $projects; // (N:M) One portfolio has many or zero Projects.

    protected $cv;

    public function __construct(  )
    {
        $this->grade = (float)0.0;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Portfolio
     */
    public function setId( int $id ): Portfolio
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return Theme
     */
    public function getTheme(): Theme
    {
        return $this->theme;
    }

    /**
     * @param Theme $theme
     * @return Portfolio
     */
    public function setTheme( Theme $theme ): Portfolio
    {
        $this->theme = $theme;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Portfolio
     */
    public function setTitle( string $title ): Portfolio
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return float
     */
    public function getGrade(): float
    {
        return $this->grade;
    }

    /**
     * @param float $grade
     * @return Portfolio
     */
    public function setGrade( float $grade ): Portfolio
    {
        $this->grade = $grade;
        return $this;
    }

    /**
     * @return EntityCollection
     */
    public function getJobExperience(): EntityCollection
    {
        return $this->jobExperience;
    }

    /**
     * @param EntityCollection $jobExperience
     * @return Portfolio
     */
    public function setJobExperience( EntityCollection $jobExperience ): Portfolio
    {
        $this->jobExperience = $jobExperience;
        return $this;
    }

    /**
     * @return EntityCollection
     */
    public function getLanguage(): EntityCollection
    {
        return $this->language;
    }

    /**
     * @param EntityCollection $language
     * @return Portfolio
     */
    public function setLanguage( EntityCollection $language ): Portfolio
    {
        $this->language = $language;
        return $this;
    }

    /**
     * @return EntityCollection
     */
    public function getTrainings(): EntityCollection
    {
        return $this->trainings;
    }

    /**
     * @param EntityCollection $trainings
     * @return Portfolio
     */
    public function setTrainings( EntityCollection $trainings ): Portfolio
    {
        $this->trainings = $trainings;
        return $this;
    }

    /**
     * @return EntityCollection
     */
    public function getSlbAssignments(): EntityCollection
    {
        return $this->slbAssignments;
    }

    /**
     * @param EntityCollection $slbAssignments
     * @return Portfolio
     */
    public function setSlbAssignments( EntityCollection $slbAssignments ): Portfolio
    {
        $this->slbAssignments = $slbAssignments;
        return $this;
    }

    /**
     * @return EntityCollection
     */
    public function getImages(): EntityCollection
    {
        return $this->images;
    }

    /**
     * @param EntityCollection $images
     * @return Portfolio
     */
    public function setImages( EntityCollection $images ): Portfolio
    {
        $this->images = $images;
        return $this;
    }

    /**
     * @return EntityCollection
     */
    public function getSkills(): EntityCollection
    {
        return $this->skills;
    }

    /**
     * @param EntityCollection $skills
     * @return Portfolio
     */
    public function setSkills( EntityCollection $skills ): Portfolio
    {
        $this->skills = $skills;
        return $this;
    }

    /**
     * @return EntityCollection
     */
    public function getHobbies(): EntityCollection
    {
        return $this->hobbies;
    }

    /**
     * @param EntityCollection $hobbies
     * @return Portfolio
     */
    public function setHobbies( EntityCollection $hobbies ): Portfolio
    {
        $this->hobbies = $hobbies;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl( string $url ) : Portfolio
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return Student
     */
    public function getStudent(): Student
    {
        return $this->student;
    }

    /**
     * @param Student $student
     * @return Portfolio
     */
    public function setStudent( Student $student ) : Portfolio
    {
        $this->student = $student;
        return $this;
    }

    /**
     * @return EntityCollection
     */
    public function getProjects(): EntityCollection
    {
        return $this->projects;
    }

    /**
     * @param EntityCollection $projects
     * @return Portfolio
     */
    public function setProjects( EntityCollection $projects ): Portfolio
    {
        $this->projects = $projects;
        return $this;
    }

    /**
     * @param EntityCollection $pages
     * @return Portfolio
     */
    public function setPages( EntityCollection $pages ) : Portfolio
    {
        $this->pages = $pages;
        return $this;
    }

    /**
     * @return EntityCollection
     */
    public function getPages() : EntityCollection
    {
        return $this->pages;
    }

    /**
     * This method gets the Cv property.
     *
     * @return mixed
     */
    public function getCv() : SLBAssignment
    {
        return $this->cv;
    }

    /**
     * This method sets the cv property.
     *
     * @param mixed $cv
     */
    public function setCv( SLBAssignment $cv )
    {
        $this->cv = $cv;
    }


}