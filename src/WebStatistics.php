<?php

namespace Hoochicken;

class WebStatistics
{
    const PORT_DEFAULT = 3306;

    private string $host = '';
    private int $port = self::PORT_DEFAULT;
    private string $user = '';
    private string $password = '';
    private string $database = '';


    public function __construct(string $host, string $user, string $password, string $database, int $port = self::PORT_DEFAULT)
    {
        die('ASD');
    }

    public function test()
    {
        echo 'assssssssssssssssd';
    }

    public function createTable()
    {
        $sql = 'CREATE TABLE `analytics` (
  `id` int(20) NOT NULL,
  `page_url` varchar(150) NOT NULL,
  `entry_time` datetime NOT NULL,
  `exit_time` datetime NOT NULL,
  `ip_address` varchar(30) NOT NULL,
  `country` varchar(50) NOT NULL,
  `operating_system` varchar(20) NOT NULL,
  `browser` varchar(20) NOT NULL,
  `browser_version` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
)';
    }

    public function tableExists()
    {
        return false;
    }
}