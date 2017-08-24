<?php

/**
 * PLS API : PHP wrapper for the v1.0 IYBA PLS API Wrapper
 *
 * PHP version 5.5 and above
 *
 * @category Private API
 * @package  IYBA PLS API
 * @author   Bhargav Nanekalva <bhargav3@gmail.com>
 * @license  MIT License
 * @version  1.0.4
 * @link     http://github.com/iyba/pls
 */

namespace IYBA\PLS;

use Curl\Curl;

class API
{

    /**
     * API constructor.
     * @param $settings
     * @throws
     */
    function __construct($settings)
    {

        if (!in_array('curl', get_loaded_extensions())) {
            throw new \Exception('You need to install cURL, see: http://curl.haxx.se/docs/install.html');
        }

        $this->key = $settings['key'];
        $this->id = $settings['id'];
        if (empty($settings['endpoint'])) {
            $this->endpoint = 'https://api.iyba.pro';
        } else {
            $this->endpoint = $settings['endpoint'];
        }

        $this->curl = new Curl();
        $this->curl->setHeader('X-API-KEY', $this->key);
        $this->curl->setHeader('X-CLIENT-ID', $this->id);
    }

    public function __call($method, $parameter)
    {
        $count = count($parameter);
        switch ($count) {
            case 1:
                return $this->curl->get($this->url($parameter[0], $method));
                break;
            case 2:
                return $this->curl->get($this->endpoint . '/' . $method . '/' . $parameter[0] . '?' . $parameter[1]);
                break;
            default:
                throw new \Exception("Bad argument");
        }
    }

    /**
     * @param $filters
     * @param $slug
     * @return string
     */
    private function url($filters, $slug)
    {
        return $this->endpoint . '/' . $slug . '?' . $filters;
    }

    /**
     * @return string
     */
    public function get_filters()
    {
        if (!empty($_SERVER["QUERY_STRING"])) {
            return $_SERVER["QUERY_STRING"];
        } else {
            return '';
        }
    }

    /**
     * @param null $id
     * @return string
     */
    public function brokerage($id = null)
    {
        return $this->curl->get($this->url($filters = $id, 'brokerage'));
    }

    /**
     * @param null $resource
     * @param null $filters
     * @return string
     */
    public function filters($resource = null, $filters = null)
    {
        return $this->curl->get($this->url($filters, 'filters/' . $resource));
    }
}
