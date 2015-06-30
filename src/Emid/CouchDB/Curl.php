<?php
namespace Emid\CouchDB;

class Curl
{
	public function execute($ch)
	{
		$output = curl_exec($ch);

		if( $output === false ) {
			throw new \Exception(curl_error($ch));
		}
		
		curl_close($ch);

		return $output;
	}

	public function get($url)
	{
		$ch = curl_init($url);
	
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, [
			'Content-type: application/json',
			'Accept: */*'
		]);

		return $this->execute($ch);
	}

	public function put($url, $fields = [], $contentType = 'application/json')
	{
		$ch = curl_init($url);

		if( is_array($fields) )
			$fields = json_encode($fields);
	
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
		curl_setopt($ch, CURLOPT_HTTPHEADER, [
			'Content-type: ' . $contentType,
			'Accept: */*'
		]);

		return $this->execute($ch);
	}

	public function delete($url)
	{
		$ch = curl_init($url);
	
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, [
			'Content-type: application/json',
			'Accept: */*'
		]);

		return $this->execute($ch);
	}
}