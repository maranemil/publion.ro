<?php /** @noinspection PhpUnused */
/** @noinspection PhpMultipleClassDeclarationsInspection */
/** @noinspection AutoloadingIssuesInspection */
/* SVN FILE: $Id: javascript.php 476 2007-02-08 14:53:34Z tariquesani $ */

/**
 * Javascript Helper class file.
 * PHP versions 4 and 5
 * CakePHP :  Rapid Development Framework <http://www.cakephp.org/>
 * Copyright (c)    2006, Cake Software Foundation, Inc.
 *                                1785 E. Sahara Avenue, Suite 490-204
 *                                Las Vegas, Nevada 89104
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 * @filesource
 * @copyright           Copyright (c) 2006, Cake Software Foundation, Inc.
 * @link                http://www.cakefoundation.org/projects/info/cakephp CakePHP Project
 * @package             cake
 * @subpackage          cake.cake.libs.view.helpers
 * @since               CakePHP v 0.10.0.1076
 * @version             $Revision: 476 $
 * @modifiedby        $LastChangedBy: tariquesani $
 * @lastmodified    $Date: 2007-02-08 20:23:34 +0530 (Thu, 08 Feb 2007) $
 * @license             http://www.opensource.org/licenses/mit-license.php The MIT License
 */

/**
 * Javascript Helper class for easy use of JavaScript.
 * JavascriptHelper encloses all methods needed while working with JavaScript.
 * @package        cake
 * @subpackage     cake.cake.libs.view.helpers
 */
class JavascriptHelper extends Helper
{

    public $_cachedEvents = array();
    public $_cacheEvents  = false;
    public $_cacheToFile  = false;
    public $_cacheAll    = false;
    public $_rules       = array();

    /**
     * Returns a JavaScript script tag.
     *
     * @param string $script The JavaScript to be wrapped in SCRIPT tags.
     * @param boolean $allowCache Allows the script to be cached if non-event caching is active
     *
     * @return string The full SCRIPT element, with the JavaScript inside it.
     */
    public function codeBlock($script, $allowCache = true)
    {
        if ($this->_cacheEvents && $this->_cacheAll && $allowCache) {
            $this->_cachedEvents[] = $script;
        } else {
            return sprintf($this->tags['javascriptblock'], $script);
        }
        return false;
    }

    /**
     * Returns a JavaScript include tag (SCRIPT element)
     *
     * @param string $url URL to JavaScript file.
     *
     * @return string
     */
    public function link($url)
    {
        if (strpos($url, ".") === false) {
            $url .= ".js";
        }
        return sprintf($this->tags['javascriptlink'], $this->webroot . $this->themeWeb . JS_URL . $url);
    }

    /**
     * Returns a JavaScript include tag (SCRIPT element) without considering the themeWeb
     *
     * @param string $url URL to JavaScript file.
     *
     * @return string
     */
    public function linkAbs($url)
    {
        if (strpos($url, ".") === false) {
            $url .= ".js";
        }
        return sprintf($this->tags['javascriptlink'], $this->webroot . JS_URL . $url);
    }

    /**
     * Returns a JavaScript include tag for an externally-hosted script
     *
     * @param string $url URL to JavaScript file.
     *
     * @return string
     */
    public function linkOut($url)
    {
        if (strpos($url, ".") === false) {
            $url .= ".js";
        }
        return sprintf($this->tags['javascriptlink'], $url);
    }

    /**
     * Escape carriage returns and single and double quotes for JavaScript segments.
     *
     * @param string $script string that might have javascript elements
     *
     * @return string escaped string
     */
    public function escapeScript($script)
    {
        $script = str_ireplace(array("\r\n", "\n", "\r"), '\n', $script);
        return str_ireplace(array('"', "'"), array('\"', "\\'"), $script);
    }

    /**
     * Escape a string to be JavaScript friendly.
     * List of escaped ellements:
     *    + "\r\n" => '\n'
     *    + "\r" => '\n'
     *    + "\n" => '\n'
     *    + '"' => '\"'
     *    + "'" => "\\'"
     *
     * @param $string
     *
     * @return string Escaped string.
     */
    public function escapeString($string)
    {
        $escape = array("\r\n" => '\n', "\r" => '\n', "\n" => '\n', '"' => '\"', "'" => "\\'");
        return str_ireplace(array_keys($escape), array_values($escape), $string);
    }

    /**
     * Attach an event to an element. Used with the Prototype library.
     *
     * @param string $object Object to be observed
     * @param string $event event to observe
     * @param string $observer function to call
     * @param boolean $useCapture default true
     *
     * @return boolean true on success
     */
    public function event($object, $event, $observer = null, $useCapture = false)
    {
        if ($useCapture === true) {
            $useCapture = true;
        } else {
            $useCapture = false;
        }

        if ($object === 'window' || strpos($object, '$(') !== false || strpos($object, '"') !== false || strpos($object, '\'') !== false) {
            $b = "Event.observe($object, '$event', function(event){ $observer }, $useCapture);";
        } else {
            $chars = array('#', ' ', ', ', '.', ':');
            $found = false;
            foreach ($chars as $char) {
                if (strpos($object, $char) !== false) {
                    $found = true;
                    break;
                }
            }
            if ($found) {
                $this->_rules[$object] = $event;
            } else {
                $b = "Event.observe(\$('$object'), '$event', function(event){ $observer }, $useCapture);";
            }
        }

        if (isset($b) && !empty($b)) {
            if ($this->_cacheEvents === true) {
                $this->_cachedEvents[] = $b;
                return false;
            }

            return $this->codeBlock($b);
        }
        return false;
    }

    /**
     * Cache JavaScript events created with event()
     *
     * @param boolean $file If true, code will be written to a file
     * @param boolean $all If true, all code written with JavascriptHelper will be sent to a file
     *
     * @return void
     */
    public function cacheEvents($file = false, $all = false)
    {
        $this->_cacheEvents = true;
        $this->_cacheToFile = $file;
        $this->_cacheAll = $all;
    }

    /**
     * Write cached JavaScript events
     * @return string
     */
    public function writeEvents()
    {
        $rules = array();
        if (!empty($this->_rules)) {
            foreach ($this->_rules as $sel => $event) {
                $rules[] = "\t'$sel': function(element, event) {\n\t\t$event\n\t}";
            }
            $this->_cacheEvents = true;
        }

        if ($this->_cacheEvents) {
            $this->_cacheEvents = false;
            $events = $this->_cachedEvents;
            $data = implode("\n", $events);
            $this->_cachedEvents = array();

            if (!empty($rules)) {
                $data .= "\n\nvar SelectorRules = {\n" . implode(",\n\n", $rules) . "\n}\n";
                $data .= "\nEventSelectors.start(SelectorRules);\n";
            }

            if (!empty($events) || !empty($rules)) {
                if ($this->_cacheToFile) {
                    $filename = md5($data);
                    if (!file_exists(JS . $filename . '.js')) {
                        cache(r(WWW_ROOT, '', JS) . $filename . '.js', $data, '+999 days', 'public');
                    }
                    return $this->link($filename);
                }

                return $this->codeBlock("\n" . $data . "\n");
            }
        }
        return false;
    }

    /**
     * Includes the Prototype Javascript library (and anything else) inside a single script tag.
     * Note: The recommended approach is to copy the contents of
     * javascripts into your application's
     * public/javascripts/ directory, and use
     *
     * @param string $script
     *
     * @return string script with all javascript in/javascripts folder
     * @see javascriptIncludeTag() to
     *      create remote script links.
     */
    public function includeScript($script = "")
    {
        if ($script === "") {
            $files = scandir(JS);
            $javascript = '';

            foreach ($files as $file) {
                if (substr($file, -3) === '.js') {
                    $javascript .= file_get_contents(JS . $file) . "\n\n";
                }
            }
        } else {
            $javascript = file_get_contents(JS . "$script.js") . "\n\n";
        }
        return $this->codeBlock("\n\n" . $javascript);
    }

    /**
     * Generates a JavaScript object in JavaScript Object Notation (JSON)
     * from an array
     *
     * @param array $data Data to be converted
     * @param boolean $block Wraps return value in a <script/> block if true
     * @param string $prefix Prepends the string to the returned data
     * @param string $postfix Appends the string to the returned data
     * @param array $stringKeys A list of array keys to be treated as a string
     * @param boolean $quoteKeys If false, treats $stringKey as a list of keys *not* to be quoted
     * @param string $q The type of quote to use
     *
     * @return string A JSON code block
     */
    public function object($data = array(), $block = false, $prefix = '', $postfix = '', $stringKeys = array(), $quoteKeys = true, $q = "\"")
    {
        if (is_array($data)) {
            $data = get_object_vars($data);
        }

        $out = array();

        if (is_array($data)) {
            $keys = array_keys($data);
        }

        $numeric = true;

        if (!empty($keys)) {
            foreach ($keys as $key) {
                if (!is_numeric($key)) {
                    $numeric = false;
                    break;
                }
            }
        }

        foreach ($data as $key => $val) {
            if (is_array($val) || is_object($val)) {
                $val = $this->object($val, false, '', '', $stringKeys, $quoteKeys, $q);
            } else {
                if ((!count($stringKeys) && !is_numeric($val) && !is_bool($val)) ||
                    ($quoteKeys && in_array($key, $stringKeys, true)) ||
                    (!$quoteKeys && !in_array($key, $stringKeys, true))) {
                    $val = $q . $val . $q;
                }
                if (trim($val) === '') {
                    $val = 'null';
                }
            }

            if (!$numeric) {
                $val = $key . ':' . $val;
            }

            $out[] = $val;
        }

        if (!$numeric) {
            $rt = '{' . implode(', ', $out) . '}';
        } else {
            $rt = '[' . implode(', ', $out) . ']';
        }
        $rt = $prefix . $rt . $postfix;

        if ($block) {
            $rt = $this->codeBlock($rt);
        }

        return $rt;
    }

    /**
     * AfterRender callback.  Writes any cached events to the view, or to a temp file.
     * @return void
     */
    public function afterRender()
    {
        echo $this->writeEvents();
    }
}

