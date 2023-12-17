<?php

namespace integration\User;

use Corbado\Classes\Exceptions\AssertException;
use Corbado\Classes\Exceptions\ConfigurationException;
use Corbado\Classes\Exceptions\ServerException;
use Corbado\Generated\Model\UserCreateReq;
use integration\Utils;
use PHPUnit\Framework\TestCase;

class UserCreateTest extends TestCase
{
    /**
     * @throws AssertException
     * @throws ConfigurationException
     */
    public function testUserCreateValidationError(): void
    {
        $exception = null;

        try {
            $req = new UserCreateReq();
            $req->setName('');
            $req->setEmail('');

            Utils::SDK()->users()->create($req);
        } catch (ServerException $e) {
            $exception = $e;
        }

        $this->assertNotNull($exception);
        $this->assertEquals(400, $exception->getHttpStatusCode());
        $this->assertEquals(['name: cannot be blank'], $exception->getValidationMessages());
    }

    /**
     * @throws AssertException
     * @throws ConfigurationException
     */
    public function testUserCreateSuccess(): void
    {
        $req = new UserCreateReq();
        $req->setName(Utils::createRandomTestName());
        $req->setEmail(Utils::createRandomTestEmail());

        $rsp = Utils::SDK()->users()->create($req);
        $this->assertEquals(200, $rsp->getHttpStatusCode());
    }
}
