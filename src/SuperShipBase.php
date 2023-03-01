<?php

namespace SuperShip;

use SuperShip\SuperShipEndpoint;

class SuperShipBase
{
    protected $accessToken;

    protected $fullUrl;

    public function getAccessToken()
    {
        return $this->accessToken;
    }

    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;
    }

    public function getBaseUrl()
    {
        return SuperShipEndpoint::BASE_URL;
    }

    public function getFullUrl()
    {
        return $this->fullUrl;
    }

    public function setFullUrl($type, $path = '')
    {
        $category = '';
        switch ($type) {
            case 'areas':
                $category = SuperShipEndpoint::AREAS;
                break;

            case 'auth':
                $category = SuperShipEndpoint::AUTH;
                break;

            case 'orders':
                $category = SuperShipEndpoint::ORDERS;
                break;

            case 'warehouses':
                $category = SuperShipEndpoint::WAREHOUSES;
                break;

            case 'webhooks':
                $category = SuperShipEndpoint::WEBHOOKS;
                break;
            
            default:
                break;
        }

        $fullUrl = $this->getBaseUrl().$category;
        if ($path != '') {
            $fullUrl = $this->getBaseUrl().$category.'/'.$path;
        }
        
        $this->fullUrl = $fullUrl;
    }

    protected function getHeaders()
    {
        return [
            'Content-Type: application/json',
            'Authorization: Bearer '.$this->getAccessToken()
        ];
    }

    public function get($url)
    {
        try {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL            => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING       => '',
                CURLOPT_MAXREDIRS      => 10,
                CURLOPT_TIMEOUT        => 30,
                CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST  => 'GET',
                CURLOPT_HTTPHEADER     => $this->getHeaders(),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            if (!empty($err)) {
                return json_decode($err, true);
            }

            return json_decode($response, true);
        } catch (\Exception $exception) {
            return [
                'code'    => $exception->getCode(),
                'message' => $exception->getMessage(),
            ];
        }
    }

    public function post($url, $params)
    {
        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $this->getHeaders());
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $response = curl_exec($ch);
            $err = curl_error($ch);
            curl_close($ch);

            if (!empty($err)) {
                return json_decode($err, true);
            }

            return json_decode($response, true);
        } catch (\Exception $exception) {
            return [
                'code'    => $exception->getCode(),
                'message' => $exception->getMessage(),
            ];
        }
    }
}
