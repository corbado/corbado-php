<?php

use Corbado\Classes\Exceptions\Assert;
use Corbado\Classes\SessionInterface;
use Corbado\Configuration;
use Corbado\SDK;
use PHPUnit\Framework\TestCase;

class SDKTest extends TestCase
{
    /**
     * @throws Assert
     * @throws \Corbado\Classes\Exceptions\Configuration
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    public function testGetUserGuest(): void
    {
        $shortSessionMock = $this->createMock(SessionInterface::class);
        $shortSessionMock->expects($this->once())
                         ->method('getShortSessionValue')
                         ->willReturn('');

        $config = new Configuration();
        $config->setProjectID('pro-1')
            ->setApiSecret('43jlk5j43lk5j34kl');

        $sdk = new SDK($config);
        $sdk->setSession($shortSessionMock);

        $user = $sdk->getUser();
        $this->assertFalse($user->isAuthenticated());
    }

    /**
     * @throws Assert
     * @throws \Corbado\Classes\Exceptions\Configuration
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    public function testGetUserAuthenticated(): void
    {
        $shortSessionMock = $this->createMock(SessionInterface::class);
        $shortSessionMock->expects($this->once())
            ->method('getShortSessionValue')
            ->willReturn('1234567890'); // Does not have to be a valid JWT because validate() is mocked (see below)
        $shortSessionMock->expects($this->once())
                         ->method('validateShortSessionValue')
                         ->willReturn((object)['sub' => 'user-1', 'name' => 'name', 'email' => 'email@email.com', 'phoneNumber' => '+4915112484045']);

        $config = new Configuration();
        $config->setProjectID('pro-1')
               ->setApiSecret('43jlk5j43lk5j34kl');

        $sdk = new SDK($config);
        $sdk->setSession($shortSessionMock);

        $user = $sdk->getUser();
        $this->assertTrue($user->isAuthenticated());
    }
}
