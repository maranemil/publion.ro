<?php
/* SVN FILE: $Id: css.php 8120 2009-03-19 20:25:10Z gwoo $ */
/**
 * Short description for file.
 * Long description for file
 * PHP versions 4 and 5
 * CakePHP(tm) :  Rapid Development Framework (http://www.cakephp.org)
 * Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 * @filesource
 * @copyright     Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 * @link          http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.app.webroot
 * @since         CakePHP(tm) v 0.2.9
 * @version       $Revision: 8120 $
 * @modifiedby    $LastChangedBy: gwoo $
 * @lastmodified  $Date: 2009-03-19 13:25:10 -0700 (Thu, 19 Mar 2009) $
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
if (!defined('CAKE_CORE_INCLUDE_PATH')) {
    header('HTTP/1.1 404 Not Found');
    exit('File Not Found');
}
/**
 * Enter description here...
 */
if (!class_exists('File')) {
    uses('file');
}
/**
 * Enter description here...
 *
 * @param string $path
 * @param string $name
 *
 * @return string
 */
function make_clean_css($path, $name)
{
    App::import('Vendor', 'csspp' . DS . 'csspp');
    $data = file_get_contents($path);
    $csspp = new csspp();
    $output = $csspp->compress($data);
    $ratio = 100 - (round(strlen($output) / strlen($data), 3) * 100);
    return " /* file: $name, ratio: $ratio% */ " . $output;
}

/**
 * Enter description here...
 *
 * @param string $path
 * @param string $content
 *
 * @return bool
 */
function write_css_cache($path, $content)
{
    if (!is_dir(dirname($path)) && !mkdir($concurrentDirectory = dirname($path)) && !is_dir($concurrentDirectory)) {
        throw new \RuntimeException(sprintf('Directory "%s" was not created', $concurrentDirectory));
    }
    return (new File($path))->write($content);
}

if (preg_match('|\.\.|', $url) || !preg_match('|^ccss/(.+)$|i', $url, $regs)) {
    die('Wrong file name.');
}

$filename = 'css/' . $regs[1];
$filepath = CSS . $regs[1];
$cachepath = CACHE . 'css' . DS . str_replace(array('/', '\\'), '-', $regs[1]);

if (!file_exists($filepath)) {
    die('Wrong file name.');
}

if (file_exists($cachepath)) {
    $templateModified = filemtime($filepath);
    $cacheModified = filemtime($cachepath);

    if ($templateModified > $cacheModified) {
        $output = make_clean_css($filepath, $filename);
        write_css_cache($cachepath, $output);
    } else {
        $output = file_get_contents($cachepath);
    }
} else {
    $output = make_clean_css($filepath, $filename);
    write_css_cache($cachepath, $output);
    $templateModified = time();
}

header("Date: " . date("D, j M Y G:i:s ", $templateModified) . 'GMT');
header("Content-Type: text/css");
header("Expires: " . gmdate("D, d M Y H:i:s", time() + DAY) . " GMT");
header("Cache-Control: max-age=86400, must-revalidate"); // HTTP/1.1
header("Pragma: cache");        // HTTP/1.0
print $output;
