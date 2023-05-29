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
                         ->method('getValue')
                         ->willReturn('');

        $config = new Configuration();
        $config->setProjectID('pro-1')
            ->setApiSecret('43jlk5j43lk5j34kl');

        $sdk = new SDK($config);
        $sdk->setShortSession($shortSessionMock);

        $user = $sdk->getUser();
        $this->assertFalse($user->isAuthenticated());
    }

    /**
     * @throws Assert
     * @throws \Corbado\Exceptions\Configuration
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    public function testGetUserAuthenticated(): void
    {
        $shortSessionMock = $this->createMock(ShortSessionInterface::class);
        $shortSessionMock->expects($this->once())
            ->method('getValue')
            ->willReturn('1234567890'); // Does not have to be a valid JWT because validate() is mocked (see below)
        $shortSessionMock->expects($this->once())
                         ->method('validate')
                         ->willReturn((object)['sub' => 'user-1', 'email' => 'email@email.com', 'name' => 'name']);

        $config = new Configuration();
        $config->setProjectID('pro-1')
               ->setApiSecret('43jlk5j43lk5j34kl');

        $sdk = new SDK($config);
        $sdk->setShortSession($shortSessionMock);

        $user = $sdk->getUser();
        $this->assertTrue($user->isAuthenticated());
    }
}
