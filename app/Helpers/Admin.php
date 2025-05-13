<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

class Admin
{

    public static function removeHTML($content)
    {
        $result = filter_var($content, FILTER_SANITIZE_STRING);
        $result = trim($result);
        $result = str_replace('&nbsp;', '', $result);
        return $result;
    }

    public static function ImageValidate()
    {
        return "image";
    }

    public static function transPermission($val)
    {
        $val = str_replace('admin.', '', $val);
        $val = str_replace('.', ' ', $val);
        $val = str_replace('-', ' ', $val);
        return  $val;
    }


    public static function syncPermisions($model = null)
    {
        $routes = self::getAdminRoutes();
        foreach ($routes as $route) {
            $permissionExist = (clone $model)->where('name', $route)->first();
            if ($permissionExist == null) {
                Permission::create([
                    'name' => $route,
                    'guard_name' => 'admin',
                ]);
            }
        }
    }

    public static function getAdminRoutes()
    {
        $routeCollection = Route::getRoutes();
        $routes = [];
        $permissions = [];
        foreach ($routeCollection as $value) {
            $routes[] =  $value->getName();
        }
        $routes = array_filter($routes);
        foreach ($routes as $route) {
            if (str_contains($route, "admin") == true) {
                $permissions[] = $route;
            }
        }
        return $permissions;
    }
}


