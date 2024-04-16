<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Users;
use App\Models\Roles;

use App\Http\Requests\ValidateRequestUser;

use Illuminate\Support\Facades\DB;
use Throwable;

class AdminUserController
{
    private $user;
    private $role;
    public function __construct(Users $user, Roles $role){
        $this->user = $user;
        $this->role = $role;
    }
    public function index(){
        $users = $this->user->paginate(5);
        return view("admin.user.index", compact("users"));
    }

    public function create(){
        $roles = $this->role->all();
        return view("admin.user.add", compact("roles"));
    }

    public function store(ValidateRequestUser $request){

        try {
            DB::beginTransaction();

            $user = $this->user->create([
                "name"=> $request->name,
                "email"=> $request->email,
                "password"=> bcrypt($request->password)
            ]);

            $rolesID = $request->roles_id;
            
            $user->roles()->attach($rolesID);

            DB::commit();
            return redirect()->route("users.index");

        } catch (Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
            return redirect()->back()->with("error", $th->getMessage());
        }
    }

    public function edit($id){
        $roles = $this->role->all();
        $user  = $this->user->find($id);
        $roleForUser = $user->roles;
        return view("admin.user.edit", compact("roles", "user", "roleForUser"));
    }

    public function update($id, Request $request){
        try {
            DB::beginTransaction();

            $dataUpdate = [
                "name"=> $request->name,
                "email"=> $request->email
            ];

            if(!empty($request->password)){
                $dataUpdate["password"] = bcrypt($request->password);
            }

            $user = $this->user->find($id)->update( $dataUpdate );

            $user = $this->user::find($id);
            $user->roles()->sync($request->roles_id);

            DB::commit();
            return redirect()->route("users.index");

        } catch (Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
            // return redirect()->back()->with("error", $th->getMessage());
        }
    }

    public function delete($id){
        try {
            $this->user->find($id)->delete();
            return response()->json([
                "code"    => 200,
                "message" => "True"
            ], 200);

        } catch (Throwable $e) {
            return response()->json([
                "code"    => 500,
                "message" => "False"
            ], 500);
        }
    }
}
