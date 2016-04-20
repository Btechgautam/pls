<?php

/**
 * PLS API : PHP wrapper for the v1.0 MyFYBA PLS API
 *
 * PHP version 5.5 and above
 *
 * @category Private API
 * @package  MyFYBA PLS API
 * @author   Bhargav Nanekalva <bhargav3@gmail.com>
 * @license  MIT License
 * @version  1.0.4
 * @link     http://github.com/myfyba/pls
 */

namespace MyFYBA\PLS;

use Curl\Curl;

class API {

    /**
     * API constructor.
     * @param $settings
     * @throws
     */
    function __construct($settings) {

        if (!in_array('curl', get_loaded_extensions())) {
            throw new \Exception('You need to install cURL, see: http://curl.haxx.se/docs/install.html');
        }

        $this->key = $settings['key'];
        $this->id = $settings['id'];
        if (empty($settings['endpoint'])) {
            $this->endpoint = 'https://api.yachtmls.pro';
        } else {
            $this->endpoint = $settings['endpoint'];
        }

        $this->curl = new Curl();
        $this->curl->setHeader('X-API-KEY', $this->key);
        $this->curl->setHeader('X-CLIENT-ID', $this->id);
    }

    /**
     * @param $filters
     * @param $slug
     * @return string
     */
    private function url($filters, $slug) {
        $url = $this->endpoint;

        if (!empty($filters) && !is_numeric($filters)) {
            $url = $this->endpoint . '/' . $slug . '?' . $filters;
        } elseif (!empty($filters) && is_numeric($filters)) {
            $url = $this->endpoint . '/' . $slug . '/' . $filters;
        } elseif (!empty($slug)) {
            $url = $this->endpoint . '/' . $slug;
        }

        return $url;
    }

    /**
     * @return mixed
     */
    public function get_filters() {
        return $_SERVER["QUERY_STRING"];
    }

    /**
     * @param $filters
     * @return string
     */
    public function vessel($filters) {
        return $this->curl->get($this->url($filters, 'vessel'));
    }

    /**
     * @param $filters
     * @return string
     */
    public function charter($filters) {
        return $this->curl->get($this->url($filters, 'charter'));
    }

    /**
     * @param null $id
     * @return string
     */
    public function brokerage($id = null) {
        return $this->curl->get($this->url($filters = $id, 'brokerage'));
    }

}