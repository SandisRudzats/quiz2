<?php

namespace Quiz;

class View
{
    /** @var string */
    protected $viewFile;
    /** @var string */
    protected $templateFile;
    /** @var string */
    protected $js = '';
    /** @var string[] */
    public $jsFiles = [];
    /** @var string[]  */
    public $cssFiles = [];

    public function __construct(string $viewName, string $templateName)
    {
        $this->viewFile = $this->getViewFilePath($viewName);
        $this->templateFile = $this->getViewFilePath($templateName, TEMPLATE_BASE_FOLDER);
    }

    protected function getViewFilePath(string $viewName, string $baseDir = VIEW_BASE_FOLDER): string
    {
        return $baseDir . DS . $viewName . '.php';
    }

    public function render(array $params = []): string
    {
        return $this->getFileContents($this->templateFile, $params);
    }


    public function renderContent(array $params = []): string
    {
        return $this->getFileContents($this->viewFile, $params);


    }

    protected function getFileContents(string $fileName, array $params = []): string
    {
        extract($params);
        $content = '';


        if (!empty($fileName) && file_exists($fileName)) {
            ob_start();
            include "$fileName";
            $content = ob_get_clean();
        }
        return $content;
    }

    /**
     * @param string $js
     */
    protected function registerJs(string $js)
    {
        $this->js .= $js;

    }

    /**
     * @param string $fileName
     */
    public function registerJsFile(string $fileName)
    {
        $this->jsFiles[] = $fileName;
    }

    /**
     * @param string $fileName
     */
    public function registerCssFile(string $fileName)
    {
        $this->cssFiles[] = $fileName;
    }

    /**
     * @param string $viewName
     * @param array[] $params
     * @return string
     */
    public function renderView(string $viewName, array $params = [])
    {
        $filePath = $this->getViewFilePath($viewName);
        return $this->getFileContents($filePath,$params);
    }

}