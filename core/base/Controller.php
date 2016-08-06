<?php
namespace core\base;

use Core;

class Controller extends Component
{
    protected $_view;
    protected $_viewPath;

    public $id;
    public $action;
    public $layout;
    public $defaultAction = 'index';

    public function __construct($id, $config = [])
    {
        $this->id = $id;
        $this->configure($config);
    }

    public function init()
    {
        parent::init();
    }

    public function runAction($action, $params = [])
    {
        $this->action = $action ? $action : $this->defaultAction;
        $methodName = 'action' . str_replace(' ', '', ucwords(implode(' ', explode('-', $this->action))));

        $result = null;
        if (method_exists($this, $methodName)) {
            $result = call_user_func_array([$this, $methodName], $params);
        }

        return $result;
    }

    public function render($view, $params = [])
    {
        $viewFile = $this->findViewFile($view);
        $content = $viewFile ? $this->renderViewFile($viewFile, $params) : '';
        $layoutFile = $this->findLayoutFile();

        if ($layoutFile !== false) {
            return $this->renderContent($layoutFile, ['content' => $content]);
        } else {
            return $content;
        }
    }

    public function renderContent($viewFile, $params = [])
    {
        return $viewFile ? $this->renderViewFile($viewFile, $params) : '';
    }

    public function renderViewFile($_file_, $_params_ = [])
    {
        ob_start();
        ob_implicit_flush(false);
        extract($_params_, EXTR_OVERWRITE);
        require($_file_);

        return ob_get_clean();
    }

    public function getViewPath()
    {
        if ($this->_viewPath === null) {
            $this->_viewPath = Core::$app->getViewPath() . DIRECTORY_SEPARATOR . $this->id;
        }
        return $this->_viewPath;
    }

    public function setViewPath($path)
    {
        $this->_viewPath = $path;
    }

    protected function findLayoutFile()
    {
        $layout = $this->layout ? $this->layout : Core::$app->layout;
        if ($layout) {
            return Core::$app->getLayoutPath() . DIRECTORY_SEPARATOR . $layout . '.php';
        } else {
            return false;
        }
    }

    protected function findViewFile($view)
    {
        return $this->getViewPath() . DIRECTORY_SEPARATOR . $view . '.php';
    }
}
