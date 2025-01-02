<?php

if (!function_exists('config')) {
    function config($id)
    {
        list($name, $key) = explode('.', $id);

        $file = __DIR__ . '/config/' . $name . '.php';

        if (file_exists($file)) {
            $a = require_once($file);

            if (!$key) {
                return $a;
            }

            return isset($a[$key]) ? $a[$key] : null;
        }

        return null;
    }
}

var_dump(config('vbout.url'));
