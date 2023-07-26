<?php

namespace IpSpamChecker;

class IpSpamChecker
{
    const DELAY = 20;

    /**
     * @var IStorage $storage
     */
    public $storage;

    public function __construct(IStorage $storage)
    {
        $this->storage = $storage;
    }

    /**
     * @return bool
     */
    public function hasPermission()
    {
        $permission = true;
        $currentIP = $_SERVER['REMOTE_ADDR'];
        $currentUserAgent = $_SERVER['HTTP_USER_AGENT'];

        $clients = json_decode($this->storage->read(), true);

        foreach ($clients as $index => $client) {
            // Expired clients are removed
            if ($client['time'] + self::DELAY < time()) {
                unset($clients[$index]);
            } else {
                if ($currentIP === $client['ip'] && $currentUserAgent === $client['user_agent']) {
                    $permission = false;
                }
            }
        }

        $clients[] = [
            'ip' => $currentIP,
            'user_agent' => $currentUserAgent,
            'time' => time(),
        ];

        $this->storage->write(json_encode($clients));

        return $permission;
    }
}
