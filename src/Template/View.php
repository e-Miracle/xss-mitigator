<?php


class View
{
    /**
     * @throws Exception
     */
    public function render($view, $params = []): string
    {
        $position = strpos($view, ".");
        if ($position){
            $view = str_replace(".", "/", $view);
        }

        if (is_readable($view))
        {
            return (new Promise\ProjectXssMitigator\Purifier\Purifier())->purify($this->generateView($view, $params));
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