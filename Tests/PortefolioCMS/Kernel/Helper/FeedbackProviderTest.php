<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 20-01-2017 18:07
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace Tests\PortefolioCMS\Kernel\Helper;

use StendenINF1B\PortfolioCMS\Kernel\Helper\FeedbackProvider;

class FeedbackProviderTest extends \PHPUnit_Framework_TestCase
{
    public function testLoadFeedbackFile(  )
    {
        $feedbackProvider = new FeedbackProvider();
    }
}