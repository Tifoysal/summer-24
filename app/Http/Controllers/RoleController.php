<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use App\Models\RolePermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Throwable;

class RoleController extends Controller
{
    public function role()
    {
        $roles = Role::paginate(10);
        return view('backend.page.role.list', compact('roles'));
    }


    public function showPermission($role_id)
    {
        // $role_id=$role_id;
        $rolePermissions=RolePermission::where('role_id',$role_id)->get()->pluck('permission_id')->toArray();
       
        $permissions = Permission::all();
        return view('backend.page.role.permissions', compact('permissions','rolePermissions','role_id'));
    }

    public function roleForm()
    {

        return view('backend.page.role.form');
    }

    public function roleCreate(Request $request)
    {

        $validation = Validator::make(
            $request->all(),
            [
                'name' => 'required|min:2',
            ]
        );

        if ($validation->fails()) {
            notify()->error($validation->getMessageBag());
            return redirect()->back();
        }


        // dd($request->all()); //to see data comming from form

        //lets store data into database

        try {
            Role::create([
                //bam pase table er column name => dan pase input field er name
                'name' => $request->name,

            ]);

            return redirect()->back();
        } catch (Throwable $e) {
            // notify()->error('Something went wrong');
            notify()->error($e->getMessage());

            return redirect()->back();
        }
    }


    public function assignPermission(Request $request,$role_id)
    {

      

        $validation = Validator::make(
            $request->all(),
            [
                'permission.*' => 'required',
            ]
        );

        if ($validation->fails()) {
            notify()->error($validation->getMessageBag());
            return redirect()->back();
        }


        try {

            RolePermission::where('role_id',$role_id)->delete();

            foreach($request->permission as $permission_id)
            {
                RolePermission::create([
                    'role_id' => $role_id,
                    'permission_id' => $permission_id,
    
                ]);
            }
            

            notify()->success('Permission Assigned.');
            return redirect()->back();
        } catch (Throwable $e) {
            notify()->error($e->getMessage());

            return redirect()->back();
        }
    }
}
