# Truecaller unofficial server side validation for truecaller authentication module


#### Installation

Composer is the best friend to install any php libraries / dependancies with their dependancies.
If you haven't already installed then follow the link
[Composer](https://getcomposer.org/)

Then run following command in your terminal/command prompt where your application is installed.

```composer
composer require md-adil/truecaller-php-sdk dev-master
```

At the very top use Truecaller library to make composer autoload.

    use Adil\Truecaller\Truecaller;
    use Adil\Truecaller\Exceptions\SignatureException;

Verify Your token and signature

```php
$truecaller = new Truecaller(/* optional config [] */);

// set public key you can hardcode key from 
// https://api4.truecaller.com/v1/key

$truecaller->setRSAKey($truecaller->fetchRSAKey());
// Payload from sdk response.
$payload = $truecaller->payload($_POST['payload']);

try {
    // verify payload signature 
    $payload->verify($_POST['signature'])

    $payload->phoneNumber // User phone number always return number
    // complete payload
    // requestNonce: e4c14542-02e9-436e-a710-f3d2b9c9d2bf
    // requestTime: 1510251862
    // phoneNumber: +918146814184
    // firstName: Yogesh
    // lastName: Singhal
    // gender: N
    // countryCode: in
    // email: singhal.yogesh07@gmail.com
    // isTrueName: 1
    // isAmbassador:
} catch(SignatureException $e) {
    $error = $e->getMessage(); // Coudnt verify signature
}

```

I appreciate your feedback. If you find any issues please don't forget to letme know either mail me or create github issue. if you like my efforts please dont forget to give star.

## Thank you :)

