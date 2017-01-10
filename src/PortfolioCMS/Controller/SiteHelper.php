<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 06-01-2017 21:25
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Controller;


trait SiteHelper
{
    protected $portfoliosCollection;
    protected $portfolioRepository;

    /**
     * Render the base menu.
     */
    public function renderMenuLinks(  )
    {
        $menuLinks = '';

        foreach ( $this->getPortfolios() as $portfolio )
        {
            $menuLinks .= sprintf(
                '<li>
                <a href="portfolio/%s">
                    <i class="fa fa-caret-right" aria-hidden="true"></i> %s
                </a>
            </li>',
                $portfolio->getUrl(), $portfolio->getUrl()
            );
        }
        return $menuLinks;
    }

    protected function getPortfolios(  )
    {
        $this->portfolioRepository = $this->getEntityManager()->getRepository( 'Portfolio' );
        $this->portfoliosCollection = $this->portfoliosCollection ?? $this->portfolioRepository->getAll();
        return $this->portfoliosCollection;
    }
}