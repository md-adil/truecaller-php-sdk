<?php
namespace Adil\Truecaller;

use Adil\Truecaller\Exceptions\InvalidKeyTypeException;
use Adil\Truecaller\Exceptions\SignatureException;
use phpseclib\Crypt\RSA;

class Payload implements \IteratorAggregate {
	protected $payload;
	protected $data = [];

	protected $app;
	protected $config;

	function __construct(Truecaller $app, $payload)
	{
		$this->app = $app;
		$this->config = $app->getConfig();
		$this->payload = $payload;
	}

	public function getIterator() {
        return new \ArrayIterator($this->data);
    }

	public function verify($signature)
	{
		switch ($this->app->getKeyType()) {
			case 'rsa':
				$this->verifyRSASignature($signature);
				break;
			default:
				throw new InvalidKeyTypeException('Unsupported Key Type');
		}

		$this->data = json_decode(base64_decode($this->payload), 1);
	}

	protected function verifyRSASignature($signature)
	{
		$rsa = new RSA(); 
		$rsa->setHash($this->config['hash']);
		$rsa->setSignatureMode(RSA::SIGNATURE_PKCS1); 
		$rsa->loadKey( $this->app->getKey() );
		if(!$rsa->verify( $this->payload, base64_decode($signature) ) ) {
			throw new SignatureException("Coudn't verify signature", 100);
		}
	}

	public function toArray()
	{
		return $this->data;
	}

	public function setArrayData($data)
	{
		$this->data = $data;
	}

	public function __get($key)
	{
		if(isset($this->data[$key])) {
			return $this->data[$key];
		}
	}
}

