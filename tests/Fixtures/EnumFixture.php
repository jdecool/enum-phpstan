<?php

declare(strict_types=1);

namespace JDecool\EnumPHPStan\Test\Fixtures;

use JDecool\Enum\Enum;

class EnumFixture extends Enum
{
    const MEMBER = 'member';

    public const PUBLIC_CONST = 'public';
    protected const PROTECTED_CONST = 'protected';
    private const PRIVATE_CONST = 'private';
}
