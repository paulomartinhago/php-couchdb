<?php
namespace Emid\CouchDB;

class Service
{
	private $client;
	private $curl;

	public function __construct(Client $client)
	{
		$this->client = $client;
		$this->curl   = new Curl();
	}

	private function parseResponse( $resp ) {
		if( ! $resp )
			throw new \Exception('Empty response from the server');

		$resp = json_decode( $resp, true );

		if( ! $resp )
			throw new \Exception('Response is not a JSON');

		if( isset( $resp['error'] ) )
			throw new ServiceException( $resp['error'] );

		return $resp;
	}

	public function databases()
	{
		$uri = $this->client->getPath('_all_dbs');

		return $this->parseResponse($this->curl->get($uri));
	}

	public function documents()
	{
		$uri = sprintf('%s/%s', $this->client->getDatabase(), '_all_docs'); 

		$response = $this->parseResponse($this->curl->get($this->client->getPath($uri)));

		return $response['rows'];
	}

	public function findDocument(Document $document)
	{
		$id = $document->getId();

		if( empty($id) )
			$document->setId($document->getFields()['_id']);

		$uri = sprintf('%s/%s', $this->client->getDatabase(), $document->getId()); 

		try {
			$response = $this->parseResponse($this->curl->get($this->client->getPath($uri)));
			$document->setFields($response);
			$document->setRevision($response['_rev']);
		} catch(\Exception $e){
			return $e->getMessage();
		}

		return $document;
	}

	public function saveDocument(Document $document)
	{
		$id = $document->getId();

		if( empty($id) )
			$document->setId($document->getFields()['_id']);

		$uri = sprintf('%s/%s', $this->client->getDatabase(), $document->getId());

		try {
			$response = $this->parseResponse($this->curl->put($this->client->getPath($uri), $document->getFields()));
		} catch(\Exception $e){
			return $e->getMessage();
		}

		return $response;
	}

	public function saveAttachment(Document $document, $attachment)
	{
		$attachment_parts = pathinfo($attachment);

		$basename = $attachment_parts['basename'];

		$finfo       = finfo_open(FILEINFO_MIME_TYPE);
		$contentType = finfo_file($finfo, $attachment);

		$id = $document->getId();

		if( empty($id) )
			$document->setId($document->getFields()['_id']);

		$uri = sprintf('%s/%s/%s?rev=%s', $this->client->getDatabase(), $document->getId(), $basename, $document->getRevision());

		try {
			$response = $this->parseResponse($this->curl->put($this->client->getPath($uri), file_get_contents($attachment), $contentType));
		} catch(\Exception $e){
			return $e->getMessage();
		}

		return $response;
	}

	public function updateDocument(Document $document)
	{
		$fields = $document->getFields();

		$document = $this->findDocument($document);
		$document->setFields(array_merge($document->getFields(), $fields));
		$document->setRevision($document->getRevision());

		return $this->saveDocument($document);
	}

	public function deleteDocument(Document $document)
	{
		$document = $this->findDocument($document);

		if( ! $document instanceof Document )
			return 'Invalid document!';

		$uri = sprintf('%s/%s?rev=%s', $this->client->getDatabase(), $document->getId(), $document->getRevision());

		try {
			$response = $this->parseResponse($this->curl->delete($this->client->getPath($uri)));
		} catch(\Exception $e){
			return $e->getMessage();
		}

		return $response;
	}
}