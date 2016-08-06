<?php

namespace core\base;

use Core;

class Response extends Component
{
    protected $_statusCode = 200;
    protected $_statusText = 'OK';

    protected $_headers = null;
    protected $_cookies = null;

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
}
