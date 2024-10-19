<?php

use App\Models\Permission;
use App\Models\RolePermission;

function checkPermission($routeName)
{

    if(auth()->user()->role->name=='admin')
    {
        return true;
    }
    
    $thisUserRole = auth()->user()->role_id;

    $getPermission = Permission::where('slug', $routeName)->first();

    $checkHasPermission = RolePermission::where('role_id', $thisUserRole)
        ->where('permission_id', $getPermission->id)->first();


    if ($checkHasPermission) {
        return true;
    }

    return false;
}
