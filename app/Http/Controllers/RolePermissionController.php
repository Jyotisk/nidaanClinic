<?php

namespace App\Http\Controllers;

use App\Models\ExceptionHandler;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionController extends Controller
{
    public function getRole()
    {
        return view('permission.addRolePermission');
    }
    public function addRole(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'role.*' => 'required',
            ],

        );
        if ($validator->fails()) {

            return response()->json([
                'response' => 'validationFails',
                'error' => $validator->errors()
            ]);
        } else {
            DB::beginTransaction();
            try {
                for ($i = 0; $i < count($request->role); $i++) {
                    Role::create(['name' => $request->role[$i]]);
                }
                DB::commit();
                return response()->json([
                    'response' => 'success',
                    'message' => 'Role Added Successfully',
                ]);
            } catch (Exception $e) {
                return $e;
                DB::rollBack();
                $exception = new ExceptionHandler();
                $exception->controller_function = "RolePermissionController.addRole";
                $exception->error = $e;
                $exception->date = date('Y-m-d');
                $exception->user_id = Auth::user()->id;
                $exception->save();
                return response()->json([
                    'response' => 'fails',
                    'message' => 'Something went wrong',
                ]);
            }
        }
    }
    public function addPermission(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'permission.*' => 'required',
            ],

        );
        if ($validator->fails()) {

            return response()->json([
                'response' => 'validationFails',
                'error' => $validator->errors()
            ]);
        } else {
            DB::beginTransaction();
            try {
                for ($i = 0; $i < count($request->permission); $i++) {
                    Permission::create(['name' => $request->permission[$i]]);
                }
                DB::commit();
                return response()->json([
                    'response' => 'success',
                    'message' => 'Permission Added Successfully',
                ]);
            } catch (Exception $e) {
                DB::rollBack();
                $exception = new ExceptionHandler();
                $exception->controller_function = "RolePermissionController.addPermission";
                $exception->error = $e;
                $exception->date = date('Y-m-d');
                $exception->user_id = Auth::user()->id;
                $exception->save();
                return response()->json([
                    'response' => 'fails',
                    'message' => 'Something went wrong',
                ]);
            }
        }
    }
    public function getAssignRole()
    {
        $user = User::get();
        return view('permission.assignRole', compact('user'));
    }
    public function AssignRole(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'user_id' => 'required',
                'role' => 'required',
            ],

        );
        if ($validator->fails()) {

            return response()->json([
                'response' => 'validationFails',
                'error' => $validator->errors()
            ]);
        } else {
            DB::beginTransaction();
            try {
                $user = User::findOrFail($request->user_id);

                // Remove all roles from the user
                $user->syncRoles([]);
                
                for ($i = 0; $i < count($request->role); $i++) {
                    $user->assignRole($request->role[$i]);
                }
                DB::commit();
                return response()->json([
                    'response' => 'success',
                    'message' => 'Role Assign Successfully',
                ]);
            } catch (Exception $e) {
                DB::rollBack();
                $exception = new ExceptionHandler();
                $exception->controller_function = "RolePermissionController.AssignRole";
                $exception->error = $e;
                $exception->date = date('Y-m-d');
                $exception->user_id = Auth::user()->id;
                $exception->save();
                return response()->json([
                    'response' => 'fails',
                    'message' => 'Something went wrong',
                ]);
            }
        }
    }
    public function getRoleAjaxList($userId)
    {
        $allRole = Role::get(); // Get all roles

        $user = User::findOrFail($userId); // Find the user by ID
        $roles = $user->roles; // Get roles associated with the user
        $roles = collect($roles); // Convert roles to a collection
        $details = [];
        
        // Iterate through all roles
        foreach ($allRole AS $data) {
            // Check if the role is associated with the user
            if (!$roles->where('name', $data->name)->isEmpty()) {
                // Role is associated with the user
                $details[] = [
                    'status' => true,
                    'name' => $data->name // Include the role name in the details array
                ];
            } else {
                // Role is not associated with the user
                $details[] = [
                    'status' => false,
                    'name' =>  $data->name,
                ];
            }
        }
        return response()->json([
            'response' => 'success',
            'details' => $details,
        ]);
    }


    public function getAssignPermission()
    {
        $role = Role::get();
        return view('permission.assignPermission', compact('role'));
    }
    public function AssignPermission(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'role' => 'required',
                'permission.*' => 'required',
            ],

        );
        if ($validator->fails()) {

            return response()->json([
                'response' => 'validationFails',
                'error' => $validator->errors()
            ]);
        } else {
            DB::beginTransaction();
            try {
                $role = Role::findByName($request->role);
                $role->syncPermissions([]);
                for ($i = 0; $i < count($request->permission); $i++) {
                    $role->givePermissionTo($request->permission[$i]);
                }
                DB::commit();
                return response()->json([
                    'response' => 'success',
                    'message' => 'Permission Assign Successfully',
                ]);
            } catch (Exception $e) {
                DB::rollBack();
                $exception = new ExceptionHandler();
                $exception->controller_function = "RolePermissionController.AssignRole";
                $exception->error = $e;
                $exception->date = date('Y-m-d');
                $exception->user_id = Auth::user()->id;
                $exception->save();
                return response()->json([
                    'response' => 'fails',
                    'message' => 'Something went wrong',
                ]);
            }
        }
    }
    public function getPermissionAjaxList($id)
    {
        $permissionList = Permission::get();
        $role = Role::findByName($id);

        $permissions = collect($role->permissions);
        $details = [];
        foreach ($permissionList as $data) {
            if (!$permissions->where('name', $data->name)->isEmpty()) {
                $details[] = [
                    'status' => true,
                    'name' => $data->name // Assuming you want to include the name in the details array
                ];
            } else {
                $details[] = [
                    'status' => false,
                    'name' =>  $data->name,

                ];
            }
        }
        return response()->json([
            'response' => 'success',
            'details' => $details,
        ]);
    }
}
