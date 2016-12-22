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
     * @return UploadedFile
     */
    public function setId( int $id ): UploadedFile
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
     * @return UploadedFile
     */
    public function setFileName( string $fileName ): UploadedFile
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
     * @return UploadedFile
     */
    public function setMimeType( string $mimeType ): UploadedFile
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
     * @return UploadedFile
     */
    public function setFilePath( string $filePath ): UploadedFile
    {
        $this->filePath = $filePath;
        return $this;
    }

    /**
     * @return Portfolio
     */
    public function getPortfolio(): Portfolio
    {
        return $this->portfolio;
    }

    /**
     * @param Portfolio $portfolio
     * @return UploadedFile
     */
    public function setPortfolio( Portfolio $portfolio ): UploadedFile
    {
        $this->portfolio = $portfolio;
        return $this;
    }



}