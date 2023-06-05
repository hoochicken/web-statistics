<?php

namespace Hoochicken\WebStatistics\src;

use PDO;

class Database
{
    const PORT_DEFAULT = 3306;
    const TABLE_NAME = 'statistics';

    private string $host = '';
    private int $port = self::PORT_DEFAULT;
    private string $user = '';
    private string $password = '';
    private string $dsn = '';
    private string $database = '';
    private string $table = self::TABLE_NAME;
    private ?PDO $db;


    public function __construct(string $host, string $user, string $password, string $database, int $port = self::PORT_DEFAULT)
    {
        $this->host = $host;
        $this->database = $database;
        $this->user = $user;
        $this->password = $password;
        $this->port = $port;
        $this->db = $this->initDb($this->host, $this->database, $this->user, $this->password);
    }

    private function initDb(string $host, string $database, string $user, string $password): PDO
    {
        $dsn = $this->generateDsn($host, $database);
        return new PDO($dsn, $user, $password);
    }

    private function generateDsn(string $host, string $database)
    {
        return sprintf('mysql:host=%s;dbname=%s', $host, $database);
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

    public function getDb()
    {
        $sql = 'SELECT name, color, calories FROM fruit ORDER BY name';
        foreach ($this->db->query($sql) as $row) {
            print $row['name'] . "\t";
            print $row['color'] . "\t";
            print $row['calories'] . "\n";
        }
    }

    public function tableExists()
    {
        $sql = sprintf('SELECT table_name FROM information_schema.tables WHERE table_schema = "%s" AND table_name = "%s"',
        $this->database, $this->table);
        return false;
    }
}