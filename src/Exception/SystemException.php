<?php

namespace Cn\Xu42\DlpuEcard\Exception;

class SystemException extends BaseException
{
    public $message = '快递追踪查询系统异常';

    public $code = '42106000';
}
