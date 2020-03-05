<?php


namespace Watcher\Entity;

/**
 * Class FileData
 * @package Watcher\Entity
 */
class FileData
{
    /**
     * @var string
     */
    private $oldHash;

    /**
     * @var string
     */
    private $newHash;

    /**
     * @var string
     */
    private $oldContent;

    /**
     * @var string
     */
    private $newContent;

    /**
     * @var array
     */
    private $modifiedLines;

    /**
     * FileData constructor.
     *
     * @param  string  $oldHash
     * @param  string  $newHash
     * @param  string  $oldContent
     * @param  string  $newContent
     * @param  array  $modifiedLines
     */
    public function __construct($oldHash, $newHash, $oldContent, $newContent, array $modifiedLines)
    {
        $this->oldHash = $oldHash;
        $this->newHash = $newHash;
        $this->oldContent = $oldContent;
        $this->newContent = $newContent;
        $this->modifiedLines = $modifiedLines;
    }

    /**
     * @return string
     */
    public function getOldHash()
    {
        return $this->oldHash;
    }

    /**
     * @param  string  $oldHash
     */
    public function setOldHash($oldHash)
    {
        $this->oldHash = $oldHash;
    }

    /**
     * @return string
     */
    public function getNewHash()
    {
        return $this->newHash;
    }

    /**
     * @param  string  $newHash
     */
    public function setNewHash($newHash)
    {
        $this->newHash = $newHash;
    }

    /**
     * @return string
     */
    public function getOldContent()
    {
        return $this->oldContent;
    }

    /**
     * @param  string  $oldContent
     */
    public function setOldContent($oldContent)
    {
        $this->oldContent = $oldContent;
    }

    /**
     * @return string
     */
    public function getNewContent()
    {
        return $this->newContent;
    }

    /**
     * @param  string  $newContent
     */
    public function setNewContent($newContent)
    {
        $this->newContent = $newContent;
    }

    /**
     * @return array
     */
    public function getModifiedLines()
    {
        return $this->modifiedLines;
    }

    /**
     * @param  array  $modifiedLines
     */
    public function setModifiedLines($modifiedLines)
    {
        $this->modifiedLines = $modifiedLines;
    }


}