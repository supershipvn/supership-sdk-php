<?php

namespace SuperShip;

use SuperShip\SuperShipEndpoint;

class SuperShipClient extends SuperShipBase
{
    public function __construct($accessToken)
    {
        $this->accessToken = $accessToken;
    }

    public function getProvinces()
    {
        $this->setFullUrl('areas', 'province');
        $url = $this->getFullUrl();

        return $this->get($url);
    }

    public function getDistricts($provinceCode = '')
    {
        $this->setFullUrl('areas', 'district?province='.$provinceCode);
        $url = $this->getFullUrl();

        return $this->get($url);
    }

    public function getCommunes($districtCode = '')
    {
        $this->setFullUrl('areas', 'commune?district='.$districtCode);
        $url = $this->getFullUrl();

        return $this->get($url);
    }

    public function retrieveToken($params = [])
    {
        $this->setFullUrl('auth', 'login');
        $url = $this->getFullUrl();

        return $this->post($url, json_encode($params));
    }

    public function createUser($params = [])
    {
        $this->setFullUrl('auth', 'register');
        $url = $this->getFullUrl();

        return $this->post($url, json_encode($params));
    }

    public function getOrderFee($params = [])
    {
        $queryString = http_build_query($params);

        $this->setFullUrl('orders', 'price?'.$queryString);
        $url = $this->getFullUrl();

        return $this->post($url, json_encode($params));
    }

    public function createOrder($params = [])
    {
        $this->setFullUrl('orders', 'add');
        $url = $this->getFullUrl();

        return $this->post($url, json_encode($params));
    }

    public function getOrderInfo($code = '', $type = '1')
    {
        $params = [
            'code' => $code,
            'type' => $type
        ];

        $queryString = http_build_query($params);

        $this->setFullUrl('orders', 'info?'.$queryString);
        $url = $this->getFullUrl();

        return $this->get($url);
    }

    public function getOrderStatuses()
    {
        $this->setFullUrl('orders', 'status');
        $url = $this->getFullUrl();

        return $this->get($url);
    }

    public function createPrintToken($params = [])
    {
        $this->setFullUrl('orders', 'token');
        $url = $this->getFullUrl();

        return $this->post($url, json_encode($params));
    }

    public function getPrintLink($printToken = '', $sizeLabel = 'K46')
    {
        $params = [
            'token' => $printToken,
            'size' => $sizeLabel
        ];

        $queryString = http_build_query($params);

        $this->setFullUrl('orders', 'label?'.$queryString);
        $url = $this->getFullUrl();

        header('Location: '.$url);
        exit();
    }

    public function getWarehouses()
    {
        $this->setFullUrl('warehouses');
        $url = $this->getFullUrl();

        return $this->get($url);
    }

    public function createWarehouse($params = [])
    {
        $this->setFullUrl('warehouses', 'create');
        $url = $this->getFullUrl();

        return $this->post($url, json_encode($params));
    }

    public function editWarehouse($params = [])
    {
        $this->setFullUrl('warehouses', 'update');
        $url = $this->getFullUrl();

        return $this->post($url, json_encode($params));
    }

    public function getWebhooks()
    {
        $this->setFullUrl('webhooks');
        $url = $this->getFullUrl();

        return $this->get($url);
    }

    public function registerWebhook($partnerUrl = '')
    {
        $this->setFullUrl('webhooks', 'create');
        $url = $this->getFullUrl();

        $params = [
            'url' => $partnerUrl
        ];

        return $this->post($url, json_encode($params));
    }
}
