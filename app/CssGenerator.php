<?php

namespace App;

class CssGenerator {
    public $generated_object = "";
    public string $primary_css = "";
    public string $nested_css = "";
    public string $compiled_css = "";
    public string $compiled_media_queries = "";

    public array $compiled_array = [];
    public array $temp_arr = [];
    public array $media_query_arr = [];

    public function __construct($scss) {
        $json_string = $this->scssToNestedArray($scss);
        $obj_arr = json_decode($json_string);

        $this->generated_object = $obj_arr;

        $this->nestedArraysTocss($obj_arr);

        $this->generateCss();
    }

    private function scssToNestedArray($scss) {
        // convert selectors to objects
        $processedContent = preg_replace_callback("/(.*)(\{)/", function ($matches) {
            return '"'.trim($matches[1]).'":'.'{';
        }, $scss);

        // convert css properties to keys
        $processedContent = preg_replace_callback("/(.*)(:)(|\s+)(.*)(|\s+)(;)/", function ($matches) {
            return '"'.trim($matches[1]).'": "'.trim($matches[4]).'",';
        }, $processedContent);

        // cleaning up the json string
        $processedContent = preg_replace_callback('/(})(|\s+)(")(.*)/', function ($matches) {
            return trim($matches[1]).', "'.trim($matches[4]);
        }, $processedContent);

        $processedContent = preg_replace_callback('/(",)(|\s+)(})/', function ($matches) {
            return '" }';
        }, $processedContent);

        return "{".$processedContent."}";
    }

    private function nestedArraysTocss($nestedArray, $parent_selector = "") {
        foreach ($nestedArray as $key => $value) {

            if (trim($key)[0] == "@") {

                $this->extractMediaQueries($value, $parent_selector, $key);
            } else {
                if (gettype($value) == "string") {
                
                    $full_selector = $parent_selector;
                    if ($parent_selector == "") {
                        $full_selector = $key;
                    }
    
                    if (trim($key)[0] == ":") {
                        $full_selector = trim($parent_selector) . trim($key);
                    }
    
                    if (!array_key_exists($full_selector, $this->compiled_array)) {
                        $this->compiled_array[$full_selector] = ["$key: $value;"];
                    } else {
                        $style_arr = $this->compiled_array[$full_selector];
                        array_push($style_arr, "$key: $value;");
    
                        $this->compiled_array[$full_selector] = $style_arr;
                    }
                } else {
    
                    foreach ($value as $child_key => $child_value) {
                        if (gettype($child_value) == "string") {
                            $full_selector = $parent_selector . " ". $key;
    
                            if ($parent_selector == "") {
                                $full_selector = $key;
                            }
    
                            if (trim($key)[0] == ":") {
                                $full_selector = trim($parent_selector) . trim($key);
                            }
                            
                            if (!array_key_exists($full_selector, $this->compiled_array)) {
                                $this->compiled_array[$full_selector] = ["$child_key: $child_value;"];
                            } else {
                                $style_arr = $this->compiled_array[$full_selector];
                                array_push($style_arr, "$child_key: $child_value;");
    
                                $this->compiled_array[$full_selector] = $style_arr;
                            }
                        } else {
    
                            $trim_key = trim($key);
                            $trim_child_key = trim($child_key);
                            $trim_parent_selector = trim($parent_selector);
    
                            $full_selector = $trim_parent_selector . " " . $trim_key . " " . $trim_child_key;
    
                            // if ($parent_selector == "") {
                            //     $full_selector =  $trim_key . " " . $trim_child_key;
                            // }

                            $full_child_key = "";

                            $child_key_arr = explode(",", $trim_child_key);

                            foreach ($child_key_arr as $arr_key => $child_key_value) {
                                $trimed_value = trim($child_key_value);
                                $full_child_key = $full_child_key . ($arr_key > 0 ? ", " : "") . $trim_parent_selector . ($trim_key[0] == ":" ? $trim_key : " " . $trim_key) . ($trimed_value[0] == ":" ? $trimed_value : " " . $trimed_value);
                            }
    
                            $full_selector = $full_child_key;
                            
    
                            if ($trim_child_key[0] == "@") {
                                $this->extractMediaQueries($value->$child_key, $trim_parent_selector . ($trim_key[0] == ":" ? $trim_key : " " . $trim_key), $trim_child_key);
                            } else {
                                $this->nestedArraysTocss($value->$child_key, $full_selector);
                            }
                        }
                    }
                }
            }
            
        }
    }

    private function extractMediaQueries($nestedArray, $parent_selector, $scope_selector = "") {
        $this->temp_arr = [];

        $this->resolveCss($nestedArray, $parent_selector);

        array_push($this->media_query_arr, [$scope_selector => $this->temp_arr]);
    }


    private function resolveCss($nestedArray, $parent_selector) {
        foreach ($nestedArray as $key => $value) {
            if (gettype($value) == "string") {
                $full_selector = $parent_selector;
                if ($parent_selector == "") {
                    $full_selector = $key;
                }

                if (trim($key)[0] == ":") {
                    $full_selector = trim($parent_selector) . trim($key);
                }

                if (!array_key_exists($full_selector, $this->temp_arr)) {
                    $this->temp_arr[$full_selector] = ["$key: $value;"];
                } else {
                    $style_arr = $this->temp_arr[$full_selector];
                    array_push($style_arr, "$key: $value;");

                    $this->temp_arr[$full_selector] = $style_arr;
                }
            } else {

                foreach ($value as $child_key => $child_value) {
                    if (gettype($child_value) == "string") {
                        $full_selector = $parent_selector . " ". $key;

                        if ($parent_selector == "") {
                            $full_selector = $key;
                        }

                        if (trim($key)[0] == ":") {
                            $full_selector = trim($parent_selector) . trim($key);
                        }
                        
                        if (!array_key_exists($full_selector, $this->temp_arr)) {
                            $this->temp_arr[$full_selector] = ["$child_key: $child_value;"];
                        } else {
                            $style_arr = $this->temp_arr[$full_selector];
                            array_push($style_arr, "$child_key: $child_value;");

                            $this->temp_arr[$full_selector] = $style_arr;
                        }
                    } else {

                        $trim_key = trim($key);
                        $trim_child_key = trim($child_key);
                        $trim_parent_selector = trim($parent_selector);

                        $full_selector = $trim_parent_selector . " " . $trim_key . " " . $trim_child_key;

                        // if ($parent_selector == "") {
                        //     $full_selector =  $trim_key . " " . $trim_child_key;
                        // }

                        $full_child_key = "";

                        $child_key_arr = explode(",", $trim_child_key);

                        foreach ($child_key_arr as $arr_key => $child_key_value) {
                            $trimed_value = trim($child_key_value);
                            $full_child_key = $full_child_key . ($arr_key > 0 ? ", " : "") . $trim_parent_selector . ($trim_key[0] == ":" ? $trim_key : " " . $trim_key) . ($trimed_value[0] == ":" ? $trimed_value : " " . $trimed_value);
                        }

                        $full_selector = $full_child_key;
                        
                        $this->resolveCss($value->$child_key, $full_selector);
                    }
                }
            }
        }
    }


    private function generateCss() {
        foreach ($this->compiled_array as $key => $value) {
            $this->compiled_css = $this->compiled_css . $key . " {";
            foreach ($value as $property => $style) {
                $this->compiled_css = $this->compiled_css . $style;
            }
            $this->compiled_css = $this->compiled_css .  "}";
        }

        foreach ($this->media_query_arr as $key => $value) {
            foreach ($value as $media_key => $media_queries) {
                $this->compiled_media_queries = $this->compiled_media_queries . $media_key . " {";
                foreach ($media_queries as $styles_key => $styles_value) {
                    $this->compiled_media_queries = $this->compiled_media_queries . $styles_key . " {";
                    foreach ($styles_value as $key => $css_style) {
                        $this->compiled_media_queries = $this->compiled_media_queries . $css_style;
                    }
                    $this->compiled_media_queries = $this->compiled_media_queries . "}";
                }
                $this->compiled_media_queries = $this->compiled_media_queries .  "}";
            }
        }

        $this->compiled_css = $this->compiled_css . " ". $this->compiled_media_queries;
    }

    
}
?>