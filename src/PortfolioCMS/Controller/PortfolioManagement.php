<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 10-01-2017 14:45
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Controller;


use StendenINF1B\PortfolioCMS\Kernel\BaseController;
use StendenINF1B\PortfolioCMS\Kernel\Database\Entity\Portfolio;
use StendenINF1B\PortfolioCMS\Kernel\Http\Request;
use StendenINF1B\PortfolioCMS\Kernel\Http\Response;

class PortfolioManagement extends BaseController 
{
    /**
     * The require fields to update or insert an portfolio.
     *
     * @var array
     */
    protected $requiredPortfolioFields = [
        'title',
        'url',
        'themeId',
        'userId',
    ];

    /**
     * The required fields to update or insert an skill.
     *
     * @var array
     */
    protected $requiredSkillFields = [
        'name',
        'levelOfExperience',
    ];

    /**
     * The required fields to update or insert an skill.
     *
     * @var array
     */
    protected $requiredTrainingFields = [
        'title',
        'institution',
        'location',
        'description',
        'obtainedCertificate',
        'currentTraining'
    ];

    /**
     * The required fields to update or insert an hobby.
     *
     * @var array
     */
    protected $requiredHobbyFields = [
        'name',
    ];

    /**
     * The required fields to update or insert an language.
     *
     * @var array
     */
    protected $requiredLanguageFields =[
        'language',
        'level',
        'isNative',
    ];

    /**
     * The required fields to update or insert an job experience.
     *
     * @var array
     */
    protected $requiredJobExperienceFields = [
        'location',
        'description',
        'isInternship',
    ];

    /**
     * The required fields to update or insert an uploaded file.
     *
     * @var array
     */
    protected $requiredUploadedFileFields = [
        'fileName',
        'mimeType',
        'filePath',
    ];

    /**
     * The required fields to update or insert an skill.
     *
     * @var array
     */
    protected $requiredSlbAssignmentFields = [
        'name',
    ];

    /**
     * The required fields to update or insert an skill.
     *
     * @var array
     */
    protected $requiredImageFields = [
        'name',
        'type',
    ];

    /**
     * The required fields to update or insert an skill.
     *
     * @var array
     */
    protected $requiredProjectFields = [
        'name',
        'description',
        'link',
        'thumbnailImageId'
    ];

    protected function actionHandled( $message ) : Response
    {
        return new Response(
            $this->renderWebPage(
                'admin:editPortfolio', [
                    'feedback' => $message,
                ]
            ),
            Response::HTTP_STATUS_OK
        );
    }

    public function insertPortfolio( Request $request ) : Response
    {
        $postParams = $request->getPostParams();

        if( $this->checkPostParams( $postParams, $this->requiredPortfolioFields ))
        {
            $themeRepository = $this->getEntityManager()->getRepository( 'Theme' );
            $studentRepository = $this->getEntityManager()->getRepository( 'Student' );
            $portfolioRepository = $this->getEntityManager()->getRepository( 'Portfolio' );

            $newPortfolio = new Portfolio();
            $newPortfolio->setTitle( (string)$postParams->get( 'title') );
            $newPortfolio->setUrl( (string)$postParams->get( 'url' ) );
            $newPortfolio->setTheme( $themeRepository->getById( (int)$postParams->get( 'themeId' ) ) );
            $newPortfolio->setStudent( $studentRepository->getById( (int)$postParams->get( 'userId' ) ) );

            $portfolioRepository->insert( $newPortfolio );

            $message = 'Het portefolio is toegevoegd.';
        }

        return $this->actionHandled( $message ?? 'Niet alle verplichte velden zijn ingevuld.' );
    }

    public function editPortfolio( Request $request ) : Response
    {
        $postParams = $request->getPostParams();

        if( $this->checkPostParams( $postParams, $this->required ))
        {
            $message = '';
        }

        return $this->actionHandled( $message ?? 'Niet alle verplichte velden zijn ingevuld.' );
    }

    public function removePortfolio( Request $request ) : Response
    {

    }

    public function insertSkill( Request $request  ) : Response
    {
        
    }

    public function editSkill( Request $request  ) : Response
    {

    }

    public function deleteSkill( Request $request  ) : Response
    {
        
    }

    public function insertTraining( Request $request  ) : Response
    {
        
    }

    public function editTraining( Request $request  ) : Response
    {
        
    }

    public function deleteTraining( Request $request  ) : Response
    {
        
    }

    public function insertHobby( Request $request  ) : Response
    {
        
    }

    public function editHobby( Request $request  ) : Response
    {
        
    }

    public function deleteHobby( Request $request  ) : Response
    {
        
    }

    public function insertLanguage( Request $request  ) : Response
    {
        
    }

    public function editLanguage( Request $request  ) : Response
    {
        
    }

    public function deleteLanguage( Request $request  ) : Response
    {
        
    }

    public function insertJobExperience( Request $request  ) : Response
    {
        
    }

    public function editJobExperience( Request $request  ) : Response
    {
        
    }

    public function deleteJobExperience( Request $request  ) : Response
    {
        
    }

    public function insertImage( Request $request  ) : Response
    {
        
    }

    public function editImage( Request $request  ) : Response
    {
        
    }

    public function deleteImage( Request $request  ) : Response
    {
        
    }

    public function insertSlbAssignment( Request $request  ) : Response
    {
        
    }

    public function editSlbAssignment( Request $request  ) : Response
    {
        
    }

    public function deleteSlbAssignment( Request $request  ) : Response
    {
        
    }

    public function insertProject( Request $request  ) : Response
    {
        
    }

    public function editProject( Request $request  ) : Response
    {

    }
}
