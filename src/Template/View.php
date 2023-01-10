<?php
namespace CssFuto\ProjectXssMitigator\Template;
use CssFuto\ProjectXssMitigator\Purifier\Purifier;

class View
{
    /**
     * @throws \Exception
     */
    public function render($view, $params = []): string
    {
        $position = strpos($view, ".");
        if ($position){
            $view = str_replace(".", "/", $view);
        }

        //$view = str_replace('\\', '/', dirname(__DIR__, 3).'/'.$view.'.php');
        $view = getcwd().'/'.$view.'.php';
        if (is_readable($view))
        {
            return (new Purifier())->purify($this->generateView($view, $params));
        }else{
            throw new \Exception("404 PAGE NOT FOUND", 404);
        }
    }

    /**
     * @throws \Exception
     */
    private function generateView($view, $params): bool
    {
        foreach ($params as $key => $value){
            $$key = $value;
        }

        ob_start();
        require_once $view;
        echo ob_get_clean();
        return true;
    }
}