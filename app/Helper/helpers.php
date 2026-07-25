<?php

if (!function_exists('set_active')) {
    function set_active($routes) {
        foreach ((array) $routes as $route) {
            if (request()->is($route)) {
                return 'active';
            }
        }
        return '';
    }
}
