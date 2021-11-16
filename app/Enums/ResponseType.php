<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class ResponseType extends Enum
{
    const YesOrNo = 1;
    const ShortOpenQuestion = 2;
    const LongOpenQuestion = 3;
}
