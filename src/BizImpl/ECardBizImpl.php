<?php

namespace Org\DLPU\ECard\BizImpl;

use Org\DLPU\ECard\Exception\ArgumentException;
use Org\DLPU\ECard\Exception\SystemException;

class ECardBizImpl
{

    const URL_BALANCE = 'http://210.30.62.32/ecard/yue.php';
    const URL_CONSUMPTION = 'http://210.30.62.32/ecard/sumconsumer.php';

    public function getBalance($username)
    {
        if (empty($username)) throw new ArgumentException('账号密码不能为空');

        $postData = "user_outid=$username";
        $balanceJson = $this->curlRequest(self::URL_BALANCE, $postData);
        $balanceArray = json_decode(trim($balanceJson, chr(239) . chr(187) . chr(191)), true);

        if (isset($balanceArray['success']) && $balanceArray['success'] == 0) {
            return [
                'name' => $balanceArray['name'],
                'balance' => $balanceArray['oddfare']
            ];
        } else {
            throw new SystemException('查询出错，请重试');
        }
    }

    public function getConsumption($username)
    {
        $postData = "user_outid=$username";
        $consumptionJson = $this->curlRequest(self::URL_CONSUMPTION, $postData);
        $consumptionArray = json_decode(trim($consumptionJson, chr(239) . chr(187) . chr(191)), true);

        if ($consumptionArray['success'] == 0) {
            return [
                'name' => $consumptionArray['name'],
                'consumption' => $consumptionArray['sumconsumer'],
                'ranking' => $consumptionArray['sumseq']
            ];
        } else {
            throw new SystemException('查询出错，请重试');
        }
    }

    private function curlRequest($url, $postData)
    {
        (empty($postData)) ? $isPost = false : $isPost = true;
        $headers = array('Content-Length:' . strlen($postData), 'Referer:' . self::URL_BALANCE, 'User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.80 Safari/537.36');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 3);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, $isPost);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        $curlResponse = curl_exec($ch);
        if ($curlResponse === false) throw new SystemException('网络请求失败');
        return $curlResponse;
    }
}


