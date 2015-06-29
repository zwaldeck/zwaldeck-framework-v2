<?php

namespace Zwaldeck\Plugins\FrameworkPlugin\Templating;
use Zwaldeck\Core\Exceptions\NoSuchVariableInViewException;
use Zwaldeck\Core\Exceptions\NoSuchViewException;
use Zwaldeck\Core\Utils\StringUtils;

/**
 * Class TemplateEngine
 * @package Zwaldeck\Plugins\FrameworkPlugin\Templating
 */
class TemplateEngine {

    /**
     * @param $viewName
     * @param $file
     * @param array $variables
     * @return string
     * @throws NoSuchVariableInViewException
     * @throws NoSuchViewException
     */
    //todo further expend templating enginge than just echoing text
    //todo Rewrite the whole Engine --> Now its just a placeholder for testing!
    public function render($viewName, $file, array $variables = array()) {
        $content = $this->getContentFromView($viewName, $file);

        //checking if all vars are in array
        $matches = StringUtils::getContentBetweenTags($content, "{{","}}");
        foreach($matches as $match) {
            if(!array_key_exists($match, $variables)) {
                throw new NoSuchVariableInViewException($match);
            }
        }

        foreach($variables as $key => $value) {
            $content = str_replace("{{{$key}}}", $value, $content);
        }

        return $content;
    }

    /**
     * @param $view
     * @param $file
     * @return string
     * @throws NoSuchViewException
     */
    private function getContentFromView($view, $file) {
        if(!file_exists($file)) {
            throw new NoSuchViewException($view, $file);
        }

        return file_get_contents($file);
    }
}