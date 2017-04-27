<?php

namespace Cn\Xu42\DlpuEcard\Service;

use Cn\Xu42\DlpuEcard\BizImpl\DlpuEcardBizImpl;
use Cn\Xu42\DlpuEcard\Exception\SystemException;

class DlpuEcardService
{
    private $bizImpl = null;

    public function __construct()
    {
        $this->bizImpl = new DlpuEcardBizImpl();
    }

    public function getBalance($username)
    {
        try {
            return $this->bizImpl->getBalance($username);
        } catch (\Throwable $throwable) {
            throw new SystemException($throwable->getMessage(), $throwable->getCode());
        }
    }

    public function getConsumption($username)
    {
        try {
            return $this->bizImpl->getConsumption($username);
        } catch (\Throwable $throwable) {
            throw new SystemException($throwable->getMessage(), $throwable->getCode());
        }
    }

}
