<?php

namespace IpSpamChecker;

interface IStorage
{
    /**
     * @return string
     */
    public function read();

    /**
     * @param string
     */
    public function write($data);
}
