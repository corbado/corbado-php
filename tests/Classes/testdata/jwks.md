PHP code to generate JSON for jwks.json:

```php
$keyInfo = openssl_pkey_get_details(openssl_pkey_get_public($publicKey));
$jwks = [
    'keys' => [
        [
            'alg' => 'RS256',
            'kty' => 'RSA',
            'kid' => 'kid123',
            'n' => rtrim(str_replace(['+', '/'], ['-', '_'], base64_encode($keyInfo['rsa']['n'])), '='),
            'e' => rtrim(str_replace(['+', '/'], ['-', '_'], base64_encode($keyInfo['rsa']['e'])), '='),
        ],
    ],
];

echo json_encode($jwks);
```