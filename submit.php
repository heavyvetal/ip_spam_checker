<?php

spl_autoload_register(function ($class_name) {
    require_once $class_name . '.php';
});

use IpSpamChecker\IpSpamChecker;
use IpSpamChecker\FileStorage;

$spamChecker = new IpSpamChecker(new FileStorage('recent_ips.txt'));

if ($spamChecker->hasPermission()) {
    echo '<h1>Your data has been accepted</h1>';
} else {
    echo '<h1 style="color: red">You have already sent data recently</h1>';
}
