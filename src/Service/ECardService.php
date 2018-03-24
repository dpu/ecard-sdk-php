<?php

namespace Org\DLPU\ECard\Service;

use Org\DLPU\ECard\BizImpl\ECardBizImpl;
use Org\DLPU\ECard\Exception\SystemException;

class ECardService
{
    private $bizImpl = null;

    public function __construct()
    {
        $this->bizImpl = new ECardBizImpl();
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
