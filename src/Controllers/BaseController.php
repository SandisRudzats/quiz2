<?php


namespace Quiz\Controllers;

use Quiz\View;

/**
 * Class BaseController
 * @package Quiz\Controllers
 * @param string $viewName
 * @param array[] $params
 * @return string
 * @param string $viewName
 * @return View
 */
abstract class BaseController
{
    protected $template = 'default';
    protected $input;
    protected $repository;

    public function __construct()
    {
        $this->input = $_POST ?? [];
    }

    /**
     * @param string $viewName
     * @param array[] $params
     * @return string
     */
    protected function view(string $viewName, array $params = []): string
    {
        $view = $this->getView($viewName);
        return $view->render($params);
    }

    /**
     * @param string $viewName
     * @return View
     */
    protected function getView(string $viewName): View
    {
        return new View($viewName, $this->template);
    }
}