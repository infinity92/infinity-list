<?php


namespace App\Enums;


class CompletionStatusEnum extends Enum
{
    const __default = self::SUCCESS;

    const SUCCESS = 'success';
    const CANCEL = 'cancel';
}
