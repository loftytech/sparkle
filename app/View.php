<?php

namespace App;

class View {

    public static function renderView(string $viewName, array $data = []) {
        $data = (object) $data;

        $viewName = str_replace('../', '', $viewName);
		
		$viewPath = __DIR__ . "/../views/".$viewName.".php";

        if (!file_exists($viewPath)) {
            die("The file {$viewPath}.php could not be found.");
        }

        ob_start();

        include_once $viewPath;

        return ob_get_clean();
    }


    public static function make(string $viewName, array $data = []) {
        $viewName = str_replace('../', '', $viewName);
        $viewContent = self::renderView($viewName);
        $match = "/(\{{)(|\s+)([\w]+)(|\s+)(\}})/";

        $processedContent = preg_replace_callback($match, function ($matches) use ($data) {
            $text = $matches[3];
            return $data[$text] ?? "";
        }, $viewContent);

        echo $processedContent;
    }

    private static $html_string = "";

    public static function useLayout(string $viewName, array $data = []) {
        $viewName = str_replace('../', '', $viewName);
        $layoutContent = self::layoutContent();
        $viewContent = self::renderView($viewName);

        $content =  str_replace('{{content}}', $viewContent, $layoutContent);
        $match = "/(\{\{)(|\s+)([\w]+)(|\s+)(\}\})/";
        // $replace_text = '$\3';
        
        
        $processedContent = preg_replace_callback($match, function ($matches) use ($data) {
            $text = $matches[3];
            return $data[$text] ?? "";
        }, $content);


        echo $processedContent;
    }

    protected static function layoutContent() {
        ob_start();

        include_once __DIR__ . "/../views/layouts/main.php";

        return ob_get_clean();
	}
}
?>