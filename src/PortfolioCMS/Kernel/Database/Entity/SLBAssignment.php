<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 22-12-2016 11:27
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Kernel\Database\Entity;

class SLBAssignment extends UploadedFile implements EntityInterface
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $feedback;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return SLBAssignment
     */
    public function setName( string $name ): SLBAssignment
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getFeedback(): string
    {
        return $this->feedback;
    }

    /**
     * @param string $feedback
     * @return SLBAssignment
     */
    public function setFeedback( string $feedback ): SLBAssignment
    {
        $this->feedback = $feedback;
        return $this;
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
     * @return SLBAssignment
     */
    public function setId( int $id ): SLBAssignment
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getFileName(): string
    {
        return $this->fileName;
    }

    /**
     * @param string $fileName
     * @return SLBAssignment
     */
    public function setFileName( string $fileName ): SLBAssignment
    {
        $this->fileName = $fileName;
        return $this;
    }

    /**
     * @return string
     */
    public function getMimeType(): string
    {
        return $this->mimeType;
    }

    /**
     * @param string $mimeType
     * @return SLBAssignment
     */
    public function setMimeType( string $mimeType ): SLBAssignment
    {
        $this->mimeType = $mimeType;
        return $this;
    }

    /**
     * @return string
     */
    public function getFilePath(): string
    {
        return $this->filePath;
    }

    /**
     * @param string $filePath
     * @return SLBAssignment
     */
    public function setFilePath( string $filePath ): SLBAssignment
    {
        $this->filePath = $filePath;
        return $this;
    }

    /**
     * @return int
     */
    public function getPortfolioId(): int
    {
        return $this->portfolioId;
    }

    /**
     * @param int $portfolioId
     * @return SLBAssignment
     */
    public function setPortfolio( int $portfolioId ): SLBAssignment
    {
        $this->portfolioId = $portfolioId;
        return $this;
    }

}