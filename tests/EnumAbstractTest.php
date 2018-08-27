<?php
namespace Test\PHP7Enum;

use PHPUnit\Framework\TestCase;
use Test\PHP7Enum\Fixtures\StatusEnum;

/**
 * Class EnumAbstractTest
 */
class EnumAbstractTest extends TestCase
{
    /**
     * @test __callStatic
     */
    public function testCreateValue()
    {
        $draft = StatusEnum::DRAFT();
        $this->assertInstanceOf(StatusEnum::class, $draft);
        $this->assertEquals('draft', $draft->getValue());
        $this->assertEquals('draft', $draft->__toString());

        $this->assertEquals('valid', StatusEnum::VALID()->getValue());
        $this->assertEquals('deleted', StatusEnum::DELETED()->getValue());
    }

    public function testTwoCallsOfSameValueAreIdentical()
    {
        $this->assertSame(StatusEnum::DRAFT(), StatusEnum::DRAFT());
    }

    /**
     * @expectedException \PHP7Enum\UnexpectedValueException
     * @expectedExceptionMessage Invalid name "UNKNOWN" for enum "Test\PHP7Enum\Fixtures\StatusEnum"
     */
    public function testInvalidValue()
    {
        StatusEnum::UNKNOWN();
    }

    public function testFromValue()
    {
        $draft = StatusEnum::fromValue('draft');
        $this->assertInstanceOf(StatusEnum::class, $draft);
        $this->assertSame(StatusEnum::DRAFT(), $draft);
    }

    /**
     * @expectedException \PHP7Enum\UnexpectedValueException
     * @expectedExceptionMessage Invalid value "foobar" for enum "Test\PHP7Enum\Fixtures\StatusEnum"
     */
    public function testFromInvalidValue()
    {
        StatusEnum::fromValue('foobar');
    }

    /**
     * @throws \ReflectionException
     */
    public function testToArray()
    {
        $expected = [
            'DRAFT' => 'draft',
            'VALID' => 'valid',
            'DELETED' => 'deleted'
        ];
        $this->assertEquals($expected, StatusEnum::toArray());
    }
}
