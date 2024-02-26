<?php
require_once "vendor/autoload.php";

class VisitorCounter
{
    private $visitorCount;
    private $filePath;

    public function __construct($filePath)
    {
        $this->filePath = $filePath;
        $this->loadVisitorCount();
    }

    private function loadVisitorCount()
    {
        if (file_exists($this->filePath)) {
            $contents = file_get_contents($this->filePath);
            if ($contents !== false) {
                $this->visitorCount = max(0, (int)$contents);
            } else {
                $this->visitorCount = 0;
            }
        } else {
            $this->visitorCount = 0;
        }
    }

    public function getVisitorCount()
    {
        return $this->visitorCount;
    }

    public function setVisitorCount($count)
    {
        if ($count >= 0) {
            $this->visitorCount = $count;
        }
    }

    public function incrementVisitorCount()
    {
        $this->visitorCount++;
    }

    public function saveCountInFile()
    {
        $result = file_put_contents($this->filePath, $this->visitorCount);
        if ($result === false) {
            return false;
        }
        return true;
    }
}
