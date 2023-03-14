<?php

namespace App;

use App\Controllers\SiteInfoController;

class View {

    public static function renderView(string $viewName, array $data = []) {
        $homeURL = SiteInfoController::home_url();
        $site_title = SiteInfoController::siteTitle();
        $site_tagline = SiteInfoController::site_description();
        $data = (object) $data;
		
		$viewPath = __DIR__ . "/../views/".$viewName.".php";

        if (!file_exists($viewPath)) {
            die("The file {$viewPath}.php could not be found.");
        }

        ob_start();

        include_once $viewPath;

        return ob_get_clean();
    }


    public static function make(string $viewName, array $data = []) {
        $viewContent = self::renderView($viewName);
        $match = "/(\{{)(|\s+)([\w]+)(|\s+)(\}})/";


		$homeURL = SiteInfoController::home_url();

        $processedContent = preg_replace_callback($match, function ($matches) use ($data) {
            $text = $matches[3];
            return $data[$text];
        }, $viewContent);

        echo $processedContent;
    }

    private static $html_string = "";

    public static function useLayput(string $viewName, array $data = []) {
        $layoutContent = self::layoutContent();
        $viewContent = self::renderView($viewName);

		$homeURL = SiteInfoController::home_url();

        $content =  str_replace('{{content}}', $viewContent, $layoutContent);
        $match = "/(\{\{)(|\s+)([\w]+)(|\s+)(\}\})/";
        // $replace_text = '$\3';
        
        
        $processedContent = preg_replace_callback($match, function ($matches) use ($data) {
            $text = $matches[3];
            return $data[$text] ?? "";
        }, $content);


        $match_javascript = "/([^\{]\{)(|\s+)([\w]+)(|\s+)(\})/s";
        $processed_javascript_content = preg_replace_callback($match_javascript, function ($matches) use ($data) {
            $text = '${'.$matches[3].'}';
            return $text;
        }, $processedContent);

        $raw_content = $processed_javascript_content;
        $template_match = "/<template>(.*?)<\/template>/s";

        $refined_content = preg_replace_callback($template_match, function ($matches) {
            self::$html_string = $matches[1];
            $text = $matches[1];
            return "";
        }, $raw_content);


        $raw_script_content = $refined_content;
        $script_match = "/<script>(.*?)<\/script>/s";

        $refined_script_content = preg_replace_callback($script_match, function ($matches) {
            $html_string = self::$html_string;

            $text = $matches[1];
            return <<<EOD
                <script>
                    $text

                    let componentData = `
                        $html_string
                    `;

                    var scriptTag = document.getElementsByTagName('script');
                    scriptTag = scriptTag[scriptTag.length - 1];
                    var parentTag = scriptTag.parentNode;

                    let virtualNode = document.createElement('div')
                    virtualNode.innerHTML = componentData
                    const mountedComponent = virtualNode.childNodes[1];

                    parentTag.insertBefore(mountedComponent, scriptTag);


                    const resolveLoops = (nodeComponent) => {
                        let loopList = nodeComponent.querySelectorAll('[for-each]')
                    
                        for (let index = 0; index < loopList.length; index++) {
                            const nodeElement = loopList[index];
                            const newNodeElement = nodeElement
                            const attrValue = nodeElement.getAttribute('for-each').replace(/ {2,}/g,' ').trim()
                            
                            const attrArry = attrValue.split(' ')
                            console.log(attrValue)

                            const attrVar = eval(attrArry[2])
                            const attrItem = attrArry[0]
                            
                            console.log(attrVar)

                            const nodeContent = nodeElement.innerHTML
                            let nodeContentList = "";

                            for (let index = 0; index < attrVar.length; index++) {
                                let item = attrVar[index];

                                newNodeElement.innerHTML = nodeContent.replace(/{{(.*?)}}/s, (content, itemData) => {
                                    return item
                                })
                                if(newNodeElement.querySelectorAll('[for-each]')) {
                                    resolveLoops(nodeElement)
                                }
                                nodeContentList += newNodeElement.outerHTML
                            }

                            nodeElement.outerHTML = nodeContentList

                            
                        }
                    }

                    resolveLoops(mountedComponent)

                    const setState = (runState) => {
                        runState();
                        mountedComponent.textContent = "";

                        let newComponentData = `
                            $html_string
                        `;
            
                        mountedComponent.innerHTML = newComponentData;
                        resolveLoops(mountedComponent)

                    }
                </script>
             EOD;
        }, $raw_script_content);


        echo $refined_script_content;
    }

    protected static function layoutContent() {
        ob_start();


		$homeURL = SiteInfoController::home_url();
		$site_title = SiteInfoController::siteTitle();
		$site_tagline = SiteInfoController::site_description();

        include_once __DIR__ . "/../views/layouts/main.php";

        return ob_get_clean();
	}
}
?>