<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 22-12-2016 11:26
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Kernel\Database\Entity;

abstract class UploadedFile
{
    /**
     * @var int
     */
    protected $id = 0;

    /**
     * @var string
     */
    protected $fileName;

    /**
     * @var string
     */
    protected $mimeType;

    /**
     * @var string
     */
    protected $filePath;

    /**
     * @var int
     */
    protected $portfolioId; // One uploaded file has one portfolio.
}