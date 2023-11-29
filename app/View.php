<?php

namespace App;

use App\CssGenerator;
use App\Framework\Utilities\BaseUtility;
use DOMDocument;
use DOMXPath;

class View {
    private string $current_css = "";
    private string $compiled_css = "";

    private static array $reactive_state_list = [];
    private static string $reactive_state_string = "";

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

    public static function getFileContent(string $fileName, array $data = []) {
        $data = (object) $data;

        $viewName = str_replace('../', '', $fileName);
		
		$viewPath = __DIR__ . "/../views/".$viewName."";

        if (!file_exists($viewPath)) {
            die("The file {$viewPath} could not be found.");
        }

        return file_get_contents($viewPath);
    }

    public static function make(string $viewName, array $data = []) {
        $viewName = str_replace('../', '', $viewName);
        $viewContent = self::renderView($viewName);
        $match = "/(\{{)(|\s+)([\w]+)(|\s+)(\}})/";

        $processedContent = preg_replace_callback($match, function ($matches) use ($data) {
            $text = $matches[3];
            return $data[$text] ?? "";
        }, $viewContent);



        $processedContent = preg_replace_callback("/(\{{style:)(.*)(\}})/", function ($matches) {      
            $css_file = str_replace('../', '', trim($matches[2]));
            $style_contents = self::getFileContent($css_file);

            $instance = new self;
            $css_styles = $instance->buildStyles($style_contents);

            return "<style>$css_styles</style>";
        }, $processedContent);

        echo $processedContent;
    }

    private static $iteration = 0;

    public static function asignElementId(string $htmlContent) {
        // matches for html opening or self enclosed tags
        $match = "/(\s*<\w+\s*)(((\w*=\".*\"\s*)|(\w*='.*'\s*))*)(\s*)(>|\/>)/";

        $processedContent = preg_replace_callback($match, function ($matches) {
            ++self::$iteration;
            $elementId = BaseUtility::generateRandomString(6);

            $newhtmlTag = $matches[1] . ' spkId="' . self::$iteration . '-'.$elementId.'"' . " " .$matches[2] . " " . $matches[7];
            return $newhtmlTag;
        }, $htmlContent);

        return $processedContent;
    }


    private static $dom_updates = "";
    public static function compileDomUpdates(string $content) {
        error_log("compileDomUpdates running ...");

        $processedContent = preg_replace_callback("/(<\/\w*>|<\w>)/", function ($matches) {
            return $matches[0] . "\n";
        }, $content);

        // error_log($processedContent);

        $match = "/((\s*<\w+\s*)(((\w*=\".*\"\s*)|(\w*='.*'\s*))*)(\s*)(>|\/>))(.*)(\{\s*(\w+)\s*\}(.*))(<\/\w*>|<\w>)/";

        $processedContent = preg_replace_callback($match, function ($matches) {
    
            $attribute_match = "/(spkId=\")([\w-]*)(\")/";

            $has_match = preg_match($attribute_match, $matches[3], $attr_matches);

            if ($has_match) {
                $state_key = $matches[11];
                $state_list = array_filter(self::$reactive_state_list, function($value) use ($state_key) {
                    return $value['value'] == $state_key;
                });

                if (count($state_list) > 0) {
                    $update_data = "document.querySelector('[spkId=\"".$attr_matches[2]."\"]').textContent = `".$matches[9]." \${".$state_key."} ".$matches[12]."`;";

                    $update_list = self::$reactive_state_list[$state_key]["updates"];
                    array_push($update_list, $update_data);

                    self::$reactive_state_list[$state_key]["updates"] = $update_list;
                    self::$dom_updates = self::$dom_updates . $update_data;
                }
            }

            return str_replace($matches[10], '$'.$matches[10], $matches[0]);
        }, $processedContent);


        $processedContent = preg_replace_callback("/(<script .* >)(.*?)<\/script>/s", function ($matches) {
            return "";
        }, $processedContent);

        return $processedContent;
    }

    private string $state_object = "";

    /*
        state should look like so

        [
            {
                "key": "name",
                "update": () => {
                    list of dom updates
                }
            }
        ]
    */

    public static function buildStateTree() : string {
        $iteration = 0;
        $length = count(self::$reactive_state_list);
        $state_object = "[";
        
        foreach (self::$reactive_state_list as $key => $state_arr) {
            ++$iteration;
            $single_state = "{key: '$key', update: () => {";
                
            foreach ($state_arr["updates"] as $key => $value) {
                $single_state = $single_state . $value ;
            }
            $single_state = $single_state . "}" . ($length == $iteration ? "}" : "},");
            $state_object = $state_object . $single_state;
        }
        $state_object = $state_object . "]";

        // print_r("<pre>");
        // print_r($state_object);
        // print_r("</pre>");
        // exit;

        return $state_object;
    }



    public static function extractState(string $content) {
        error_log("extractState running ...");

        $match = "/\s*let\s+([\w\d_]*)\s*=\s*useState\(\s*(.*)\s*\)/";

        preg_replace_callback($match, function ($matches) {
            $state_key = $matches[1];
            
            if (!isset(self::$reactive_state_list[$state_key])) {
                self::$reactive_state_list[$state_key] =  [
                    "value"=>$state_key,
                    "updates"=>[]
                ];
            }
        }, $content);
        

        $iteration = 0;

        foreach (self::$reactive_state_list as $key => $value) {
            self::$reactive_state_string = self::$reactive_state_string . ($iteration == 0 ? "" : ",") . "'".$value["value"]."'";
            ++$iteration;
        }
    }

    private static $html_string = "";
    private static $component_logic = "";

    public static function useExperimentView(string $viewName, array $data = []) {
        $viewName = str_replace('../', '', $viewName);
        $viewContent = self::renderView($viewName);
        $match = "/(\{{)(|\s+)([\w]+)(|\s+)(\}})/";

        $processedContent = preg_replace_callback($match, function ($matches) use ($data) {
            $text = $matches[3];
            return $data[$text] ?? "";
        }, $viewContent);


        $content_with_id = self::asignElementId($processedContent);

        $processedContent = preg_replace_callback("/(\{{style:)(.*)(\}})/", function ($matches) {      
            $css_file = str_replace('../', '', trim($matches[2]));
            $style_contents = self::getFileContent($css_file);

            $instance = new self;
            $css_styles = $instance->buildStyles($style_contents);

            return "<style>$css_styles</style>";
        }, $content_with_id);

        $raw_script_content = $processedContent;
        $script_match = "/(<script .* >)(.*?)<\/script>/s";

        

        $refined_script_content = preg_replace_callback($script_match, function ($matches) use ($raw_script_content) {
            $html_string = self::$html_string;

            self::extractState($matches[2]);
            $html_component = self::compileDomUpdates($raw_script_content);

            // error_log($html_component);
            // exit;
            $state_tree = self::buildStateTree();

            $component_javascript = $matches[2];
            $updates = self::$dom_updates;
            $state_data = self::$reactive_state_string;

            self::$component_logic = <<<EOD
                <script>
                    const state_data = [
                        {
                            "key": "lofty",
                            update: () => {
                                $updates
                            }
                        }
                    ];

                    let stateList = [$state_data];
                    let stateTree = $state_tree;

                    const useState = (initialValue) => {
                        return initialValue;
                    }

                    const updateState = (state) => {
                        const extrated_sated = stateTree.filter(item => item.key == state)
                        if (extrated_sated.length) {
                            extrated_sated[0].update()
                        }
                    }

                    $component_javascript

                    console.log(stateList)
                    console.log(stateTree)
                    console.log(document.currentScript); 

                    const mount = () => {
                        let newNode = document.createElement("div");
                        const scriptNode = document.currentScript
                        scriptNode.parentNode.insertBefore(newNode, scriptNode)
                        newNode.outerHTML = `$html_component`;
                    }
                    mount()
                </script>
             EOD;

        }, $raw_script_content);

        $render = self::$component_logic;

        echo <<<EOD
            <!DOCTYPE html>
            <html>
            <head>
                <meta charset="UTF-8" />
                <title>title</title>
            </head>
            <body>
                $render
            </body>
            </html>
            
        EOD;
    }

    public function buildStyles(string $content) {
        $css_generator = new CssGenerator($content);
        return $css_generator->compiled_css;
    }

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