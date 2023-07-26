<?php

namespace IpSpamChecker;

class FileStorage implements IStorage
{
    /**
     * @var string $filename
     */
    private $filename;

    public function __construct($filename)
    {
        $this->filename = $filename;
    }

    /**
     * @return string
     */
    public function read()
    {
        $data = '{}';

        if (file_exists($this->filename)) {
            $storage = new \SplFileObject($this->filename, 'r');

            if ($storage->getSize() > 0) {
                $data = $storage->fread($storage->getSize()) ?? '{}';
            }

            $storage = null;
        }

        return $data;
    }

    /**
     * @param string $data
     */
    public function write($data)
    {
        $storage = new \SplFileObject($this->filename, 'w');
        $storage->fwrite($data);
        $storage = null;
    }
}
