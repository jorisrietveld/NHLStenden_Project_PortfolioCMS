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
  /*  public function renderMenuLinks(  )
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
    }*/

    /**
     * Dummy method to show some fake data in the drop down.
     * @return string
     */
    public function renderMenuLinks(  )
      {
          $menuLinks = '';

          $fakePortfolios = [
              'Aron soppe',
              'Esmee Lunenborg',
              'Anouk van der veen',
              'Marco Brink',
              'Kevin Tabak',
              'Joris Rietveld',
              'Kevin Veldman',
          ];

          foreach ( $fakePortfolios as $portfolio )
          {
              $menuLinks .= sprintf(
                  '<li>
                  <a href="#">
                      <i class="fa fa-caret-right" aria-hidden="true"></i> %s
                  </a>
              </li>',
                  $portfolio
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