<?php

namespace core\base;

use Core;

class Response extends Component
{
    private $_statusCode = 200;
    private $_statusText = 'OK';
    private $_headers = null;
    private $_cookies = null;

    public $exitStatus;
    public $isSent;
    public $data;

    public function send()
    {
        if ($this->isSent) {
            return;
        }
        $this->sendHeaders();
        $this->sendContent();
        $this->isSent = true;
    }

    public function sendHeaders()
    {
        if (headers_sent()) {
            return;
        }

        if ($this->_headers) {
            foreach ($this->getHeaders() as $name => $values) {
                $name = str_replace(' ', '-', ucwords(str_replace('-', ' ', $name)));
                $values = is_array($values) ? $values : [$values];
                $replace = true;
                foreach ($values as $value) {
                    header("$name: $value", $replace);
                    $replace = false;
                }
            }
        }

        $statusCode = $this->_statusCode;
        $statusText = $this->_statusText;
        header("HTTP/1.1 {$statusCode} {$statusText}");
        $this->sendCookies();
    }

    public function sendCookies()
    {
        foreach ($this->getCookies() as $cookie) {
            $name = isset($cookie['name']) ? $cookie['name'] : null;
            $value = isset($cookie['value']) ? $cookie['value'] : null;
            $expire = isset($cookie['expire']) ? $cookie['expire'] : null;
            $path = isset($cookie['path']) ? $cookie['path'] : null;
            $domain = isset($cookie['domain']) ? $cookie['domain'] : null;
            $secure = isset($cookie['secure']) ? $cookie['secure'] : null;
            $httpOnly = isset($cookie['httpOnly']) ? $cookie['httpOnly'] : null;
            setcookie($name, $value, $expire, $path, $domain, $secure, $httpOnly);
        }
    }

    public function sendContent()
    {
        echo $this->data;
    }

    public function getHeaders()
    {
        if ($this->_headers === null) {
            $this->_headers = [];
        }
        return $this->_headers;
    }

    public function setHeaders($headers)
    {
        $this->_headers = $headers;
    }

    public function getCookies()
    {
        return $this->_cookies ? $this->_cookies : [];
    }

    public function setCookies($cookies)
    {
        $this->_cookies = $cookies;
    }

    public function getStatusCode()
    {
        return $this->_statusCode;
    }

    public function setStatusCode($code, $text = null)
    {
        $this->_statusCode = $code;
        $this->_statusText = $text ? $text : '';
    }

    public function redirect($url, $statusCode = 302)
    {
        $headers = $this->getHeaders();
        if ($this->_headers !== null && is_array($this->_headers)) {
            $this->_headers['Location'] = $url;
        }
        $this->setStatusCode($statusCode);
        return $this;
    }
}
