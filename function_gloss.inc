<?php
/*
 * ==================================================================
 * Plugin GLOSSAIRE_XH for CMSimple_XH (1.7.x)
 * ==================================================================
 * Version:    2.0.1 - sept 2020
 * Copyright:  Ludovic AMATHIEU
 * Website:    https://www.f5swn.fr/en/ (and contact)
 * License:    GNU GPLv3 - http://www.gnu.org/licenses/gpl-3.0.en.html
 * ==================================================================
 */
if (!defined('CMSIMPLE_XH_VERSION')) {
    header('HTTP/1.0 403 Forbidden');
    exit;
}
if (!function_exists('isPublished')) {
    function isPublished($heading)
    {
        global $h, $pd_router;
     
        $i = array_search($heading, $h);
        if ($i !== false) {
            $pd = $pd_router->find_page($i);
            if (function_exists('Pageparams_isPublished')) {
                return Pageparams_isPublished($pd);
            } else {
                return $pd['published'] == '1';
            }
        } else {
            return false;
        }
    }
}
// source : http://www.weirdog.com/blog/php/supprimer-les-accents-des-caracteres-accentues.html
function OteAccents($str, $charset='utf-8') {
    $str = htmlentities($str, ENT_NOQUOTES, $charset);
    $str = preg_replace('#&([A-za-z])(?:acute|cedil|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $str);
    $str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str); // pour les ligatures e.g. '&oelig;'
    $str = preg_replace('#&[^;]+;#', '', $str); // supprime les autres caractères
    return $str;
}

function import($name, $origine = '', $striptags = TRUE, $value = NULL) {
    switch ($origine) {
    case 'POST' :
        $var = isset($_POST[$name]) ? $_POST[$name] : $value ;
        break;
    case 'GET':
        $var = isset($_GET[$name]) ? $_GET[$name] : $value ;
        break;
    default :
        $var = isset($_POST[$name]) ? $_POST[$name] : (isset($_GET[$name]) ? $_GET[$name] : $value);
    }
    if (is_array($var) && $striptags) {
        foreach ($var as &$v1) {
            if (is_array($v1)) {
                foreach ($v1 as &$v2) {
                    if (is_array($v2)) {
                        foreach ($v2 as &$v3) {
                            $v3 = strip_tags($v3);
                        }
                    } else {
                        $v2 = strip_tags($v2);
                    }
                }
            } else {
                $v1 = strip_tags($v1);
            }
        }
    } else {
        return $striptags ? strip_tags($var) : $var;
    }
}
