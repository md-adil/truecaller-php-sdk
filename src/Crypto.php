<?php
namespace Adil\Truecaller\Crypt;

use Crypt_RSA;

class Crypto {
	protected $key;
	protected $rsa;
	function __construct($key) {
		$rsa = new Crypt_RSA(); 
		$rsa->setHash("sha512"); 
		$rsa->setSignatureMode(CRYPT_RSA_SIGNATURE_PKCS1); 
		$rsa->loadKey( $key );
		$this->rsa = $rsa;
		$this->key = $key;
	}

	
}
