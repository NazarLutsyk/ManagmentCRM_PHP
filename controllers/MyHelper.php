<?php
/**
 * Created by PhpStorm.
 * User: nazik
 * Date: 15.01.2018
 * Time: 18:52
 */

namespace app\controllers;


class MyHelper
{
    public static function builUl($array){
        $result = '<ul>';
        foreach ($array as $key => $value) {
            $result .= '<li>' . $value . '</li>';
        }
        $result .= '</ul>';
        return $result;
    }
}