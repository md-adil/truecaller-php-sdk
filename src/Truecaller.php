<?php
namespace Adil\Truecaller;

class Truecaller {

	function __construct()
	{

	}

	public function payload($payload)
	{
		return new Payload($this, $payload);
	}

	public function getKey()
	{
		return 'MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDEpFwIarbm48m6ueG+jhpt2vCGaqXZlwR/HPuL4zH1DQ/eWFbgQtVnrta8QhQz3ywLnbX6s7aecxUzzNJsTtS8VxKAYll4E1lJUqrNdWt8CU+TaUQuFm8vzLoPiYKEXl4bX5rzMQUMqA228gWuYmRFQnpduQTgnYIMO8XVUQXl5wIDAQAB';
	}
}
