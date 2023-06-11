<?php

namespace Hoochicken\WebStatistics;

use Hoochicken\Dbtable\Database;
use PDO;

class WebStatisticsTable extends Database
{
    const TABLE_NAME = 'statistics';
    const COLUMN_ID = 'id';
    const COLUMN_PAGE_URL = 'page_url';
    const COLUMN_ENTRY_TIME = 'entry_time';
    const COLUMN_EXIT_TIME = 'exit_time';
    const COLUMN_IP_ADDRESS = 'ip_address';
    const COLUMN_COUNTRY = 'country';
    const COLUMN_OPERATING_SYSTEM = 'operating_system';
    const COLUMN_BROWSER = 'browser';
    const COLUMN_BROWSER_VERSION = 'browser_version';
    const COLUMN_CREATED_AT = 'created_at';

    protected static array $definition = [
        self::COLUMN_ID => '`id` int(20) NOT NULL',
        self::COLUMN_PAGE_URL => '`page_url` varchar(255) DEFAULT NULL',
        self::COLUMN_ENTRY_TIME => '`entry_time` datetime DEFAULT NULL',
        self::COLUMN_EXIT_TIME => '`exit_time` datetime DEFAULT NULL',
        self::COLUMN_IP_ADDRESS => '`ip_address` varchar(255) DEFAULT NULL',
        self::COLUMN_COUNTRY => '`country` varchar(255) DEFAULT NULL',
        self::COLUMN_OPERATING_SYSTEM => '`operating_system` varchar(255) DEFAULT NULL',
        self::COLUMN_BROWSER => '`browser` varchar(255) DEFAULT NULL',
        self::COLUMN_BROWSER_VERSION => '`browser_version` varchar(255) DEFAULT NULL',
        self::COLUMN_CREATED_AT => '`created_at` timestamp DEFAULT NULL DEFAULT current_timestamp()',
    ];

    public function __construct(string $host, string $database, string $user, string $password, int $port = self::PORT_DEFAULT)
    {
        parent::__construct($host, $database, $user, $password, $port);
        $this->setTable(static::TABLE_NAME);
    }

    public function createTableStatistics()
    {
        $this->createTable(static::getTable(), static::$definition);
    }

    public function add()
    {
        $this->addEntry();
    }
}