<?php

use App\Models\Permission;
use App\Models\RolePermission;

function checkPermission($routeName){

$thisUserRole=auth()->user()->role_id;

$getPermission=Permission::where('slug',$routeName)->first();

$checkHasPermission=RolePermission::where('role_id',$thisUserRole)
                    ->where('permission_id',$getPermission->id)->first();


if($checkHasPermission)
{
    return true;
}

return false;


}