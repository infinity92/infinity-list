<?php


namespace App\Enums;


class CompletionStatusEnum extends \SplEnum
{
    const __default = self::SUCCESS;

    const SUCCESS = 'success';
    const CANCEL = 'cancel';
}
