<?php

declare(strict_types=1);

namespace JDecool\EnumPHPStan;

use PHPStan\{
    Reflection\ClassMemberReflection,
    Reflection\ClassReflection,
    Reflection\FunctionVariant,
    Reflection\MethodReflection,
    TrinaryLogic,
    Type\Generic\TemplateTypeMap,
    Type\ObjectType,
    Type\Type,
};

final class EnumMethodReflection implements MethodReflection
{
    public function __construct(
        private ClassReflection $classReflection,
        private string $name,
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrototype(): ClassMemberReflection
    {
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getVariants(): array
    {
        return [
            new FunctionVariant(
                TemplateTypeMap::createEmpty(),
                TemplateTypeMap::createEmpty(),
                [],
                false,
                new ObjectType($this->classReflection->getName()),
            ),
        ];
    }

    public function isDeprecated(): TrinaryLogic
    {
        return TrinaryLogic::createNo();
    }

    public function getDeprecatedDescription(): ?string
    {
        return null;
    }

    public function isFinal(): TrinaryLogic
    {
        return TrinaryLogic::createNo();
    }

    public function isInternal(): TrinaryLogic
    {
        return TrinaryLogic::createNo();
    }

    public function getThrowType(): ?Type
    {
        return null;
    }

    public function hasSideEffects(): TrinaryLogic
    {
        return TrinaryLogic::createNo();
    }

    public function getDeclaringClass(): ClassReflection
    {
        return $this->classReflection;
    }

    public function isStatic(): bool
    {
        return true;
    }

    public function isPrivate(): bool
    {
        return false;
    }

    public function isPublic(): bool
    {
        return true;
    }

    public function getDocComment(): ?string
    {
        return null;
    }
}
