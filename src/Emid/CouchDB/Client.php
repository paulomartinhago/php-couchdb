<?php
namespace Emid\CouchDB;

class Client
{
	protected $host;
	protected $dbname;

	public function __construct($host, $dbname)
	{
		$this->host   = rtrim($host, '/');
		$this->dbname = $dbname;
	}

	public function getHost()
	{
		return $this->host;
	}

	public function getDatabase()
	{
		return $this->dbname;
	}

	public function getPath($path = '')
	{
		return rtrim(sprintf('%s/%s', $this->getHost(), $path), '/');
	}
}