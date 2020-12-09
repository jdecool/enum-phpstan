<?php

declare(strict_types=1);

namespace JDecool\EnumPHPStan\Test;

use JDecool\EnumPHPStan\{
    EnumMethodReflection,
    EnumMethodsClassReflectionExtension,
    Test\Fixtures\EnumFixture,
};
use PHPStan\{
    Broker\Broker,
    Reflection\ParametersAcceptorSelector,
    Testing\TestCase,
    Type\VerbosityLevel,
};

class EnumMethodsClassReflectionExtensionTest extends TestCase
{
    private Broker $broker;
    private EnumMethodsClassReflectionExtension $reflectionExtension;

    protected function setUp(): void
    {
        parent::setUp();

        $this->broker = $this->createBroker();
        $this->reflectionExtension = new EnumMethodsClassReflectionExtension();
    }

    /**
     * @covers ::hasMethod
     * @dataProvider methodNameDataProvider
     */
    public function testEnumMethodsCanBeFoundInEnumSubclasses(bool $expected, string $methodName)
    {
        $classReflection = $this->broker->getClass(EnumFixture::class);
        $hasMethod = $this->reflectionExtension->hasMethod($classReflection, $methodName);

        static::assertEquals($expected, $hasMethod);
    }

    /**
     * @covers ::hasMethod
     */
    public function testEnumMethodsCannotBeFoundInNonEnumSubclasses()
    {
        $classReflection = $this->broker->getClass(EnumFixture::class);
        $hasMethod = $this->reflectionExtension->hasMethod($classReflection, 'SOME_NAME');

        static::assertFalse($hasMethod);
    }

    /**
     * @covers ::getMethod
     * @uses EnumMethodReflection
     */
    public function testEnumMethodReflectionCanBeObtained()
    {
        $classReflection = $this->broker->getClass(EnumFixture::class);
        $methodReflection = $this->reflectionExtension->getMethod($classReflection, 'SOME_NAME');

        static::assertInstanceOf(EnumMethodReflection::class, $methodReflection);
    }

    /**
     * @covers EnumMethodReflection::getName
     * @covers EnumMethodReflection::getDeclaringClass
     * @covers EnumMethodReflection::isStatic
     * @covers EnumMethodReflection::isPrivate
     * @covers EnumMethodReflection::isPublic
     * @covers EnumMethodReflection::getPrototype
     * @covers EnumMethodReflection::getVariants
     * @uses EnumMethodReflection
     * @dataProvider enumFixtureProperties
     */
    public function testEnumMethodProperties(string $propertyName)
    {
        $classReflection = $this->broker->getClass(EnumFixture::class);
        $methodReflection = $this->reflectionExtension->getMethod($classReflection, $propertyName);
        $parametersAcceptor = ParametersAcceptorSelector::selectSingle($methodReflection->getVariants());

        static::assertSame($propertyName, $methodReflection->getName());
        static::assertSame($classReflection, $methodReflection->getDeclaringClass());
        static::assertTrue($methodReflection->isStatic());
        static::assertFalse($methodReflection->isPrivate());
        static::assertTrue($methodReflection->isPublic());
        static::assertSame(EnumFixture::class, $parametersAcceptor->getReturnType()->describe(VerbosityLevel::value()));
    }

    public function methodNameDataProvider(): iterable
    {
        yield [true, 'MEMBER'];
        yield [false, 'NOT_A_MEMBER'];
    }

    public function enumFixtureProperties(): iterable
    {
        yield ['MEMBER'];
        yield ['PUBLIC_CONST'];
        yield ['PROTECTED_CONST'];
        yield ['PRIVATE_CONST'];
    }
}
