<?php
namespace Emid\CouchDB;

class ServiceException extends \Exception 
{
	
	const DOCUMENT_NOT_FOUND = 'not_found';
	const DOCUMENT_CONFLICT  = 'conflict';

}