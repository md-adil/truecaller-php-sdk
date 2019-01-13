<?php

use Adil\Truecaller\Exceptions\SignatureException;
use Adil\Truecaller\Payload;
use Adil\Truecaller\Truecaller;
use PHPUnit\Framework\TestCase;

class PayloadTest extends TestCase {
	protected $k = 'MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDEpFwIarbm48m6ueG+jhpt2vCGaqXZlwR/HPuL4zH1DQ/eWFbgQtVnrta8QhQz3ywLnbX6s7aecxUzzNJsTtS8VxKAYll4E1lJUqrNdWt8CU+TaUQuFm8vzLoPiYKEXl4bX5rzMQUMqA228gWuYmRFQnpduQTgnYIMO8XVUQXl5wIDAQAB';
	protected $p = 'eyJyZXF1ZXN0Tm9uY2UiOiJlNGMxNDU0Mi0wMmU5LTQzNmUtYTcxMC1mM2QyYjljOWQyYmYiLCJyZXF1ZXN0VGltZSI6MTUxMDI1MTg2MiwicGhvbmVOdW1iZXIiOiIrOTE4MTQ2ODE0MTg0IiwiZmlyc3ROYW1lIjoiWW9nZXNoIiwibGFzdE5hbWUiOiJTaW5naGFsIiwiZ2VuZGVyIjoiTiIsImNvdW50cnlDb2RlIjoiaW4iLCJlbWFpbCI6InNpbmdoYWwueW9nZXNoMDdAZ21haWwuY29tIiwiaXNUcnVlTmFtZSI6dHJ1ZSwiaXNBbWJhc3NhZG9yIjpmYWxzZX0=';
	protected $s = 'aC5XmkK5YCrNHjvmrOdwh2JFeh7gOlFXguFApTzfax281hGtlwoydDZX9JfK3tUxermuBUS3m+KL13FrN+TF1G0/vJ29Zk91yC0ASDPCOVF6RkU4x9DrlUP0jFZvqnIF4oSCGKPBquFp8KxnqEEWQ7fyrZJ/zVIUqeEn7VuzvYU=';


	public function testThrowSignatureException()
	{
		try {
			$t = new Truecaller();
			$t->setRSAKey('abcd');
			$t->payload($this->p)->verify('abc');
		} catch(\Exception $e) {
			$this->assertInstanceOf(SignatureException::class, $e);
			return;
		}
		throw new \Exception('Count test');
	}

	public function testVerifySignature()
	{
		$t = new Truecaller();
		$t->setRSAKey($this->k);
		$payload = $t->payload($this->p);
		$payload->verify($this->s);
		$this->assertTrue(!empty($payload->toArray()));
	}


	public function testGetSetData()
	{
		$truecaller = new Truecaller();
		$payload = new Payload($truecaller, '...');
		$payload->setArrayData(['name' => 'Adil']);
		$this->assertEquals($payload->name, 'Adil');
	}
}
