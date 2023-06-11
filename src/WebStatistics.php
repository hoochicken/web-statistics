<?php


namespace Hoochicken\WebStatistics;

use Hoochicken\ParameterBag\ParameterBag;

class WebStatistics
{
    const PORT_DEFAULT = 3306;
    const TABLE_NAME = 'statistics';
    const DATE_FORMAT = 'Y-m-d H:i:s';
    private ?WebStatisticsTable $webstatTable;
    private static ?ParameterBag $server;

    public function initDb(string $host, string $database, string $user, string $password, int $port = self::PORT_DEFAULT)
    {
        $this->webstatTable = new WebStatisticsTable($host, $database, $user, $password, $port);
        $this->webstatTable->setTable(self::TABLE_NAME);
    }

    public function getData(): array
    {
        return $this->webstatTable->getData();
    }

    public function createTable()
    {
        $this->webstatTable->createTableStatistics();
    }

    public function tableExists(): bool
    {
        return $this->webstatTable->tableExists(WebStatisticsTable::TABLE_NAME);
    }

    public function setServer(ParameterBag $server)
    {
        static::$server = $server;
    }

    public function getServer(): ParameterBag
    {
        return static::$server;
    }

    public function addEntry()
    {
        $entry = [
            WebStatisticsTable::COLUMN_CREATED_AT => date(static::DATE_FORMAT),
            WebStatisticsTable::COLUMN_PAGE_URL => self::getPageUrl(),
            WebStatisticsTable::COLUMN_BROWSER => self::getBrowser(),
            WebStatisticsTable::COLUMN_BROWSER_VERSION => self::getBrowserVersion(),
            WebStatisticsTable::COLUMN_COUNTRY => self::getCountry(),
            WebStatisticsTable::COLUMN_ENTRY_TIME => self::getEntryTime(),
            WebStatisticsTable::COLUMN_EXIT_TIME => self::getExitTime(),
        ];
        $this->webstatTable->addEntry($entry);
    }

    public function getBrowser(): string
    {
        return static::$server->getString('HTTP_USER_AGENT');
    }

    public function getPageUrl(): string
    {
        return static::$server->getString('REQUEST_URI');
    }

    public function getBrowserVersion(): string
    {
        return static::$server->getString('HTTP_USER_AGENT');
    }

    public function getCountry(): string
    {
        return static::$server->getString('HTTP_ACCEPT_LANGUAGE');
    }

    public function getEntryTime(): string
    {
        return date(self::DATE_FORMAT);
    }

    public function getExitTime(): string
    {
        return date(self::DATE_FORMAT);
    }
}