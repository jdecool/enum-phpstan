<?php

declare(strict_types=1);

namespace JDecool\EnumPHPStan;

use JDecool\Enum\Enum;
use PHPStan\{
    Reflection\ClassReflection,
    Reflection\MethodReflection,
    Reflection\MethodsClassReflectionExtension,
};

final class EnumMethodsClassReflectionExtension implements MethodsClassReflectionExtension
{
    public function hasMethod(ClassReflection $classReflection, string $methodName): bool
    {
        if ($classReflection->isSubclassOf(Enum::class)) {
            return $classReflection->getNativeReflection()->hasConstant($methodName);
        }

        return false;
    }

    public function getMethod(ClassReflection $classReflection, string $methodName): MethodReflection
    {
        return new EnumMethodReflection($classReflection, $methodName);
    }
}
