<?php
class View
{
    protected $template_dir;
    public function __construct($template_dir)
    {
        $this->template_dir = $template_dir;
    }
    public function render($template, $vars = [])
    {
        $template_file_path = $this->template_dir . '/' . $template . '.tpl';
        if (is_file($template_file_path)) {
            echo $this->fetch($template_file_path, $vars);
        }
    }
    protected function fetch($template, $vars = [])
    {
        extract($vars);
        include($template);
    }
}