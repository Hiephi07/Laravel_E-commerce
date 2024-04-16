<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    function loginAdmin(){
        // Kiểm tra xem người dùng đã Login chưa
        if (Auth::check()) {
            return redirect()->to('admin/menus');
        }

        return view("login");
    }

    function postLoginAdmin(Request $request){

        // Kiểm tra xem người dùng có chọn chế độ Remember Me khi Login không
        $remember = $request->has("remember_me") ? true : false;

        // Nếu $remember = true, user sẽ được đăng nhập vô thời hạn
        if (Auth::attempt([
            'email'    => $request->username, 
            'password' => $request->password], 
            $remember)) {
                return redirect()->to('admin/menus');
        }

        return redirect()->back()->withInput()->withErrors(['loginFailed' => 'Username hoặc mật khẩu không chính xác']);
    }

    function logoutAdmin(Request $request){
        $request->session()->flush();
        Auth::logout();

    // Redirect tới trang bạn muốn sau khi logout
    return redirect()->to('admin');
    }
}
