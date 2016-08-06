<?php

namespace core\base;

use Core;

class Request extends Component
{
    /**
     * @return array
     * @throws NotFoundHttpException
     */
    public function resolve()
    {
        $result = $this->parseRequest();
        if ($result !== false) {
            return [$result, $this->getQueryParams()];
        } else {
            throw new NotFoundHttpException('Page not found.');
        }
    }

    /**
     * @return string
     */
    public function parseRequest()
    {
        $route = $this->getQueryParam('r', '');
        if (is_array($route)) {
            $route = '';
        }
        return (string) $route;
    }

    /**
     * @return mixed
     */
    public function getQueryParams()
    {
        return $_GET;
    }

    /**
     * @param $name
     * @param null $defaultValue
     * @return null
     */
    public function getQueryParam($name, $defaultValue = null)
    {
        $params = $this->getQueryParams();
        return isset($params[$name]) ? $params[$name] : $defaultValue;
    }
}
