<?php
namespace Emid\CouchDB;

class Document
{
	protected $id;
	protected $revision;
	protected $fields;

	public function __construct($fields = [])
	{
		$this->fields = $fields;
	}

	public function setId($id)
	{
		$this->id = $id;
	}

	public function setRevision($revision)
	{
		$this->revision = $revision;
		$this->fields['_rev'] = $revision;
	}

	public function setFields($fields)
	{
		$this->fields = $fields;
	}

	public function getId()
	{
		return $this->id;
	}

	public function getRevision()
	{
		return $this->revision;
	}

	public function getFields()
	{
		return $this->fields;
	}
}