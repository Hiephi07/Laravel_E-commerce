<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use App\Models\Permissions;

use App\Http\Requests\ValidateRequestRole;
use Illuminate\Support\Facades\DB;

class AdminRoleController extends Controller
{
    private $roles;
    private $permissions;
    public function __construct(Roles $roles, Permissions $permissions){
        $this->roles = $roles;
        $this->permissions = $permissions;
    }
    public function index(){
        $roles = $this->roles->paginate(5);
        return view("admin.roles.index", compact("roles"));
    }

    public function create(){
        $permissionsParent = $this->permissions->where("parent_id", 0)->get();
        return view("admin.roles.add", compact("permissionsParent"));
    }

    public function store(ValidateRequestRole $request){
        try {
            DB::beginTransaction();

            $role = $this->roles->create([
                "name"=> $request->name,
                "display_name"=> $request->display_name
            ]);

            $role->permissions()->attach($request->permission_id);
            
            DB::commit();

            return redirect()->route("roles.index");
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }

    public function edit($id){
        $permissionsParent = $this->permissions->where("parent_id", 0)->get();
        $role = $this->roles->find($id);
        $permissionChecked = $role->permissions;
        return view("admin.roles.edit", compact('permissionsParent', "role", "permissionChecked"));
    }

    public function update($id, ValidateRequestRole $request){
        try {
            DB::beginTransaction();

            $role = $this->roles->find($id);
            $role->update([
                "name"=> $request->name,
                "display_name"=> $request->display_name
            ]);

            $role->permissions()->sync($request->permission_id);
            DB::commit();
            return redirect()->route("roles.index");
        }catch (\Exception $e) {
            DB::rollBack();
        }
    }

    public function delete($id){
        try {
            $this->roles->find($id)->delete();
            return response()->json([
                "code"    => 200,
                "message" => "True"
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                "code"    => 500,
                "message" => "False"
            ], 500);
        }
    }
}
