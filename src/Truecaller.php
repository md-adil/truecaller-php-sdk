<?php
namespace Adil\Truecaller;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;

class Truecaller {

	protected $key;
	protected $keyType;
	protected $client;

	protected $config = [
		'api' => [
			'base_uri' => 'https://api4.truecaller.com/v1',
			'public_key' => 'key'
		],
		'hash' => 'sha512'
	];

	function __construct(array $config = [])
	{
		$this->config = array_merge_recursive($this->config, $config);
		$this->client = new Client();
	}

	public function setClient(ClientInterface $client)
	{
		$this->client = $client;
	}

	public function getConfig()
	{
		return $this->config;
	}

	public function payload($payload)
	{
		return new Payload($this, $payload);
	}

	public function getKey()
	{
		return $this->key;
		
	}

	public function getKeyType()
	{
		return $this->keyType;
	}

	public function fetchRSAKey()
	{
		$uri = $this->config['api']['base_uri'] . '/' . $this->config['api']['public_key'];
		$response = $this->client->get($uri);
		$data = json_decode((string)$response->getBody());
		return $data[0]->key;
	}

	public function setRSAKey($key)
	{
		$this->keyType = 'rsa';
		$this->key = $key;
	}
}
