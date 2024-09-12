<?php

namespace integration\Identifier;

use Corbado\Exceptions\AssertException;
use Corbado\Exceptions\ConfigException;
use Corbado\Exceptions\ServerException;
use Corbado\Generated\Model\IdentifierCreateReq;
use Corbado\Generated\Model\IdentifierStatus;
use Corbado\Generated\Model\IdentifierType;
use Corbado\Generated\Model\IdentifierUpdateReq;
use integration\Utils;
use PHPUnit\Framework\TestCase;

class IdentifierCompleteTest extends TestCase
{
    /**
     * @throws ConfigException
     * @throws AssertException
     */
    public function testIdentifierComplete(): void
    {
        $existingUserID = Utils::createUser();
        $exception = null;

        // Test listing identifiers with invalid data
        try {
            Utils::SDK()->identifiers()->list('xxx');
        } catch (ServerException $e) {
            $exception = $e;
        }

        $this->assertNotNull($exception);
        $this->assertEquals(400, $exception->getHttpStatusCode());
        $this->assertEqualsCanonicalizing(['xxx: not sortable by this column'], $exception->getValidationMessages());

        // Test listing identifiers with no data returned
        $rsp = Utils::SDK()->identifiers()->list('', ['identifierType:eq:email', 'identifierValue:eq:' . Utils::createRandomTestEmail()]);
        $this->assertEquals(0, $rsp->getPaging()->getTotalItems());

        // Test deleting a non-existent identifier
        try {
            Utils::SDK()->identifiers()->delete($existingUserID, 'ide-123456789');
        } catch (ServerException $e) {
            $exception = $e;
        }

        $this->assertNotNull($exception);
        $this->assertEquals(400, $exception->getHttpStatusCode());
        $this->assertEqualsCanonicalizing(['identifierID: does not exist'], $exception->getValidationMessages());

        // Test updating a non-existent identifier
        try {
            $req = new IdentifierUpdateReq();
            // @phpstan-ignore-next-line
            $req->setStatus(IdentifierStatus::VERIFIED);

            Utils::SDK()->identifiers()->update($existingUserID, 'ide-123456789', $req);
        } catch (ServerException $e) {
            $exception = $e;
        }

        $this->assertNotNull($exception);
        $this->assertEquals(400, $exception->getHttpStatusCode());
        $this->assertEqualsCanonicalizing(['identifierID: does not exist'], $exception->getValidationMessages());

        // Test creating an identifier with invalid data
        try {
            $req = new IdentifierCreateReq();

            Utils::SDK()->identifiers()->create($existingUserID, $req);
        } catch (ServerException $e) {
            $exception = $e;
        }

        $this->assertNotNull($exception);
        $this->assertEquals(400, $exception->getHttpStatusCode());
        $this->assertEqualsCanonicalizing(['status: cannot be blank', 'identifierType: cannot be blank', 'identifierValue: cannot be blank'], $exception->getValidationMessages());

        // Test creating an identifier with valid data
        $req = new IdentifierCreateReq();
        // @phpstan-ignore-next-line
        $req->setIdentifierType(IdentifierType::EMAIL);
        $req->setIdentifierValue(Utils::createRandomTestEmail());
        // @phpstan-ignore-next-line
        $req->setStatus(IdentifierStatus::PENDING);

        $identifier = Utils::SDK()->identifiers()->create($existingUserID, $req);
        $this->assertTrue($identifier->getIdentifierId() != '');

        $existingIdentifierID = $identifier->getIdentifierId();
        $existingIdentifierValue = $identifier->getValue();

        // Test listing identifiers with data returned
        $rsp = Utils::SDK()->identifiers()->list('', ['identifierType:eq:email', 'identifierValue:eq:' . $existingIdentifierValue]);
        $this->assertEquals(1, $rsp->getPaging()->getTotalItems());

        // Test updating an existing identifier with valid data
        $req = new IdentifierUpdateReq();
        // @phpstan-ignore-next-line
        $req->setStatus(IdentifierStatus::VERIFIED);

        $identifier = Utils::SDK()->identifiers()->update($existingUserID, $existingIdentifierID, $req);
        $this->assertEquals(IdentifierStatus::VERIFIED, $identifier->getStatus());

        // Test deleting an existing identifier
        Utils::SDK()->identifiers()->delete($existingUserID, $existingIdentifierID);
    }
}
