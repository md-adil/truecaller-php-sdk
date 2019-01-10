<?php
namespace Adil\Truecaller;

use phpseclib\Crypt\RSA;

class Payload {
	protected $payload;
	protected $data = [];

	protected $app;

	function __construct(Truecaller $app, $payload)
	{
		$this->app = $app;
		$this->payload = $payload;
	}

	public function isValid($signature)
	{
		$rsa = new RSA(); 
		$rsa->setHash("sha512"); 
		$rsa->setSignatureMode(RSA::SIGNATURE_PKCS1); 
		$rsa->loadKey( $this->app->getKey() );
		// $verify = $rsa->verify( base64_decode($package), base64_decode($signature) ); 
		if($rsa->verify( $this->payload, base64_decode($signature) ) ) {
			$package = base64_decode($this->payload);
			$this->data = json_decode($package, 1);
			return true;
		}
		return false;
	}

	public function toArray()
	{
		return $this->data;
	}

	public function __get($key)
	{
		if(isset($this->data[$key])) {
			return $this->data[$key];
		}
		return $def;
	}
}

