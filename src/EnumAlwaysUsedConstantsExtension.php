<?php

declare(strict_types=1);

namespace JDecool\EnumPHPStan;

use JDecool\Enum\Enum;
use PHPStan\Reflection\ConstantReflection;
use PHPStan\Rules\Constants\AlwaysUsedClassConstantsExtension;

class EnumAlwaysUsedConstantsExtension implements AlwaysUsedClassConstantsExtension
{
    public function isAlwaysUsed(ConstantReflection $constant): bool
    {
        return $constant->getDeclaringClass()->isSubclassOf(Enum::class);
    }
}
