<?php

namespace App\Models;

use App\Models\Roles;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Users extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $guarded = [] ;

    public function roles(){
        return $this->belongsToMany(Roles::class, "users_role", "user_id", "role_id");
    }

    public function checkPermissionAsscess($permissionCheckd){
        // return true;
        // Get all role user current login
        $roleForUser = Auth::user()->roles;

        // Lấy danh sách tất cả các quyền của User đang Login rồi so sánh với biến $permissionCheckd
        // Nếu "key_code" trùng với $permissionCheckd thì được sử dụng chức năng đó.
        foreach($roleForUser as $role){
            $permissions = $role->permissions;
            if($permissions->contains("key_code", $permissionCheckd)){
                return true;
            }

            return false;
        }
    }
}
