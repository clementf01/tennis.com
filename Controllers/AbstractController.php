<?php

namespace Controllers;

abstract class AbstractController
{
    protected $path = "Views";
    protected $template = "";
    protected $arguments = [];
    public function redirection(string $url)
    {
        header("Location: $url");
    }
    public function render($view, $temp, array $arguments = null)
    {
        $this->arguments = $arguments !== null ? $arguments : null;
        if (file_exists($this->path . "/" . $view)) {
            $template = $temp;
            include $this->path . "/" . $view;
        }
    }
    public function setPath($c)
    {
        $this->path = ($c);
    }
    public function getPath()
    {
        return $this->path;
    }
}
