<?php

namespace Xu42\DlpuEcard;


/**
 * 大连工业大学校园卡
 * Class DlpuEcard
 * @package Xu42\DlpuEcard
 */
class DlpuEcard
{
    private $outid;
    private $urlBalance     = 'http://210.30.62.32/ecard/yue.php';
    private $urlSumconsumer = 'http://210.30.62.32/ecard/sumconsumer.php';

    /**
     * DlpuEcard constructor.
     * @param $username
     */
    public function __construct( $username )
    {
        $this->outid = $username;
    }


    /**
     * 校园卡余额
     * @return array
     */
    public function getBalance()
    {
        $postData     = ['user_outid' => $this->outid];
        $balanceJson  = $this->myCurl( $this->urlBalance, $postData );
        $balanceArray = json_decode( trim( $balanceJson, chr( 239 ) . chr( 187 ) . chr( 191 ) ), true );

        $balance = [];

        if ( !$balanceArray ) {
            $balance = ['status' => 500, 'message' => 'Internal server error', 'data' => []];
        }

        if ( $balanceArray['success'] == 0 ) {
            $balance = [
                'status'  => 200,
                'message' => 'success',
                'data'    => [
                    'name'    => $balanceArray['name'],
                    'oddfare' => $balanceArray['oddfare']
                ]
            ];
        }

        return $balance;
    }


    /**
     * 校园卡消费总额
     * @return array
     */
    public function getSumconsumer()
    {
        $postData         = ['user_outid' => $this->outid];
        $sumconsumerJson  = $this->myCurl( $this->urlSumconsumer, $postData );
        $sumconsumerArray = json_decode( trim( $sumconsumerJson, chr( 239 ) . chr( 187 ) . chr( 191 ) ), true );

        $sumconsumer = [];

        if ( !$sumconsumerArray ) {
            $sumconsumer = ['status' => 500, 'message' => 'Internal server error', 'data' => []];
        }

        if ( $sumconsumerArray['success'] == 0 ) {
            $sumconsumer = [
                'status'  => 200,
                'message' => 'success',
                'data'    => [
                    'name'        => $sumconsumerArray['name'],
                    'sumconsumer' => $sumconsumerArray['sumconsumer'],
                    'ranking'     => $sumconsumerArray['sumseq']
                ]
            ];
        } else {
            $sumconsumer = [
                'status'  => 404,
                'message' => 'Not found',
                'data'    => []
            ];
        }


        return $sumconsumer;
    }


    /**
     * 简单封装的get网络请求助手
     * @param $url
     * @return mixed
     */
    private function myCurl( $url, $postData )
    {
        $ch = curl_init();
        curl_setopt( $ch, CURLOPT_URL, $url );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, 5 );
        curl_setopt( $ch, CURLOPT_POST, true );
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $postData );
        curl_setopt( $ch, CURLOPT_USERAGENT, 'Dalvik/1.6.0 (Linux; U; Android 4.4.4; oppo r9 Build/KTU84P)' );
        $webPage = curl_exec( $ch );
        curl_close( $ch );
        return $webPage;
    }

}
