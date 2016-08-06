<?php
namespace core\base;

use Core;
use core\db\Connection;

class Application extends Component
{
    private $_basePath;
    private $_viewPath;
    private $_layoutPath;
    private $_request;
    private $_response;
    private $_db;

    public $controllerNamespace = 'core\\controllers';
    public $defaultRoute = 'default';
    public $layout = 'main';
    public $currentRoute;
    public $controller;

    public $params = [];

    public function __construct($config = [])
    {
        Core::$app = $this;
        $this->bootstrap($config);

        parent::__construct($config);
    }

    /**
     * Run the application.
     * @param array $config
     * @return int
     */
    public function run($config = [])
    {
        try {
            $response = $this->handleRequest($this->getRequest());
            $response->send();
            return $response->exitStatus;
        } catch (TerminateException $e) {
            $this->end($e->statusCode);
            return $e->statusCode;
        }
    }

    /**
     * @param $request Request
     * @return Response
     * @throws NotFoundHttpException
     */
    public function handleRequest($request)
    {
        list ($route, $params) = $request->resolve();
        try {
            $this->currentRoute = $route;
            $result = $this->runAction($route, $params);
            if ($result instanceof Response) {
                return $result;
            } else {
                $response = $this->getResponse();
                if ($result !== null) {
                    $response->data = $result;
                }
                return $response;
            }
        } catch (InvalidRouteException $e) {
            throw new NotFoundHttpException('Page not found.');
        }
    }

    /**
     * @return Request
     */
    public function getRequest()
    {
        if ($this->_request === null) {
            $this->_request = new Request();
        }
        return $this->_request;
    }

    /**
     * @return Response
     */
    public function getResponse()
    {
        if ($this->_response === null) {
            $this->_response = new Response();
        }
        return $this->_response;
    }

    public function getBasePath()
    {
        if ($this->_basePath === null) {
            $this->_basePath = dirname(CORE_PATH);
        }

        return $this->_basePath;
    }

    public function setBasePath($path)
    {
        $p = realpath($path);
        if ($p !== false && is_dir($p)) {
            $this->_basePath = $p;
        } else {
            throw new \InvalidArgumentException("The directory does not exist: $path");
        }
    }

    public function getViewPath()
    {
        if ($this->_viewPath === null) {
            $this->_viewPath = $this->getBasePath() . DIRECTORY_SEPARATOR . 'views';
        }
        return $this->_viewPath;
    }

    public function setViewPath($viewPath)
    {
        $this->_viewPath = $viewPath;
    }

    public function getLayoutPath()
    {
        if ($this->_layoutPath === null) {
            $this->_layoutPath = $this->getViewPath() . DIRECTORY_SEPARATOR . 'layouts';
        }
        return $this->_layoutPath;
    }

    public function setLayoutPath($path)
    {
        $this->_layoutPath = $path;
    }

    /**
     * @return \core\db\Connection
     * @throws \Exception
     */
    public function getDb()
    {
        if ($this->_db === null) {
            throw new \Exception('Database is not configured');
        }
        return $this->_db;
    }

    public function setDb($db)
    {
        $this->_db = $db;
    }

    public function runAction($route, $params)
    {
        // [$controller, $route]
        $parts = $this->createController($route);
        if (is_array($parts)) {
            /* @var $controller Controller */
            list($controller, $action) = $parts;
            Core::$app->controller = $controller;
            $result = $controller->runAction($action, $params);

            if ($result instanceof Response) {
                return $result;
            } else {
                $response = $this->getResponse();
                if ($result !== null) {
                    $response->data = $result;
                }
                return $response;
            }
        } else {
            throw new InvalidRouteException('Unable to resolve the request.');
        }
    }

    public function createController($route)
    {
        $route = $route == '' ? $this->defaultRoute : $route;
        $route = trim($route, '/');

        if (strpos($route, '/') !== false) {
            list ($id, $route) = explode('/', $route, 2);
        } else {
            $id = $route;
            $route = '';
        }

        $controller = $this->createControllerById($id);

        return $controller === null ? false : [$controller, $route];
    }

    public function end($status = 0)
    {
        exit($status);
    }

    protected function createControllerById($id)
    {
        $className = $id;
        $className = str_replace(' ', '', ucwords(str_replace('-', ' ', $className))) . 'Controller';
        $className = ltrim($this->controllerNamespace . '\\' . $className, '\\');

        if (strpos($className, '-') !== false || !class_exists($className)) {
            return null;
        }

        if (is_subclass_of($className, 'core\base\Controller')) {
            $controller = new $className($id);
            return get_class($controller) === $className ? $controller : null;
        } else {
            return null;
        }
    }

    /** @inheritdoc */
    protected function configure($config = [])
    {
        if (isset($config['defaultRoute'])) {
            $this->defaultRoute = $config['defaultRoute'];
        }
        if (isset($config['layout'])) {
            $this->layout = $config['layout'];
        }
        if (isset($config['viewPath'])) {
            $this->_viewPath = $config['viewPath'];
        }

        if (isset($config['db'])) {
            $db = new Connection($config['db']);
            $db->connect();
            $this->setDb($db);
        }
    }

    protected function bootstrap($config = [])
    {

    }
}
