<?php

use Adil\Truecaller\Payload;
use Adil\Truecaller\Truecaller;
use GuzzleHttp\Client as Guzzle;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class TruecallerTest extends TestCase {
	protected $truecaller;

	public function setUp()
	{
		$this->truecaller = new Truecaller();
	}

	function testPayloadReturnsPayloadInstance()
	{
		$data = 'abcd';
		$this->assertTrue($this->truecaller->payload($data) instanceOf Payload);
	}

	public function testFetchRSAKey()
	{
		$key = 'abcd';
		$client = $this->getMockBuilder(Guzzle::class)
			->setMethods(['get'])
			->getMock();

        $client->method('get')
            ->willReturn(new Response(200, [], json_encode([['key' => $key, 'keyType' => 'rsa']])));
		$truecaller = new Truecaller();
		$truecaller->setClient($client);
		$this->assertEquals($truecaller->fetchRSAKey(), $key);
	}

	public function testSetRSAKey()
	{
		$truecaller = new Truecaller();
		$key = 'abcd';
		$truecaller->setRSAKey($key);
		$this->assertSame($truecaller->getKey(), $key);
		$this->assertSame($truecaller->getKeyType(), 'rsa');
	}
}
