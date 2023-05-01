<?php

use Corbado\Classes\Apis\ShortSessionInterface;
use Corbado\Configuration;
use Corbado\Exceptions\Assert;
use Corbado\SDK;
use PHPUnit\Framework\TestCase;

class SDKTest extends TestCase
{
    /**
     * @throws Assert
     * @throws \Corbado\Exceptions\Configuration
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    public function testGetUserGuest(): void
    {
        $shortSessionMock = $this->createMock(ShortSessionInterface::class);
        $shortSessionMock->expects($this->once())
                         ->method('validate')
                         ->willReturn(null);

        $config = new Configuration();
        $config->setProjectID('pro-1')
            ->setApiSecret('43jlk5j43lk5j34kl');

        $sdk = new SDK($config);
        $sdk->setShortSession($shortSessionMock);

        $user = $sdk->getUser();
        $this->assertFalse($user->isAuthenticated());

        // Fake cookie (JWT is irrelevant here because we mock the ShortSessionInterface)
        $_COOKIE[$config->getShortSessionCookieName()] = '1234567890';

        $user = $sdk->getUser();
        $this->assertFalse($user->isAuthenticated());

        unset($_COOKIE[$config->getShortSessionCookieName()]);
    }

    /**
     * @throws Assert
     * @throws \Corbado\Exceptions\Configuration
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    public function testGetUserAuthenticated(): void
    {
        $shortSessionMock = $this->createMock(ShortSessionInterface::class);
        $shortSessionMock->expects($this->exactly(2))
                         ->method('validate')
                         ->willReturn((object) ['sub' => 'user-1']);

        $config = new Configuration();
        $config->setProjectID('pro-1')
               ->setApiSecret('43jlk5j43lk5j34kl');

        $sdk = new SDK($config);
        $sdk->setShortSession($shortSessionMock);

        // Fake cookie (JWT is irrelevant here because we mock the ShortSessionInterface)
        $_COOKIE[$config->getShortSessionCookieName()] = '1234567890';

        $user = $sdk->getUser();
        $this->assertTrue($user->isAuthenticated());

        unset($_COOKIE[$config->getShortSessionCookieName()]);

        // Fake Authorization header (JWT is irrelevant here because we mock the ShortSessionInterface)
        $_SERVER['HTTP_AUTHORIZATION'] = 'Bearer 1234567890';

        $user = $sdk->getUser();
        $this->assertTrue($user->isAuthenticated());

        unset($_SERVER['HTTP_AUTHORIZATION']);
    }
}
