<?php

namespace Ggss\Upload\Exceptions;

use Exception;


class DatabaseException extends Exception
{
    public static function create(): self
    {
        return new static("数据保存失败");
    }
}
