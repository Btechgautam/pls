<?php

namespace MyFYBA\PLS;

use Curl\Curl;

class API {
    function __construct($settings) {

        if (!in_array('curl', get_loaded_extensions())) {
            throw new \Exception('You need to install cURL, see: http://curl.haxx.se/docs/install.html');
        }

        $this->key = $settings['key'];
        $this->id = $settings['id'];
        $this->curl = new Curl();
        $this->curl->setHeader('X-API-KEY', $this->key);
        $this->curl->setHeader('X-CLIENT-ID', $this->id);
    }

    public function vessel($host = "https://api.yachtmls.pro", $filters = null, $id = null) {
        $url = $host . '/vessel';
        return $this->curl->get($url);
    }
}